<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Enums\UserRole;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string')]
    public string $username = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $user = $this->validateCredentials();

        if (Features::canManageTwoFactorAuthentication() && $user->hasEnabledTwoFactorAuthentication()) {
            Session::put([
                'login.id' => $user->getKey(),
                'login.remember' => $this->remember,
            ]);

            $this->redirect(route('two-factor.login'), navigate: true);

            return;
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        if(auth()->user()->user_role === 'admin') {
            return redirect()->route('dashboard')->with("success", "Admin logged in successfully.");
        }

        if(auth()->user()->user_role ==='user') {
            return redirect()->route('dashboard')->with("success", "User logged in successfully.");
        }

        //$this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Validate the user's credentials.
     */
    protected function validateCredentials(): User
    {
        $fieldType = filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // $user = Auth::getProvider()->retrieveByCredentials(['email' => $this->email, 'password' => $this->password]);
        $user = Auth::getProvider()->retrieveByCredentials([$fieldType => $this->username]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => __('Email/Username atau password salah'),
            ]);
        }

        return $user;
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->username).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Masuk ke akun Anda')" :description="__('Untuk mengakses halaman ini, silakan masuk menggunakan email dan kata sandi Anda')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address or Username -->
        <flux:input
            wire:model="username"
            :label="__('Email atau Nama Pengguna')"
            type="text"
            required
            autofocus
            autocomplete="username"
            placeholder="email@example.com atau username"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Kata sandi')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Kata sandi')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                    {{ __('Lupa password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Jangan log out saya di komputer ini')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                {{ __('Masuk') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Belum punya akun?') }}</span>
            <flux:link :href="route('register')" wire:navigate>{{ __('Silakan daftar terlebih dahulu') }}</flux:link>
        </div>
    @endif
</div>

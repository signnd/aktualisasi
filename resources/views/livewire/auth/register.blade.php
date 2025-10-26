<?php

use App\Models\User;
use App\Models\Kabupaten;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $username = '';
    public string $satuan_kerja = '';
    public ?int $kabupaten_id = null;
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'satuan_kerja' => ['nullable', 'string', 'max:255'],
            'kabupaten_id' => ['required', 'exists:kabupaten,id'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['user_role'] = 'user'; // Set default role sebagai user

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Session::regenerate();

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }

    public function with(): array
    {
        return [
            'kabupatens' => Kabupaten::where('kabupaten', '!=', 'Provinsi Bali')
                                      ->orderBy('kabupaten')
                                      ->get()
        ];
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Masukkan detail Anda untuk membuat akun')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Nama')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nama Lengkap')"
        />

        <!-- Username -->
        <flux:input
            wire:model="username"
            :label="__('Nama Pengguna')"
            type="text"
            required
            autocomplete="username"
            :placeholder="__('Nama Pengguna')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Kabupaten/Kota -->
        <flux:select
            wire:model="kabupaten_id"
            :label="__('Kabupaten/Kota')"
            required
        >
            <option value="">-- Pilih Kabupaten/Kota --</option>
            @foreach($kabupatens as $kab)
                <option value="{{ $kab->id }}">{{ $kab->kabupaten }}</option>
            @endforeach
        </flux:select>

        <!-- Satuan Kerja -->
        <flux:input
            wire:model="satuan_kerja"
            :label="__('Satuan Kerja')"
            type="text"
            autocomplete="organization"
            :placeholder="__('Satuan Kerja (Opsional)')"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Kata sandi')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Kata sandi')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Konfirmasi kata sandi')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Konfirmasi kata sandi')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                {{ __('Daftar') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('Sudah punya akun?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Klik di sini untuk masuk') }}</flux:link>
    </div>
</div>

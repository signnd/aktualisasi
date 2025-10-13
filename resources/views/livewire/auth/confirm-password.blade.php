<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header
            :title="__('Konfirmasi password')"
            :description="__('Anda masuk ke area aman. Jika Anda mengubah sesuatu dalam area ini, dapat berpengaruh besar terhadap akun dan data Anda. Untuk lanjut masuk, silakan masukkan kata sandi Anda.')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="password"
                :label="__('Kata sandi')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Kata sandi')"
                viewable
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="confirm-password-button">
                {{ __('Konfirmasi') }}
            </flux:button>
        </form>
    </div>
</x-layouts.auth>

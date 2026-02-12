<flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <div class="flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
        <x-app-logo />
    </div>

    <flux:navlist variant="outline">
        <flux:navlist.group  class="grid">
            <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    <flux:navlist variant="outline">
        <flux:navlist.group :heading="__('Urusan Agama')" class="grid">
            <flux:navlist.item icon="home-modern" :href="route('riab.index')" :current="request()->routeIs('riab.index')" wire:navigate>{{ __('RIAB') }}</flux:navlist.item>
            <flux:navlist.item icon="user-group" :href="route('okb.index')" :current="request()->routeIs('okb.index')" wire:navigate>{{ __('OKB') }}</flux:navlist.item>
            <flux:navlist.item icon="building-office" :href="route('yayasan.index')" :current="request()->routeIs('yayasan.index')" wire:navigate>{{ __('Yayasan Keagamaan') }}</flux:navlist.item>
            <flux:navlist.item icon="star" :href="route('majelis.index')" :current="request()->routeIs('majelis.index')" wire:navigate>{{ __('Majelis Keagamaan') }}</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    <flux:navlist variant="outline">
        <flux:navlist.group :heading="__('Pendidikan Agama')" class="grid">
            <flux:navlist.item icon="book-open" :href="route('smb.index')" :current="request()->routeIs('smb.index')" wire:navigate>{{ __('Sekolah Minggu') }}</flux:navlist.item>
            <flux:navlist.item icon="user-circle" :href="route('guru-penda.index')" :current="request()->routeIs('guru-penda.index')" wire:navigate>{{ __('Guru Agama Buddha') }}</flux:navlist.item>
            <flux:navlist.item icon="user-group" :href="route('tendik.index')" :current="request()->routeIs('tendik.index')" wire:navigate>{{ __('Tenaga Pendidikan') }}</flux:navlist.item>
            <flux:navlist.item icon="academic-cap" :href="route('dhammasekha.index')" :current="request()->routeIs('dhammasekha.index')" wire:navigate>{{ __('Dhammasekha') }}</flux:navlist.item>
            <flux:navlist.item icon="building-library" :href="route('pusdiklat.index')" :current="request()->routeIs('pusdiklat.index')" wire:navigate>{{ __('Pusdiklat') }}</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    @if(auth()->user()->user_role === 'admin')
    <flux:navlist variant="outline">
        <flux:navlist.group :heading="__('Master data')" class="grid">
            <flux:navlist.item icon="information-circle" :href="route('informasi.index')" :current="request()->routeIs('informasi.index')" wire:navigate>{{ __('Informasi Publik/Internal') }}</flux:navlist.item>
            <flux:navlist.item icon="globe-asia-australia" :href="route('kabupaten.index')" :current="request()->routeIs('kabupaten.index')" wire:navigate>{{ __('Kabupaten') }}</flux:navlist.item>
            <flux:navlist.item icon="map-pin" :href="route('kecamatan.index')" :current="request()->routeIs('kecamatan.index')" wire:navigate>{{ __('Kecamatan') }}</flux:navlist.item>
            <flux:navlist.item icon="users" :href="route('registered-users.index')" :current="request()->routeIs('registered-users.index')" wire:navigate>{{ __('Pengguna Terdaftar') }}</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>
    @else
    <flux:navlist variant="outline">
        <flux:navlist.group :heading="__('Master data')" class="grid">
            <flux:navlist.item icon="information-circle" :href="route('informasi.index')" :current="request()->routeIs('informasi.index')" wire:navigate>{{ __('Informasi Publik/Internal') }}</flux:navlist.item>
            <flux:navlist.item icon="map-pin" :href="route('kecamatan.index')" :current="request()->routeIs('kecamatan.index')" wire:navigate>{{ __('Kecamatan') }}</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    @endif

    <flux:spacer />

    <!-- Desktop User Menu -->
    <flux:dropdown class="hidden lg:block" position="bottom" align="start">
        <flux:profile
            :name="auth()->user()->name"
            :initials="auth()->user()->initials()"
            icon:trailing="chevrons-up-down"
            data-test="sidebar-menu-button"
        />

        <flux:menu class="w-[220px]">
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                            <span
                                class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                {{ auth()->user()->initials() }}
                            </span>
                        </span>

                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->satuan_kerja }}</span>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <flux:menu.radio.group>
                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>

<!-- Mobile User Menu -->
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:spacer />

    <flux:dropdown position="top" align="end">
        <flux:profile
            :initials="auth()->user()->initials()"
            icon-trailing="chevron-down"
        />

        <flux:menu>
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                            <span
                                class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                            >
                                {{ auth()->user()->initials() }}
                            </span>
                        </span>

                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->satuan_kerja }}</span>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <flux:menu.radio.group>
                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>

{{ $slot }}
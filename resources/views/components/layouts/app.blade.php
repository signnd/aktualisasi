<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body class="flux-layout min-h-screen bg-white dark:bg-zinc-800">
        <x-layouts.app.sidebar :title="$title ?? null" />

        <flux:main>
            {{ $slot }}
        </flux:main>

        @fluxScripts
        @livewireScripts
    </body>
</html>

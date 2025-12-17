<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-gray-50 dark:bg-zinc-900">
    <!-- Navbar -->
<nav class="bg-white dark:bg-zinc-800 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-3">
                <a href="/" class="flex items-center space-x-2">
                    <x-app-logo />
                </a>
                
                <!-- Mobile Menu Button -->
                <div x-data="{ open: false }" class="relative md:hidden">
                    <button @click="open = !open" 
                            class="p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-2 w-48 bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700 py-2"
                         style="display: none;">
                        <a href="{{ route('guest.riab.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 {{ request()->routeIs('guest.riab.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                            RIAB
                        </a>
                        <a href="{{ route('guest.okb.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 {{ request()->routeIs('guest.okb.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                            OKB
                        </a>
                        <a href="{{ route('guest.yayasan.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 {{ request()->routeIs('guest.yayasan.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                            Yayasan
                        </a>
                        <a href="{{ route('guest.smb.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 {{ request()->routeIs('guest.smb.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                            SMB
                        </a>
                        <a href="{{ route('guest.dhammasekha.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 {{ request()->routeIs('guest.dhammasekha.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                            Dhammasekha
                        </a>
                        <a href="{{ route('guest.pusdiklat.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 {{ request()->routeIs('guest.pusdiklat.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                            Pusdiklat
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('guest.riab.index') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-lg transition {{ request()->routeIs('guest.riab.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                    RIAB
                </a>
                <a href="{{ route('guest.okb.index') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-lg transition {{ request()->routeIs('guest.okb.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                    OKB
                </a>
                <a href="{{ route('guest.majelis.index') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-lg transition {{ request()->routeIs('guest.majelis.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                    Majelis
                </a>
                <a href="{{ route('guest.yayasan.index') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-lg transition {{ request()->routeIs('guest.yayasan.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                    Yayasan
                </a>
                <a href="{{ route('guest.smb.index') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-lg transition {{ request()->routeIs('guest.smb.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                    SMB
                </a>
                <a href="{{ route('guest.dhammasekha.index') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-lg transition {{ request()->routeIs('guest.dhammasekha.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                    Dhammasekha
                </a>
                <a href="{{ route('guest.pusdiklat.index') }}" 
                    class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-lg transition {{ request()->routeIs('guest.pusdiklat.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                    Pusdiklat
                </a>
                </div>
            <div class="p-2 my-auto">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="">
                        
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
    <!-- Main Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-zinc-800 border-t border-gray-200 dark:border-zinc-700 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                &copy; {{ date('Y') }} Sistem Informasi Keagamaan Buddha. All rights reserved.
            </p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
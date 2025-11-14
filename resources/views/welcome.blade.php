<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIMADHA - Sistem Informasi Keagamaan Buddha di Bali</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-gray-200/30 dark:bg-gray-600  text-[#1b1b18] dark:text-[#EDEDEC]">
        <!-- Header -->
        <header class="w-full border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 bg-white shadow-xs dark:bg-zinc-800">
                @if (Route::has('login'))
                    <nav class="flex items-center justify-end gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="inline-block px-5 py-1.5 text-white bg-gray-700 shadow-lg dark:text-gray-100 border-[#19140035] hover:border-[#1915014a] border dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-block px-5 py-1.5 text-white bg-gray-700 shadow-lg dark:text-gray-100 border border-transparent hover:border-gray-800 hover:bg-gray-600 dark:hover:border-[#3E3E3F] rounded-sm text-sm leading-normal">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <!-- <a href="{{ route('register') }}"
                                   class="inline-block px-5 py-1.5 text-gray-100 border-white hover:border-[#4848454a] border dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                    Register
                                </a>--> 
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl font-semibold mb-4 text-gray-900/90 dark:text-gray-100">Selamat datang di SIMADHA</h1>
                <h3 class="text-xl dark:text-gray-300 ">Sistem Informasi Keagamaan Buddha di Bali</h3>
            </div>

            <!-- Main Categories -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <!-- Urusan Agama Buddha -->
                <div class="bg-gray-200 transition hover:shadow-xl motion-reduce:transition-none dark:border-gray-600 text-gray-50 dark:bg-zinc-800/60 rounded-lg p-8 shadow-lg">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-950/70 dark:text-gray-200">Urusan Agama Buddha</h2>
                    
                    <!-- Lembaga Keagamaan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4 text-gray-700/80 dark:text-[#A1A09A]">Lembaga Keagamaan</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <a href="{{ route('guest.majelis.index') }}" 
                                   class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center bg-sky-800/70 hover:bg-sky-800/90 transition hover:shadow-lg motion-reduce:transition-none">
                                    <div class="text-3xl font-semibold mb-2">{{ $counts['majelis'] }}</div>
                                    <div class="text-sm text-gray-200">Majelis Keagamaan</div>
                                </a>
                                <a href="{{ route('guest.yayasan.index') }}" 
                                   class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center bg-emerald-800/70 hover:bg-emerald-800/90 transition hover:shadow-lg motion-reduce:transition-none">
                                    <div class="text-3xl font-semibold mb-2">{{ $counts['yayasan'] }}</div>
                                    <div class="text-sm text-gray-200">Yayasan Keagamaan</div>
                                </a>
                                <a href="{{ route('guest.okb.index') }}" 
                                   class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center bg-teal-800/70 hover:bg-teal-800/90 transition hover:shadow-lg motion-reduce:transition-none">
                                    <div class="text-3xl font-semibold mb-2">{{ $counts['okb'] }}</div>
                                    <div class="text-sm text-gray-200">Organisasi Keagamaan</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Rumah Ibadah -->
                    <div>
                        <h3 class="text-lg font-medium mb-4 text-gray-700/80 dark:text-[#A1A09A]">Rumah Ibadah</h3>
                        <div class="space-y-3">
                            <a href="{{ route('guest.riab.index') }}" 
                               class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b]
                                transition bg-indigo-700/70 hover:bg-indigo-700/90 hover:shadow-lg motion-reduce:transition-none">
                        <div class="text-3xl font-semibold mb-2">{{ $counts['riab'] }}</div>
                        <span class="text-sm text-gray-200">Rumah Ibadah Agama Buddha (Vihara, Cetiya, TITD)</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pendidikan Agama Buddha -->
                <div class="bg-gray-200 transition hover:shadow-xl motion-reduce:transition-none dark:border-gray-600 text-gray-50 dark:bg-zinc-800/60 rounded-lg p-8 shadow-lg">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-950/70 dark:text-gray-200">Pendidikan Agama Buddha</h2>
                    
                    <!-- Lembaga Pendidikan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4 text-zinc-700/80 dark:text-zinc-300/80">Lembaga Pendidikan</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('guest.smb.index') }}" 
                               class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center transition bg-lime-900 hover:bg-lime-900/70 hover:shadow-lg motion-reduce:transition-none">
                                <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['smb'] }}</div>
                                <div class="text-sm text-gray-200">Sekolah Minggu Buddha (SMB)</div>
                            </a>
                            <a href="{{ route('guest.dhammasekha.index') }}" 
                            class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center transition bg-green-900 hover:bg-green-900/70 hover:shadow-lg motion-reduce:transition-none">
                                   <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['dhammasekha'] }}</div>
                                   <div class="text-sm text-gray-200">Dhammasekha</div>
                            </a>
                            <a href="{{ route('guest.pusdiklat.index') }}" 
                               class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center transition bg-emerald-900 hover:bg-emeraldp-900/70 hover:shadow-lg motion-reduce:transition-none">
                                <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['pusdiklat'] }}</div>
                                <div class="text-sm text-gray-200">Pusdiklat</div>
                            </a>

                        </div>
                        </div>
                    </div>

                    <!-- Guru Pendidikan Agama -->
                    <div>
                        <h3 class="text-lg font-medium mb-4 text-zinc-700/80 dark:text-[#A1A09A]">Tenaga Kependidikan Agama</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('guest.guru-penda.index') }}" 
                               class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center transition bg-violet-900 hover:bg-violet-900/70">
                                <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['gurupenda'] }}</div>
                                <div class="text-sm text-gray-200">Guru Pendidikan Agama</div>
                            </a>
                            <div class="block p-4 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:border-[#19140035] dark:hover:border-[#62605b] 
                                   text-center transition opacity-50 cursor-not-allowed">
                                <span class="font-medium text-zinc-700 dark:text-zinc-300">Tenaga Kependidikan Agama Buddha</span>
                                <div class="text-sm text-zinc-500 dark:text-[#A1A09A]">(Segera Hadir)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </main>

        <!-- Footer -->
        <footer class="border-0">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-6 bg-zinc-300 dark:bg-zinc-800">
                <p class="text-center text-sm dark:text-[#A1A09A]">
                    &copy; {{ date('Y') }} SIMADHA - Sistem Informasi Keagamaan Buddha di Bali
                </p>
            </div>
        </footer>
    </body>
</html>
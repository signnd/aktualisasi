<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIMADHA - Sistem Informasi Keagamaan Buddha di Bali</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <style>
        </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style>
          html, body {
            font-family: 'Arimo', system-ui, -apple-system, 'Open Sans', Roboto, 'Helvetica Neue', Arial, sans-serif;
          }
        </style>
    </head>
    
    <body class="antialiased text-gray-900 bg-gray-50 dark:bg-gray-900">
        <!-- Background Image with Opacity -->
        <div class="fixed inset-0 z-[-1] bg-cover bg-center bg-no-repeat" 
             style="background-image: url('/images/welcome-bg.png'); opacity: 0.1;">
        </div>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl font-semibold mb-4 text-gray-900">Selamat datang di SIMADHA</h1>
                <h3 class="text-xl ">Sistem Informasi Keagamaan Buddha di Bali</h3>
            </div>

            <!-- Main Categories -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <!-- Urusan Agama Buddha -->
                <div class="bg-gray-200/20 transition hover:shadow-xl motion-reduce:transition-none text-gray-50 rounded-lg p-8 border-1 border-gray-500">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-950">Urusan Agama Buddha</h2>
                    
                    <!-- Lembaga Keagamaan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4 text-gray-700">Lembaga Keagamaan</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <a href="{{ route('guest.majelis.index') }}" 
                                   class="block p-4 rounded-md
                                   text-center bg-sky-700 hover:bg-sky-800 transition hover:shadow-lg motion-reduce:transition-none">
                                    <div class="text-3xl font-semibold mb-2">{{ $counts['majelis'] }}</div>
                                    <div class="text-sm text-gray-200">Majelis Keagamaan</div>
                                </a>
                                <a href="{{ route('guest.yayasan.index') }}" 
                                   class="block p-4 rounded-md 
                                   text-center bg-emerald-700 hover:bg-emerald-800 transition hover:shadow-lg motion-reduce:transition-none">
                                    <div class="text-3xl font-semibold mb-2">{{ $counts['yayasan'] }}</div>
                                    <div class="text-sm text-gray-200">Yayasan Keagamaan</div>
                                </a>
                                <a href="{{ route('guest.okb.index') }}" 
                                   class="block p-4 rounded-md 
                                   text-center bg-teal-700 hover:bg-teal-800 transition hover:shadow-lg motion-reduce:transition-none">
                                    <div class="text-3xl font-semibold mb-2">{{ $counts['okb'] }}</div>
                                    <div class="text-sm text-gray-200">Organisasi Keagamaan</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Rumah Ibadah -->
                    <div>
                        <h3 class="text-lg font-medium mb-4 text-gray-700">Rumah Ibadah</h3>
                        <div class="space-y-3">
                            <a href="{{ route('guest.riab.index') }}" 
                               class="block p-4 rounded-md 
                                transition bg-indigo-600 hover:bg-indigo-700 hover:shadow-lg motion-reduce:transition-none">
                        <div class="text-3xl font-semibold mb-2">{{ $counts['riab'] }}</div>
                        <span class="text-sm text-gray-200">Rumah Ibadah Agama Buddha (Vihara, Cetiya, TITD)</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pendidikan Agama Buddha -->
                <div class="bg-gray-200/20 transition hover:shadow-xl motion-reduce:transition-none text-gray-50 rounded-lg p-8 border-1 border-gray-500">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-950">Pendidikan Agama Buddha</h2>
                    
                    <!-- Lembaga Pendidikan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4 text-zinc-700">Lembaga Pendidikan</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('guest.smb.index') }}" 
                               class="block p-4 rounded-md 
                                   text-center transition bg-lime-700 hover:bg-lime-900 hover:shadow-lg motion-reduce:transition-none">
                                <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['smb'] }}</div>
                                <div class="text-sm text-gray-200">Sekolah Minggu Buddha (SMB)</div>
                            </a>
                            <a href="{{ route('guest.dhammasekha.index') }}" 
                            class="block p-4 rounded-md 
                                   text-center transition bg-green-700 hover:bg-green-900 hover:shadow-lg motion-reduce:transition-none">
                                   <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['dhammasekha'] }}</div>
                                   <div class="text-sm text-gray-200">Dhammasekha</div>
                            </a>
                            <a href="{{ route('guest.pusdiklat.index') }}" 
                               class="block p-4 rounded-md 
                                   text-center transition bg-emerald-700 hover:bg-emerald-900 hover:shadow-lg motion-reduce:transition-none">
                                <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['pusdiklat'] }}</div>
                                <div class="text-sm text-gray-200">Pusdiklat</div>
                            </a>

                        </div>
                        </div>
                    </div>

                    <!-- Guru Pendidikan Agama -->
                    <div>
                        <h3 class="text-lg font-medium mb-4 text-zinc-700">Tenaga Kependidikan Agama</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('guest.guru-penda.index') }}" 
                               class="block p-4 rounded-md 
                                   text-center transition bg-violet-700 hover:bg-violet-900">
                                <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['gurupenda'] }}</div>
                                <div class="text-sm text-gray-200">Guru Pendidikan Agama</div>
                            </a>
                            <a href="{{ route('guest.tendik.index') }}" 
                               class="block p-4 rounded-md 
                                   text-center transition bg-violet-700 hover:bg-violet-900">
                                <div class="text-3xl font-semibold mb-2 text-gray-50">{{ $counts['tendik'] }}</div>
                                <div class="text-sm text-gray-200">Tenaga Kependidikan Agama Buddha</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50/20 transition hover:shadow-xl motion-reduce:transition-none text-gray-60 rounded-lg px-6 py-4 border-1 border-gray-500">
            <h2 class="text-xl font-semibold mb-4">Informasi Publik</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse(($informasiPublik ?? collect()) as $info)
                    <a href="{{ route('guest.informasi.show', $info) }}" class="block p-4 bg-gray-50 hover:bg-gray-200 dark:bg-zinc-800 rounded-lg transition hover:shadow-xl">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ \Illuminate\Support\Str::limit($info->judul, 60) }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $info->ringkasan ?? \Illuminate\Support\Str::limit($info->ringkasan, 120) }}</p>
                    </a>
                @empty
                    <p class="text-sm text-gray-500">Belum ada Informasi Publik.</p>
                @endforelse
            </div>
            <div class="py-5">
                <div class="flex justify-end">
                    <a href="{{ route('guest.informasi.index') }}"
                   class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition motion-reduce:transition-none duration-200 shadow-md">
                    Lihat informasi publik lainnya
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" fill="none" viewBox="0 0 28 28" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6l6 6-6 6" />
                </svg>
                </a>
            </div>
            </a>
        </div>
        </div>
    </div>

    </main>

        <!-- Footer -->
        <footer class="border-0">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-6 dark:bg-zinc-800">
                <p class="text-center text-sm dark:text-[#A1A09A]">
                    &copy; {{ date('Y') }} SIMADHA - Sistem Informasi Keagamaan Buddha di Bali
                </p>
            </div>
        </footer>
    </body>
</html>
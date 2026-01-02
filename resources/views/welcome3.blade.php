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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pontano+Sans:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">    
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <style>
        html, body {
            font-family: "Pontano Sans", sans-serif;
            background-color: #f8fafc; /* Slate 50 */
        }
        
        /* Custom smooth animation */
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="text-slate-600 antialiased min-h-screen flex flex-col">

    <!-- Navbar Decoration (Optional Line) -->
    <div class="h-2 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-red-500"></div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        
        <!-- Hero Section -->
        <div class="text-center mb-16 fade-in-up">
            <!-- Icon Logo Placeholder (Optional) -->
            <div class="mx-auto h-16 w-16 bg-gradient-to-br from-orange-100 to-amber-100 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-3 text-slate-900 tracking-tight">
                Selamat datang di <span class="text-orange-600">SIMADHA</span>
            </h1>
            <h3 class="text-lg md:text-xl text-slate-500 font-medium">
                Sistem Informasi Keagamaan Buddha di Bali
            </h3>
        </div>

        <!-- Main Categories Grid -->
        <div class="grid lg:grid-cols-2 gap-8 mb-12">
            
            <!-- COLUMN 1: Urusan Agama Buddha -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 fade-in-up delay-100 relative overflow-hidden group">
                <!-- Decorative background blob -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-50 rounded-full blur-3xl opacity-50 group-hover:bg-orange-100 transition duration-500"></div>

                <div class="relative z-10 flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <div class="p-2 bg-orange-100 rounded-lg text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Urusan Agama Buddha</h2>
                </div>
                
                <!-- Lembaga Keagamaan -->
                <div class="mb-8 relative z-10">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span> Lembaga Keagamaan
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Majelis -->
                        <a href="{{ route('guest.majelis.index') }}" 
                           class="flex flex-col items-center justify-center p-5 rounded-2xl bg-orange-50/50 border border-orange-100 hover:border-orange-300 hover:bg-orange-50 hover:shadow-md transition-all duration-300 group/card">
                            <div class="text-4xl font-bold text-orange-600 mb-1 group-hover/card:scale-110 transition-transform">{{ $counts['majelis'] }}</div>
                            <div class="text-sm font-medium text-slate-600">Majelis</div>
                            <!-- Icon -->
                            <svg class="w-5 h-5 text-orange-300 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </a>
                        
                        <!-- Yayasan -->
                        <a href="{{ route('guest.yayasan.index') }}" 
                           class="flex flex-col items-center justify-center p-5 rounded-2xl bg-amber-50/50 border border-amber-100 hover:border-amber-300 hover:bg-amber-50 hover:shadow-md transition-all duration-300 group/card">
                            <div class="text-4xl font-bold text-amber-600 mb-1 group-hover/card:scale-110 transition-transform">{{ $counts['yayasan'] }}</div>
                            <div class="text-sm font-medium text-slate-600">Yayasan</div>
                            <svg class="w-5 h-5 text-amber-300 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </a>

                        <!-- Organisasi -->
                        <a href="{{ route('guest.okb.index') }}" 
                           class="flex flex-col items-center justify-center p-5 rounded-2xl bg-yellow-50/50 border border-yellow-100 hover:border-yellow-300 hover:bg-yellow-50 hover:shadow-md transition-all duration-300 group/card">
                            <div class="text-4xl font-bold text-yellow-600 mb-1 group-hover/card:scale-110 transition-transform">{{ $counts['okb'] }}</div>
                            <div class="text-sm font-medium text-slate-600">Organisasi</div>
                            <svg class="w-5 h-5 text-yellow-300 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Rumah Ibadah -->
                <div class="relative z-10">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Rumah Ibadah
                    </h3>
                    <a href="{{ route('guest.riab.index') }}" 
                       class="flex items-center justify-between p-5 rounded-2xl bg-gradient-to-r from-red-50 to-orange-50 border border-red-100 hover:border-red-300 hover:shadow-lg hover:shadow-red-500/10 transition-all duration-300 group/item">
                        <div class="flex items-center gap-4">
                             <div class="p-3 bg-white rounded-xl text-red-500 shadow-sm group-hover/item:text-red-600 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                             </div>
                             <div class="text-left">
                                 <div class="text-sm text-slate-500">Total Data</div>
                                 <div class="font-bold text-slate-800 text-lg">Rumah Ibadah Agama Buddha</div>
                             </div>
                        </div>
                        <div class="text-3xl font-bold text-red-600">{{ $counts['riab'] }}</div>
                    </a>
                </div>
            </div>

            <!-- COLUMN 2: Pendidikan Agama Buddha -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 fade-in-up delay-200 relative overflow-hidden group">
                 <!-- Decorative background blob -->
                 <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-50 rounded-full blur-3xl opacity-50 group-hover:bg-teal-100 transition duration-500"></div>

                <div class="relative z-10 flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <div class="p-2 bg-teal-100 rounded-lg text-teal-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Pendidikan Agama Buddha</h2>
                </div>

                <!-- Lembaga Pendidikan -->
                <div class="mb-8 relative z-10">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span> Lembaga Pendidikan
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- SMB -->
                        <a href="{{ route('guest.smb.index') }}" 
                           class="flex flex-col items-center justify-center p-5 rounded-2xl bg-teal-50/50 border border-teal-100 hover:border-teal-300 hover:bg-teal-50 hover:shadow-md transition-all duration-300 group/card">
                            <div class="text-4xl font-bold text-teal-600 mb-1 group-hover/card:scale-110 transition-transform">{{ $counts['smb'] }}</div>
                            <div class="text-sm font-medium text-slate-600">SMB</div>
                            <svg class="w-5 h-5 text-teal-300 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </a>
                        
                        <!-- Dhammasekha -->
                        <a href="{{ route('guest.dhammasekha.index') }}" 
                           class="flex flex-col items-center justify-center p-5 rounded-2xl bg-emerald-50/50 border border-emerald-100 hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-md transition-all duration-300 group/card">
                            <div class="text-4xl font-bold text-emerald-600 mb-1 group-hover/card:scale-110 transition-transform">{{ $counts['dhammasekha'] }}</div>
                            <div class="text-sm font-medium text-slate-600">Dhammasekha</div>
                            <svg class="w-5 h-5 text-emerald-300 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </a>

                        <!-- Pusdiklat -->
                         <a href="{{ route('guest.pusdiklat.index') }}" 
                            class="flex flex-col items-center justify-center p-5 rounded-2xl bg-cyan-50/50 border border-cyan-100 hover:border-cyan-300 hover:bg-cyan-50 hover:shadow-md transition-all duration-300 group/card">
                             <div class="text-4xl font-bold text-cyan-600 mb-1 group-hover/card:scale-110 transition-transform">{{ $counts['pusdiklat'] }}</div>
                             <div class="text-sm font-medium text-slate-600">Pusdiklat</div>
                             <svg class="w-5 h-5 text-cyan-300 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                         </a>
                    </div>
                </div>

                <!-- Guru / Tenaga Pendidik -->
                <div class="relative z-10">
                     <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-violet-400"></span> Tenaga Pendidikan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('guest.guru-penda.index') }}" 
                           class="flex items-center gap-4 p-4 rounded-2xl bg-violet-50/50 border border-violet-100 hover:border-violet-300 hover:bg-violet-50 hover:shadow-md transition-all duration-300">
                             <div class="p-3 bg-white rounded-xl text-violet-500 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                             </div>
                             <div>
                                 <div class="text-2xl font-bold text-violet-700">{{ $counts['gurupenda'] }}</div>
                                 <div class="text-sm font-medium text-slate-600 leading-tight">Guru Pendidikan Agama</div>
                             </div>
                        </a>
                        
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200 opacity-75">
                             <div class="p-3 bg-white rounded-xl text-slate-400 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                             </div>
                             <div>
                                 <div class="text-sm font-bold text-slate-500">Tenaga Kependidikan</div>
                                 <div class="text-xs text-slate-400">(Segera Hadir)</div>
                             </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="border-t border-slate-200 mt-auto bg-white">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} SIMADHA. All rights reserved.
            </p>
            <div class="flex gap-4 text-sm text-slate-400">
                <span>Sistem Informasi Keagamaan Buddha Provinsi Bali</span>
            </div>
        </div>
    </footer>
</body>
</html>
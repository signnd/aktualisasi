<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.majelis.index') }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Majelis
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $majelis->nama_majelis }}</h1>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Informasi Lokasi -->
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Informasi
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kabupaten/Kota/Provinsi</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $majelis->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            @if($majelis->alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $majelis->alamat }}</p>
                            </div>
                            @endif
                            @if($majelis->latitude && $majelis->longitude)
                            <div>
                                <p class="text-sm text-gray-300">Koordinat (Lat, Long)</p>
                                <p class="font-medium">{{ $majelis->latitude ?? '-' }}, {{ $majelis->longitude ?? '-' }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    @if($majelis->ketua || $majelis->tgl_terdaftar || $majelis->deksripsi || $majelis->jenis_majelis || $majelis->jumlah_umat || $majelis->kondisi)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($majelis->sekte)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Sekte</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $majelis->sekte }}</p>
                            </div>
                            @endif
                            @if($majelis->binaan)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Binaan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $majelis->binaan }}</p>
                            </div>
                            @endif
                            @if($majelis->ketua)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ketua</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $majelis->ketua }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm text-gray-300">Tanggal Terdaftar</p>
                                <p class="font-medium">{{ $majelis->tgl_terdaftar ? \Carbon\Carbon::parse($majelis->tgl_update)->format('d M Y') : '-' }}</p>
                            </div>
                            @if($majelis->keterangan)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Keterangan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $majelis->keterangan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
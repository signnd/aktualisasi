<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.okb.index') }}" 
                   class="inline-flex items-center text-teal-600 dark:text-teal-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar OKB
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $okb->nama_okb }}</h1>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Informasi Lokasi -->
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Lokasi
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kabupaten</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kecamatan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->kecamatan->kecamatan ?? '-' }}</p>
                            </div>
                            @if($okb->alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->alamat }}</p>
                            </div>
                            @endif
                            @if($okb->kelurahan)
                            <div>
                                <p class="text-sm text-gray-300">Kelurahan</p>
                                <p class="font-medium">{{ $okb->kelurahan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    @if($okb->ketua || $okb->tgl_terdaftar || $okb->no_registrasi)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($okb->ketua)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ketua</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->ketua }}</p>
                            </div>
                            @endif
                            @if($okb->tgl_tanda_daftar)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Terdaftar</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($okb->tgl_tanda_daftar)->format('d M Y') }}</p>
                            </div>
                            @endif
                            @if($okb->deskripsi)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">No. Registrasi</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->no_registrasi }}</p>
                            </div>
                            @endif
                            @if($okb->thn_berdiri)
                            <div>
                                <p class="text-sm text-gray-300">Tahun Berdiri</p>
                                <p class="font-medium">{{ $okb->thn_berdiri }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Status Eksisting</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $okb->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $okb->eksisting ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Tanggal Update</p>
                                <p class="font-medium">{{ $okb->tgl_update ? \Carbon\Carbon::parse($okb->tgl_update)->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Informasi Kontak -->
                    @if($okb->email || $okb->no_telp || $okb->media_sosial)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi Kontak
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($okb->email)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->email }}</p>
                            </div>
                            @endif
                            @if($okb->no_telp)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No Telp</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->no_telp }}</p>
                            </div>
                            @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($okb->media_sosial)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Media Sosial</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $okb->media_sosial }}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>   
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
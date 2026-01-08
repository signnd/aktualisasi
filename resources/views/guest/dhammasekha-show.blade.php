<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.riab.index', request()->only('search','kabupaten_id','page')) }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar RIAB
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $dhammasekha->nama }}</h1>
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
                                <p class="font-medium text-gray-900 dark:text-white">{{ $dhammasekha->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kecamatan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $dhammasekha->kecamatan->kecamatan ?? '-' }}</p>
                            </div>
                            @if($dhammasekha->alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $dhammasekha->alamat }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    @if($dhammasekha->ketua || $dhammasekha->tgl_terdaftar || $dhammasekha->deksripsi || $dhammasekha->jenis_riab || $dhammasekha->jumlah_umat || $dhammasekha->kondisi)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Jenis</p>
                            <p class="font-medium">{{ $dhammasekha->jenis ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat Lengkap</p>
                            <p class="font-medium">{{ $dhammasekha->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kabupaten</p>
                            <p class="font-medium">{{ $dhammasekha->kabupaten->kabupaten ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Berdiri</p>
                            <p class="font-medium">{{ $dhammasekha->tgl_berdiri ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">No. Izin Operasional</p>
                            <p class="font-medium">{{ $dhammasekha->no_izop ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">IZOP PPJG</p>
                            <p class="font-medium">{{ $dhammasekha->izop_ppjg ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Masa IZOP</p>
                            <p class="font-medium">{{ $dhammasekha->masa_izop ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal IZOP</p>
                            <p class="font-medium">{{ $dhammasekha->tgl_izop ? \Carbon\Carbon::parse($dhammasekha->tgl_izop)->format('d M Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Masa IZOP</p>
                            <p class="font-medium">{{ $dhammasekha->masa_izop ? \Carbon\Carbon::parse($dhammasekha->masa_izop)->format('d M Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">No. Statistik</p>
                            <p class="font-medium">{{ $dhammasekha->no_statistik ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Yayasan</p>
                            <p class="font-medium">{{ $dhammasekha->nama_yayasan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat Yayasan</p>
                            <p class="font-medium">{{ $dhammasekha->alamat_yayasan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">NPYP</p>
                            <p class="font-medium">{{ $dhammasekha->npyp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">NPSN</p>
                            <p class="font-medium">{{ $dhammasekha->npsn ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Akreditasi</p>
                            <p class="font-medium">{{ $dhammasekha->akreditasi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Siswa</p>
                            <p class="font-medium">{{ $dhammasekha->siswadhammasekha->count() }} orang</p>
                        </div>
                        @if($dhammasekha->jenis !== 'Dhammasekha Non Formal')
                        <div>
                            <p class="text-sm text-gray-500">Naungan Kemenag</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $dhammasekha->naungan_kemenag == 'Ya' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $dhammasekha->naungan_kemenag ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Naungan Dinas Pendidikan</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $dhammasekha->naungan_disdik == 'Ya' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $dhammasekha->naungan_disdik ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">TK Dinas Pendidikan KB Kemenag</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $dhammasekha->tk_disdik_kb_kemenag == 'Ya' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $dhammasekha->tk_disdik_kb_kemenag ?? '-' }}
                                </span>
                            </p>
                        </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-500">Kondisi Bangunan</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm 
                                    {{ $dhammasekha->kondisi == 'Sangat Baik' ? 'bg-green-100 text-green-800' : 
                                       ($dhammasekha->kondisi == 'Baik' ? 'bg-blue-100 text-blue-800' : 
                                       ($dhammasekha->kondisi == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($dhammasekha->kondisi == 'Rusak Sedang' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800'))) }}">
                                    {{ $dhammasekha->kondisi ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status Eksisting</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $dhammasekha->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $dhammasekha->eksisting ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status Verifikasi</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $dhammasekha->status_verifikasi == 'TRUE' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-100' }}">
                                    {{ $dhammasekha->status_verifikasi == 'TRUE' ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Update</p>
                            <p class="font-medium">{{ $dhammasekha->tgl_update ? \Carbon\Carbon::parse($dhammasekha->tgl_update)->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                <!-- Informasi Kontak -->
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-100 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        Informasi Kontak
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama PIC</p>
                            <p class="font-medium">{{ $dhammasekha->nama_pic ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">No. Telp/HP/WhatsApp</p>
                            <p class="font-medium">{{ $dhammasekha->no_hp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $dhammasekha->email ?? '-' }}</p>
                        </div>
                    </div>
                        </div>
                    </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
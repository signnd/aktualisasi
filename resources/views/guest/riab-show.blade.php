<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.riab.index') }}" 
                   class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar RIAB
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $riab->nama }}</h1>
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
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kecamatan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->kecamatan->kecamatan ?? '-' }}</p>
                            </div>
                            @if($riab->alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->alamat }}</p>
                            </div>
                            @endif
                            @if($riab->latitude && $riab->longitude)
                            <div>
                                <p class="text-sm text-gray-300">Koordinat (Lat, Long)</p>
                                <p class="font-medium">{{ $riab->latitude ?? '-' }}, {{ $riab->longitude ?? '-' }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    @if($riab->ketua || $riab->tgl_terdaftar || $riab->deskripsi || $riab->jenis_riab || $riab->jumlah_umat || $riab->kondisi)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($riab->ketua)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ketua</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->ketua }}</p>
                            </div>
                            @endif
                            @if($riab->tgl_tanda_daftar)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Terdaftar</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($riab->tgl_tanda_daftar)->format('d M Y') }}</p>
                            </div>
                            @endif
                            @if($riab->deskripsi)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Keterangan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->deskripsi }}</p>
                            </div>
                            @endif
                                                        <div>
                                <p class="text-sm text-gray-300">Jenis RIAB</p>
                                <p class="font-medium">{{ $riab->jenis_riab ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Jumlah Umat</p>
                                <p class="font-medium">{{ $riab->jumlah_umat ? number_format($riab->jumlah_umat) . ' orang' : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Kondisi Bangunan</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm 
                                        {{ $riab->kondisi == 'Sangat Baik' ? 'bg-green-100 text-green-800' : 
                                           ($riab->kondisi == 'Baik' ? 'bg-indigo-100 text-indigo-800' : 
                                           ($riab->kondisi == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($riab->kondisi == 'Rusak Sedang' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800'))) }}">
                                        {{ $riab->kondisi ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Status Eksisting</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $riab->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $riab->eksisting ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Tanggal Update</p>
                                <p class="font-medium">{{ $riab->tgl_update ? \Carbon\Carbon::parse($riab->tgl_update)->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Informasi Kontak -->
                    @if($riab->email || $riab->no_telp || $riab->media_sosial)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi Kontak
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($riab->email)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->email }}</p>
                            </div>
                            @endif
                            @if($riab->no_telp)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No Telp</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->no_telp }}</p>
                            </div>
                            @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($riab->media_sosial)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Media Sosial</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $riab->media_sosial }}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>   
                    <!-- Link Foto -->
                    @if($riab->link_foto)
                    <div class="pb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Foto
                        </h2>
                        @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $riab->link_foto;
                            $fileId = null;
                            $isGoogleDrive = false;
                            $isDirectImage = false;
                            
                            // Cek apakah URL dari Google Drive
                            if (strpos($imageUrl, 'drive.google.com') !== false) {
                                $isGoogleDrive = true;
                                // Extract file ID dari berbagai format URL Google Drive
                                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $imageUrl, $matches)) {
                                    $fileId = $matches[1];
                                } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $imageUrl, $matches)) {
                                    $fileId = $matches[1];
                                }
                                
                                if ($fileId) {
                                    // Gunakan format direct image dari lh3.googleusercontent.com
                                    $imageUrl = "https://lh3.googleusercontent.com/d/{$fileId}";
                                }
                            } 
                            // Cek apakah URL langsung ke gambar (jpg, jpeg, png, gif, webp, svg)
                            elseif (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)(\?.*)?$/i', $imageUrl)) {
                                $isDirectImage = true;
                            }
                        @endphp
                        
                        <div class="space-y-3">
                            @if($isGoogleDrive && $fileId)
                                <!-- Google Drive Image dengan fallback ke iframe -->
                                <div class="relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50">
                                    <!-- Fallback: Google Drive Viewer (iframe) -->
                                    <iframe 
                                            src="https://drive.google.com/file/d/{{ $fileId }}/preview" 
                                            class="w-full h-96"
                                            style="display: none; border: none;"
                                            allow="autoplay"></iframe>
                                </div>
                            @elseif($isDirectImage)
                                <!-- Direct Image URL -->
                                <div class="relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50">
                                    <img src="{{ $imageUrl }}" 
                                         alt="Foto {{ $riab->nama }}"
                                         class="w-full h-auto max-h-96 object-contain mx-auto"
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-96 text-gray-500\'><div class=\'text-center\'><svg class=\'w-16 h-16 mx-auto mb-4 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg><p class=\'text-sm\'>Gambar tidak dapat dimuat</p><p class=\'text-xs text-gray-400 mt-1\'>URL gambar mungkin tidak valid atau tidak dapat diakses</p></div></div>';">
                                </div>
                            @else
                                <!-- URL tidak dikenali atau format tidak didukung -->
                                <div class="relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50 p-10">
                                    <div class="text-center text-gray-500">
                                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                        <p class="font-medium">Format link tidak didukung</p>
                                        <p class="text-sm mt-1">Silakan gunakan link Google Drive atau URL gambar langsung</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Link to original -->
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <a href="{{ $riab->link_foto }}" target="_blank" 
                                   class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
                                    </svg>
                                    @if($isGoogleDrive)
                                        Buka di Google Drive
                                    @else
                                        Buka Gambar Asli
                                    @endif
                                </a>         

                            </div>
                        </div>
                    </div>
                        </a>
                    @endif
                @if($riab->riabdetail)
                    <!-- Informasi Detail Tanah & Bangunan -->
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-950 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Tanah & Bangunan
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-300">Status Tanah</p>
                                <p class="font-medium">{{ $riab->riabdetail->status_tanah ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-300">Sertifikasi Tanah</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $riab->riabdetail->sertifikasi_tanah == 'Sudah' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $riab->riabdetail->sertifikasi_tanah ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-300">Luas Tanah</p>
                                <p class="font-medium">{{ $riab->riabdetail->luas_tanah ? $riab->riabdetail->luas_tanah . ' m²' : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-300">Luas Bangunan</p>
                                <p class="font-medium">{{ $riab->riabdetail->luas_bangunan ? $riab->riabdetail->luas_bangunan . ' m²' : '-' }}</p>
                            </div>
                            @php
                                $kondisiGeo = is_array($riab->riabdetail->kondisi_geografis) 
                                    ? $riab->riabdetail->kondisi_geografis 
                                    : (is_string($riab->riabdetail->kondisi_geografis) 
                                        ? json_decode($riab->riabdetail->kondisi_geografis, true) ?? [] 
                                        : []);
                                $petaRawan = is_array($riab->riabdetail->peta_rawan_bencana) 
                                    ? $riab->riabdetail->peta_rawan_bencana 
                                    : (is_string($riab->riabdetail->peta_rawan_bencana) 
                                        ? json_decode($riab->riabdetail->peta_rawan_bencana, true) ?? [] 
                                        : []);
                            @endphp
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-300">Kondisi Geografis</p>
                                <p class="font-medium">
                                    @if(!empty($kondisiGeo))
                                        {{ implode(', ', $kondisiGeo) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-300">Peta Rawan Bencana</p>
                                <p class="font-medium">
                                    @if(!empty($petaRawan))
                                        {{ implode(', ', $petaRawan) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                                        <!-- Fasilitas -->
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-950 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
                            </svg>
                            Fasilitas & Kelengkapan
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @php
                                $fasilitas = [
                                    'lahan_parkir' => 'Lahan Parkir',
                                    'toilet_disable' => 'Toilet Difabel',
                                    'kursi_roda' => 'Kursi Roda',
                                    'jalur_kursi_roda' => 'Jalur Kursi Roda',
                                    'fasilitas_jalur_kursi_roda' => 'Fasilitas Jalur Kursi Roda',
                                    'lift' => 'Sarana Lift',
                                    'tempat_bermain' => 'Tempat Bermain',
                                    'toilet_anak' => 'Toilet Anak',
                                    'wastafel_anak' => 'Wastafel Anak',
                                    'ruang_ac' => 'Ruang AC',
                                    'tempat_duduk_lansia' => 'Tempat Duduk Ramah Lansia',
                                    'perpustakaan' => 'Perpustakaan',
                                    'alas_duduk' => 'Alas Duduk',
                                    'sound_system' => 'Sound System',
                                    'lcd_proyektor' => 'LCD Proyektor',
                                    'ruang_laktasi' => 'Ruang Laktasi',
                                ];
                            @endphp
                            @foreach($fasilitas as $key => $label)
                                <div class="flex items-center space-x-2">
                                    @if($riab->riabdetail->$key == 'Ada')
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    <span class="text-sm">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Statistik -->
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-950 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                            Statistik & Data Pengelolaan
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg text-center">
                                <p class="text-2xl font-bold text-blue-600">{{ $riab->riabdetail->jumlah_pengelola_riab ?? 0 }}</p>
                                <p class="text-sm text-gray-800">Pengelola RIAB</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg text-center">
                                <p class="text-2xl font-bold text-green-600">{{ $riab->riabdetail->jumlah_pengelola_perpustakaan ?? 0 }}</p>
                                <p class="text-sm text-gray-800">Pengelola Perpustakaan</p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg text-center">
                                <p class="text-2xl font-bold text-purple-600">{{ $riab->riabdetail->jumlah_kitab_suci ?? 0 }}</p>
                                <p class="text-sm text-gray-800">Kitab Suci</p>
                            </div>
                            <div class="bg-orange-50 p-4 rounded-lg text-center">
                                <p class="text-2xl font-bold text-orange-600">{{ $riab->riabdetail->jumlah_buku_keagamaan ?? 0 }}</p>
                                <p class="text-sm text-gray-800">Buku Keagamaan</p>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</x-guest-layout>
<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.guru-penda.index') }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Guru
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $guruPenda->nama_guru }}</h1>
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
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kabupaten</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $guruPenda->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            @if($guruPenda->alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $guruPenda->alamat }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($guruPenda->nip)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">NIP</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $guruPenda->nip }}</p>
                            </div>
                            @endif
                            @if($guruPenda->nrg)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">NRG</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $guruPenda->nrg }}</p>
                            </div>
                            @endif
                            @if($guruPenda->tgl_tanda_daftar)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tempat, Tanggal Lahir</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $guruPenda->tempat_lahir }},  {{ \Carbon\Carbon::parse($guruPenda->tgl_tanda_daftar)->format('d M Y') }}</p>
                            </div>
                            @endif
                            @if($guruPenda->deskripsi)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $guruPenda->email }}</p>
                            </div>
                            @endif                   
                            <div>
                                <p class="text-sm text-gray-300">Status Pegawai</p>
                                <p class="font-medium">{{ $guruPenda->status_pegawai ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Tanggal Update</p>
                                <p class="font-medium">{{ $guruPenda->tgl_update ? \Carbon\Carbon::parse($guruPenda->tgl_update)->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Informasi Kontak -->
                    @if($guruPenda->email || $guruPenda->no_telp)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi
                        </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php
                                $nama_sekolah_sd = is_array($guruPenda->nama_sekolah_sd) 
                                    ? $guruPenda->nama_sekolah_sd 
                                    : (is_string($guruPenda->nama_sekolah_sd) 
                                        ? json_decode($guruPenda->nama_sekolah_sd, true) ?? [] 
                                        : []);
                                $alamat_sekolah_sd = is_array($guruPenda->alamat_sekolah_sd) 
                                    ? $guruPenda->alamat_sekolah_sd 
                                    : (is_string($guruPenda->alamat_sekolah_sd) 
                                        ? json_decode($guruPenda->alamat_sekolah_sd, true) ?? [] 
                                        : []);
                                $nama_sekolah_smp = is_array($guruPenda->nama_sekolah_smp) 
                                    ? $guruPenda->nama_sekolah_smp 
                                    : (is_string($guruPenda->nama_sekolah_smp) 
                                        ? json_decode($guruPenda->nama_sekolah_smp, true) ?? [] 
                                        : []);
                                $alamat_sekolah_smp = is_array($guruPenda->alamat_sekolah_smp) 
                                    ? $guruPenda->alamat_sekolah_smp 
                                    : (is_string($guruPenda->alamat_sekolah_smp) 
                                        ? json_decode($guruPenda->alamat_sekolah_smp, true) ?? [] 
                                        : []);
                                $nama_sekolah_sma = is_array($guruPenda->nama_sekolah_sma) 
                                    ? $guruPenda->nama_sekolah_sma 
                                    : (is_string($guruPenda->nama_sekolah_sma) 
                                        ? json_decode($guruPenda->nama_sekolah_sma, true) ?? [] 
                                        : []);
                                $alamat_sekolah_sma = is_array($guruPenda->alamat_sekolah_sma) 
                                    ? $guruPenda->alamat_sekolah_sma 
                                    : (is_string($guruPenda->alamat_sekolah_sma) 
                                        ? json_decode($guruPenda->alamat_sekolah_sma, true) ?? [] 
                                        : []);
                            @endphp
                            <div>
                                <p class="text-sm text-gray-300">SD tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($nama_sekolah_sd))
                                        {{ implode(', ', $nama_sekolah_sd) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Alamat SD tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($alamat_sekolah_sd))
                                        {{ implode(', ', $alamat_sekolah_sd) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">SMP tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($nama_sekolah_smp))
                                        {{ implode(', ', $nama_sekolah_smp) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Alamat SMP tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($alamat_sekolah_smp))
                                        {{ implode(', ', $alamat_sekolah_smp) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">SMA/SMK tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($nama_sekolah_sma))
                                        {{ implode(', ', $nama_sekolah_sma) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">SMA tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($alamat_sekolah_sma))
                                        {{ implode(', ', $alamat_sekolah_sma) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        <div>
                            <p class="text-sm text-gray-300">Sertifikasi</p>
                            <p class="font-medium">{{ $guruPenda->sertifikasi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300">Tanggal Sertifikasi</p>
                            <p class="font-medium">{{ $guruPenda->tgl_sertifikasii ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300">Mata Pelajaran yang Tersertifikasi</p>
                            <p class="font-medium">{{ $guruPenda->mapel_sertifikasi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300">Pendidikan Terakhir</p>
                            <p class="font-medium">{{ $guruPenda->pendidikan_terakhir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300">Link Sertifikat Sertifikasi</p>
                            @if($guruPenda->link_sertifikasi)
                            <div>
                                <a href="{{ $guruPenda->link_sertifikasi }}" target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                    Lihat
                                </a>
                            </div>
                            @else
                            <p class="font-medium">Belum ada</p>
                            @endif
                        </div>

                        @endif
                    </div>
                </div>   
                    <!-- Link Foto -->
                    @if($guruPenda->foto)
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-100 mb-3">Foto</h4>
                        <a href="{{ $guruPenda->foto }}" target="_blank" class="text-blue-600 hover:underline">
                            @endif
                    <!-- Link Foto -->
                    @if($guruPenda->foto)
                    <div class="border-b pb-4">
                        @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $guruPenda->foto;
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
                                    $imageUrl = "https://lh3.googleusercontent.com/d/{$fileId}=s300";
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
                                <div class="relative rounded-lg overflow-hidden">
                                    <img id="main-image" 
                                         src="{{ $imageUrl }}" 
                                         alt="Foto {{ $guruPenda->nama }}"
                                         class="w-full h-auto max-h-96 object-contain mx-auto"
                                         style="display: block;"
                                         onerror="showIframeViewer('main-image', 'iframe-viewer-main', '{{ $fileId }}')"> 
                                    
                                    <!-- Fallback: Google Drive Viewer (iframe) 
                                    <iframe id="iframe-viewer-main"
                                            src="https://drive.google.com/file/d/{{ $fileId }}/preview" 
                                            class="w-full h-96"
                                            style="display: none; border: none;"
                                            allow="autoplay"></iframe> -->
                                </div>
                            @elseif($isDirectImage)
                                <!-- Direct Image URL -->
                                <div class="relative rounded-lg overflow-hidden">
                                    <img src="{{ $imageUrl }}" 
                                         alt="Foto {{ $guruPenda->nama }}"
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
                                <a href="{{ $guruPenda->foto }}" target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
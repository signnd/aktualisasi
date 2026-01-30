<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.pusdiklat.index', array_merge(request()->only('search','kabupaten_id'), ['page' => request('page', session('pusdiklat_page', 1))])) }}" 
                   class="inline-flex items-center text-emerald-600 dark:text-emerald-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Pusdiklat
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $pusdiklat->nama }}</h1>
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
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            @if($pusdiklat->alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->alamat }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    @if($pusdiklat->didirikan || $pusdiklat->izop_1 || $pusdiklat->ppjg_1 || $pusdiklat->ppjg_2 || $pusdiklat->no_statistik || $pusdiklat->tgl_izop || $pusdiklat->masa_izop
                     || $pusdiklat->bapen || $pusdiklat->alamat_bapen || $pusdiklat->nama_pic || $pusdiklat->no_telp || $pusdiklat->jumlah_siswa
                     || $pusdiklat->status || $pusdiklat->eksisting || $pusdiklat->kondisi || $pusdiklat->foto || $pusdiklat->tgl_update || $pusdiklat->status_verifikasi)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($pusdiklat->didirikan)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ketua</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->didirikan }}</p>
                            </div>w
                            @endif
                            @if($pusdiklat->izop_1)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Keterangan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->izop_1 }}</p>
                            </div>
                            @endif
                            @if($pusdiklat->ppjg_1)
                            <div>
                                <p class="text-sm text-gray-500">PPJG 1</p>
                                <p class="font-medium">{{ $pusdiklat->ppjg_1 ?? '-' }}</p>
                            </div>
                            @endif
                            @if($pusdiklat->ppjg_2)
                            <div>
                                <p class="text-sm text-gray-500">PPJG 2</p>
                                <p class="font-medium">{{ $pusdiklat->ppjg_2 ?? '-' }}</p>
                            </div>
                            @endif
                            @if($pusdiklat->no_statistik)
                            <div>
                                <p class="text-sm text-gray-500">No. Statistik</p>
                                <p class="font-medium">{{ $pusdiklat->no_statistik ?? '-' }}</p>
                            </div>
                            @endif
                            @if($pusdiklat->tgl_izop)
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Izin Operasional</p>
                                <p class="font-medium">{{ $pusdiklat->tgl_izop ? \Carbon\Carbon::parse($pusdiklat->tgl_izop)->format('d M Y') : '-' }}</p>
                            </div>
                            @endif
                            @if($pusdiklat->masa_izop)
                            <div>
                                <p class="text-sm text-gray-500">Masa Izin Operasional</p>
                                <p class="font-medium">{{ $pusdiklat->masa_izop ?? '-' }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm text-gray-500">Jumlah Siswa</p>
                                <p class="font-medium">{{ $pusdiklat->jml_siswa ?? 'Belum ada' }} siswa</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status Eksisting</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $pusdiklat->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $pusdiklat->eksisting ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Update</p>
                                <p class="font-medium">{{ $pusdiklat->tgl_update ? \Carbon\Carbon::parse($pusdiklat->tgl_update)->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Informasi Kontak -->
                    @if($pusdiklat->bapen || $pusdiklat->alamat_bapen || $pusdiklat->nama_pic || $pusdiklat->no_telp)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi Kontak
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($pusdiklat->bapen)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Bapen</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->bapen }}</p>
                            </div>
                            @endif
                            @if($pusdiklat->alamat_bapen)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Bapen</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->alamat_bapen }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-4">
                            @if($pusdiklat->nama_pic)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nama PIC</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->nama_pic }}</p>
                            </div>
                            @endif
                            @if($pusdiklat->no_hp)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No Telpon/HP/WhatsApp</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $pusdiklat->no_hp }}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                    <!-- Link Foto -->
                    @if($pusdiklat->foto)
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-100 mb-3">Dokumentasi</h4>
                        <a href="{{ $pusdiklat->foto }}" target="_blank" class="text-emerald-600 hover:underline">
                            @endif
                    <!-- Link Foto -->
                    @if($pusdiklat->foto)
                    <div class="border-b pb-4">
                        @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $pusdiklat->foto;
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
                                         alt="Foto {{ $pusdiklat->nama }}"
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
                                         alt="Foto {{ $pusdiklat->nama_pusdiklat }}"
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
                                <a href="{{ $pusdiklat->foto }}" target="_blank" 
                                   class="inline-flex items-center text-emerald-600 hover:text-emerald-800 transition">
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
                    </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
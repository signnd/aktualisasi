<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.smb.index') }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar SMB
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $smb->nama_smb }}</h1>
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
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            @if($smb->alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->alamat }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    @if($smb->didirikan || $smb->izop_1 || $smb->ppjg_1 || $smb->ppjg_2 || $smb->nssmb || $smb->tgl_izop || $smb->masa_izop
                     || $smb->bapen || $smb->alamat_bapen || $smb->nama_pic || $smb->no_telp || $smb->jumlah_siswa
                     || $smb->status || $smb->eksisting || $smb->kondisi || $smb->link_foto || $smb->tgl_update || $smb->status_verifikasi)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($smb->didirikan)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ketua</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->didirikan }}</p>
                            </div>
                            @endif
                            @if($smb->tgl_update)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Update</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($smb->tgl_update)->format('d M Y') }}</p>
                            </div>
                            @endif
                            @if($smb->izop_1)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Keterangan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->izop_1 }}</p>
                            </div>
                            @endif
                            @if($smb->ppjg_1)
                            <div>
                                <p class="text-sm text-gray-300">PPJG 1</p>
                                <p class="font-medium">{{ $smb->ppjg_1 ?? '-' }}</p>
                            </div>
                            @endif
                            @if($smb->ppjg_2)
                            <div>
                                <p class="text-sm text-gray-300">PPJG 2</p>
                                <p class="font-medium">{{ $smb->ppjg_2 ?? '-' }}</p>
                            </div>
                            @endif
                            @if($smb->nssmb)
                            <div>
                                <p class="text-sm text-gray-300">NSSMB</p>
                                <p class="font-medium">{{ $smb->nssmb ?? '-' }}</p>
                            </div>
                            @endif
                            @if($smb->tgl_izop)
                            <div>
                                <p class="text-sm text-gray-300">Tanggal Izin Operasional</p>
                                <p class="font-medium">{{ $smb->tgl_izop ? \Carbon\Carbon::parse($smb->tgl_izop)->format('d M Y') : '-' }}</p>
                            </div>
                            @endif
                            @if($smb->masa_izop)
                            <div>
                                <p class="text-sm text-gray-300">Masa Izin Operasional</p>
                                <p class="font-medium">{{ $smb->masa_izop ?? '-' }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm text-gray-300">Jumlah Siswa</p>
                                <p class="font-medium">{{ $smb->jumlah_siswa ? number_format($smb->jumlah_siswa) . ' siswa' : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Status Eksisting</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $smb->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $smb->eksisting ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Tanggal Update</p>
                                <p class="font-medium">{{ $smb->tgl_update ? \Carbon\Carbon::parse($smb->tgl_update)->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Informasi Kontak -->
                    @if($smb->bapen || $smb->alamat_bapen || $smb->nama_pic || $smb->no_telp)
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi Kontak
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($smb->bapen)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Bapen</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->bapen }}</p>
                            </div>
                            @endif
                            @if($smb->alamat_bapen)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Bapen</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->alamat_bapen }}</p>
                            </div>
                            @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($smb->nama_pic)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nama PIC</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->nama_pic }}</p>
                            </div>
                            @endif
                            @if($smb->no_telp)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No Telpon</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $smb->no_telp }}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>   
                    <!-- Link Foto -->
                    @if($smb->link_foto)
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-100 mb-3">Dokumentasi</h4>
                        <a href="{{ $smb->link_foto }}" target="_blank" class="text-blue-600 hover:underline">
                            @endif
                    <!-- Link Foto -->
                    @if($smb->link_foto)
                    <div class="border-b pb-4">
                        @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $smb->link_foto;
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
                                         alt="Foto {{ $smb->nama }}"
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
                                         alt="Foto {{ $smb->nama_smb }}"
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
                                <a href="{{ $smb->link_foto }}" target="_blank" 
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
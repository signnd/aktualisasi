<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            {{ __('Detail okb') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray- shadow-lg overflow-hidden">
                <!-- Action Buttons -->
                <div class="px-6 py-4 flex justify-between items-center">
                    <a href="{{ route('okb.index', ['page' => session('okb_page', 1)]) }}" 
                       class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                        ← Kembali
                    </a>
                    @if(auth()->user()->kabupaten_id === $okb->kabupaten_id || auth()->user()->user_role === 'admin')
                    <a href="{{ route('okb.edit', $okb) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        Edit Data
                    </a>
                    @endif
                </div>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h3 class="text-2xl font-bold">{{ $okb->nama_okb }}</h3>
                    <p class="text-sm mt-1 opacity-90">No. Registrasi: {{ $okb->no_registrasi ?? '-' }}</p>
                </div>

                <div class="p-6 space-y-6">
                    
                    <!-- Informasi Lokasi -->
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Lokasi
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Kabupaten</p>
                                <p class="font-medium">{{ $okb->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Kecamatan</p>
                                <p class="font-medium">{{ $okb->kecamatan->kecamatan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Kelurahan/Desa</p>
                                <p class="font-medium">{{ $okb->kelurahan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Kategori 3T</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $okb->kategori_3t == '3T' ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $okb->kategori_3t ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-600 dark:text-gray-300">Alamat Lengkap</p>
                                <p class="font-medium">{{ $okb->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Ketua</p>
                                <p class="font-medium">{{ $okb->ketua ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Tahun Berdiri</p>
                                <p class="font-medium">{{ $okb->thn_berdiri ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal Penerbitan Tanda Daftar</p>
                                <p class="font-medium">{{ $okb->tgl_tanda_daftar ? \Carbon\Carbon::parse($okb->tgl_tanda_daftar)->format('d M Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Jenis Kelembagaan</p>
                                <p class="font-medium">{{ $okb->jenis_kelembagaan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Status</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm 
                                        {{ $okb->status == 'disetujui' ? 'bg-green-100 text-green-800' : 
                                           ($okb->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $okb->status ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Status Eksisting</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $okb->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $okb->eksisting ?? '-' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Status Verifikasi</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-sm {{ $okb->status_verifikasi == 'TRUE' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 dark:text-gray-100' }}">
                                        {{ $okb->status_verifikasi == 'TRUE' ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal Update</p>
                                <p class="font-medium">{{ $okb->tgl_update ? \Carbon\Carbon::parse($okb->tgl_update)->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi Kontak
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Email</p>
                                <p class="font-medium">{{ $okb->email ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">No. Telp/HP/WhatsApp</p>
                                <p class="font-medium">{{ $okb->no_telp ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-600 dark:text-gray-300">Media Sosial</p>
                                <p class="font-medium">{{ $okb->media_sosial ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($okb->logo_okb)
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3">Dokumentasi Foto SIORI</h4>
                        @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $okb->logo_okb;
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
                                    <img id="main-image" 
                                         src="{{ $imageUrl }}" 
                                         alt="Foto {{ $okb->nama_okb }}"
                                         class="w-full h-auto max-h-96 object-contain mx-auto"
                                         style="display: block;"
                                         onerror="showIframeViewer('main-image', 'iframe-viewer-main', '{{ $fileId }}')">
                                    
                                    <!-- Fallback: Google Drive Viewer (iframe) -->
                                    <iframe id="iframe-viewer-main"
                                            src="https://drive.google.com/file/d/{{ $fileId }}/preview" 
                                            class="w-full h-96"
                                            style="display: none; border: none;"
                                            allow="autoplay"></iframe>
                                </div>
                            @elseif($isDirectImage)
                                <!-- Direct Image URL -->
                                <div class="relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50">
                                    <img src="{{ $imageUrl }}" 
                                         alt="Foto {{ $okb->nama_okb }}"
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
                                <a href="{{ $okb->logo_okb }}" target="_blank" 
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
                                
                                @if($fileId)
                                <a href="https://drive.google.com/uc?export=download&id={{ $fileId }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Download
                                </a>
                                @elseif($isDirectImage)
                                <a href="{{ $imageUrl }}" 
                                   download
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Download
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Periode Update SISFO</p>
                                <p class="font-medium">{{ $okb->update_sisfo ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                </div>
</div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Fallback Image Viewer -->
    <script>
        function showIframeViewer(imageId, iframeId, fileId) {
            // Sembunyikan gambar yang error
            const imgElement = document.getElementById(imageId);
            if (imgElement) {
                imgElement.style.display = 'none';
            }
            
            // Tampilkan iframe viewer sebagai fallback
            const iframeElement = document.getElementById(iframeId);
            if (iframeElement) {
                iframeElement.style.display = 'block';
            }
        }
    </script>
</x-app-layout>
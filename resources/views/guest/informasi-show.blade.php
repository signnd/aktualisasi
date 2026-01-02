<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.informasi.index') }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Informasi
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $informasi->judul }}</h1>
                    <h3 class="font-medium py-2 text-gray-300">{{ $informasi->ringkasan ?? '-' }}</h3>
                </div>
                @if($informasi->foto)
                    <div class="border-b py-4">
                        <a href="{{ $informasi->link_foto }}" target="_blank" class="text-blue-600 hover:underline">
                    @endif
                    <!-- Link Foto -->
                    @if($informasi->foto)
                    <div class="border-b pb-4">
                        @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $informasi->foto;
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
                                <div class="relative rounded-lg overflow-hidden bg-gray-100/0">
                                    <img id="main-image" 
                                         src="{{ $imageUrl }}" 
                                         alt="Foto {{ $informasi->judul }}"
                                         class="w-full h-auto max-h-96 object-contain mx-auto"
                                         style="display: block;"
                                         onerror="showIframeViewer('main-image', 'iframe-viewer-main', '{{ $fileId }}')">
                                    
                                    <!-- Fallback: Google Drive Viewer (iframe) -->
                                    <iframe id="iframe-viewer-main"
                                            src="https://drive.google.com/file/d/{{ $fileId }}/preview" 
                                            class="w-full h-96"
                                            style="display: none; border: none;"
                                            allow="autoplay"></iframe>
                                </div></a>
                            @else
                                <!-- URL tidak dikenali atau format tidak didukung -->
                            @endif
                        @else
                        @endif
                    </div>
                <div class="p-6 space-y-6">
                    
                    <!-- Informasi -->
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $informasi->teks ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Penulis</p>
                            <p class="font-medium">{{ $informasi->users->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Dibuat</p>
                            <p class="font-medium">{{ $informasi->created_at ? \Carbon\Carbon::parse($informasi->created_at)->format('d M Y H:m') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Terakhir diperbarui</p>
                            <p class="font-medium">{{ $informasi->updated_at ? \Carbon\Carbon::parse($informasi->updated_at)->format('d M Y H:m') : '-' }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
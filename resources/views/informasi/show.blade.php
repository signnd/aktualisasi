<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            {{ __('Detail Informasi') }}
        </h2>
</x-slot>

<div class="py-6">


    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray- shadow-lg overflow-hidden">
            <!-- Action Buttons -->
            <div class="px-6 py-4 flex justify-between items-center">
                <a href="{{ route('informasi.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    ← Kembali
                </a>
                @if(auth()->user()->id === $informasi->user_id || auth()->user()->user_role === 'admin')
                <a href="{{ route('informasi.edit', $informasi) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Edit Informasi
                </a>
                @endif
            </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                <h3 class="text-2xl font-bold">{{ $informasi->judul }}</h3>
                <p class="font-medium">{{ $informasi->ringkasan ?? '-' }}</p>
            </div>
                @if($informasi->foto)
                    <div class="border-b p-4">
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

            <div class="p-6 space-y-6"> <!-- informasi -->

                <!-- Informasi Umum -->
                <div class="border-b pb-4">
                    <div>
                        <p class="text-md text-gray-600 dark:text-gray-300"></p>
                        <p class="font-medium">{{ $informasi->teks ?? '-' }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Kategori</p>
                        <p class="font-medium">{{ $informasi->kategori ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Penulis</p>
                        <p class="font-medium">{{ $informasi->users->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Pertama dibuat</p>
                        <p class="font-medium">{{ $informasi->created_at ? \Carbon\Carbon::parse($informasi->created_at)->format('d M Y H:m') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Terakhir diperbarui</p>
                        <p class="font-medium">{{ $informasi->updated_at ? \Carbon\Carbon::parse($informasi->updated_at)->format('d M Y H:m') : '-' }}</p>
                    </div>
                </div>
                </div>
            </div>




            </div> <!-- end informasi -->
        </div> <!-- end container informasi --> 
    </div> <!-- end container keseluruhan halaman termasuk tombol kembali & edit -->
</div>

</x-app-layout>

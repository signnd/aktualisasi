<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.informasi.index', array_merge(request()->only('search','kategori'), ['page' => request('page', session('informasi_page', 1))])) }}" 
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
                @php
                    $photoUrls = [];

                    foreach (($informasi->fotos ?? []) as $photo) {
                        $storagePosition = strpos($photo, '/storage/');

                        if ($storagePosition !== false) {
                            $photoUrls[] = substr($photo, $storagePosition);
                        }
                    }

                    $externalImageUrl = $informasi->foto;
                    $legacyStoragePosition = $externalImageUrl ? strpos($externalImageUrl, '/storage/') : false;

                    if ($legacyStoragePosition !== false) {
                        $legacyPhotoUrl = substr($externalImageUrl, $legacyStoragePosition);

                        if (! in_array($legacyPhotoUrl, $photoUrls, true)) {
                            $photoUrls[] = $legacyPhotoUrl;
                        }

                        $externalImageUrl = null;
                    }

                    $externalFileId = null;
                    $isGoogleDrive = $externalImageUrl && str_contains($externalImageUrl, 'drive.google.com');

                    if ($isGoogleDrive) {
                        if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $externalImageUrl, $matches)) {
                            $externalFileId = $matches[1];
                        } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $externalImageUrl, $matches)) {
                            $externalFileId = $matches[1];
                        }

                        if ($externalFileId) {
                            $externalImageUrl = "https://lh3.googleusercontent.com/d/{$externalFileId}";
                        }
                    }
                @endphp

                @if(count($photoUrls) > 0 || $externalImageUrl)
                    <div class="p-4 border-b border-gray-200 dark:border-zinc-700">
                        <x-informasi-photo-carousel :photos="$photoUrls" :title="$informasi->judul" />

                        @if($externalImageUrl)
                            <div class="{{ count($photoUrls) > 0 ? 'mt-3' : '' }}">
                                @if($isGoogleDrive && $externalFileId)
                                    <div class="relative rounded-lg overflow-hidden bg-gray-50 dark:bg-zinc-900">
                                        <img id="main-image"
                                             src="{{ $externalImageUrl }}"
                                             alt="Foto {{ $informasi->judul }}"
                                             class="w-full h-auto max-h-96 object-contain mx-auto"
                                             onerror="showIframeViewer('main-image', 'iframe-viewer-main', '{{ $externalFileId }}')">
                                        <iframe id="iframe-viewer-main"
                                                src="https://drive.google.com/file/d/{{ $externalFileId }}/preview"
                                                class="w-full h-96 hidden"
                                                style="border: none;"
                                                allow="autoplay"></iframe>
                                    </div>
                                @else
                                    <a href="{{ $externalImageUrl }}" target="_blank" class="block">
                                        <img src="{{ $externalImageUrl }}"
                                             alt="Foto {{ $informasi->judul }}"
                                             class="w-full h-auto max-h-96 object-contain mx-auto rounded-lg"
                                             onerror="this.parentElement.classList.add('hidden')">
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                <div class="p-6 space-y-6">
                    
                    <!-- Informasi -->
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <div>
                            <p class="font-normal text-gray-900 dark:text-white whitespace-pre-wrap">{{ $informasi->teks ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-500">Penulis</p>
                            <p class="font-medium">{{ $informasi->users->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-500">Dibuat</p>
                            <p class="font-medium">{{ $informasi->created_at ? \Carbon\Carbon::parse($informasi->created_at)->format('d M Y H:m') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-500">Terakhir diperbarui</p>
                            <p class="font-medium">{{ $informasi->updated_at ? \Carbon\Carbon::parse($informasi->updated_at)->format('d M Y H:m') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function showIframeViewer(imageId, iframeId, fileId) {
        const image = document.getElementById(imageId);
        const iframe = document.getElementById(iframeId);

        if (!image || !iframe) {
            return;
        }

        image.style.display = 'none';
        iframe.src = `https://drive.google.com/file/d/${fileId}/preview`;
        iframe.classList.remove('hidden');
        iframe.style.display = 'block';
    }
</script>

</x-guest-layout>

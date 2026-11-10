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
                    <div class="border-b p-4">
                        <x-informasi-photo-carousel :photos="$photoUrls" :title="$informasi->judul" />

                        @if($externalImageUrl)
                            <div class="{{ count($photoUrls) > 0 ? 'mt-3' : '' }}">
                                @if($isGoogleDrive && $externalFileId)
                                    <div class="relative rounded-lg overflow-hidden bg-gray-50 dark:bg-zinc-800">
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

            <div class="p-6 space-y-6"> <!-- informasi -->

                <!-- Informasi Umum -->
                <div class="border-b pb-4">
                    <div>
                        <p class="text-md text-gray-600 dark:text-gray-300"></p>
                        <p class="font-normal whitespace-pre-wrap">{{ $informasi->teks ?? '-' }}</p>
                    </div>
                        <a href="{{ $informasi->foto }}" target="_blank" class="font-normal inline-flex text-blue-600 hover:text-blue-800 transition">
                                <div>
                                    @if($isGoogleDrive)
                                        Dokumentasi lengkap dapat dilihat di sini
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
                                    </svg>
                                    @endif
                                </a>
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




            </div> <!-- end informasi -->
        </div> <!-- end container informasi --> 
    </div> <!-- end container keseluruhan halaman termasuk tombol kembali & edit -->
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

</x-app-layout>

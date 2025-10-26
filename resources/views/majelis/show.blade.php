<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Detail majelis Agama Buddha') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray- shadow-lg overflow-hidden">
                <!-- Action Buttons -->
                <div class="px-6 py-4 flex justify-between items-center">
                    <a href="{{ route('majelis.index') }}" 
                       class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                        ← Kembali
                    </a>
                    @if(auth()->user()->kabupaten_id === $majelis->kabupaten_id || auth()->user()->user_role === 'admin') 
                    <a href="{{ route('majelis.edit', $majelis) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        Edit Data
                    </a>
                    @endif
                </div>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h3 class="text-2xl font-bold">{{ $majelis->nama_majelis }}</h3>
                </div>

                <div class="p-6 space-y-6">

                    <!-- Informasi Umum -->
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-semibold text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-300">Kabupaten/Kota/Provinsi</p>
                                <p class="font-medium">{{ $majelis->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Tanggal Daftar</p>
                                <p class="font-medium">{{ $majelis->tgl_terdaftar ? \Carbon\Carbon::parse($majelis->tgl_terdaftar)->format('d M Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Ketua</p>
                                <p class="font-medium">{{ $majelis->ketua ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Sekte</p>
                                <p class="font-medium">{{ $majelis->sekte ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Binaan</p>
                                <p class="font-medium">{{ $majelis->binaan ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-300">Keterangan</p>
                                <p class="font-medium">{{ $majelis->keterangan ?? '-' }}</p>
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
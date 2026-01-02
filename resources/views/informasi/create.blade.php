<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-gray-200">
            {{ __('Tambah Informasi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Pesan error -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <strong>Terdapat kesalahan pada form:</strong>
                    </div>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-gray-100 dark:bg-gray-900 border border-gray-800 dark:border-gray-300 shadow-lg rounded-lg overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-6">
                    <h3 class="text-2xl font-bold">Tambah Informasi</h3>
                </div>

                <form action="{{ route('informasi.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <!-- Informasi Lokasi -->
                    <div class="mb-8">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Judul<span class="text-red-500">*</span></label>
                                <input type="text" name="judul" required
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Ringkasan (Opsional)</label>
                                <input type="text" name="ringkasan"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                    Kategori
                                </label>
                                <div class="flex items-center space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori" value="Informasi Publik"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Informasi Publik</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori" value="Informasi Internal"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Informasi Internal</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori" value="Informasi Lainnya"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Informasi Lainnya</span>
                                    </label>
                                </div>
                            </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Link Foto</label>
                            <p class="text-sm mb-1">Unggah gambar terkait informasi ini di Google Drive, kemudian bagikan/paste link foto tersebut di bawah ini</p>
                            <input type="url" name="foto"
                                   class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Teks<span class="text-red-500">*</span></label></label>
                            <textarea name="teks" required class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>

                    <!-- Informasi Lainnya -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal Update</label>
                                <input type="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg bg-gray-200 dark:bg-gray-700">                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Hidden Field -->
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t">
                    <a href="{{ route('informasi.index') }}" 
                       class="px-6 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>

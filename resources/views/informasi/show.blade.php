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
                        <p class="font-medium">{{ $informasi->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Pertama dibuat</p>
                        <p class="font-medium">{{ $informasi->created_at ? \Carbon\Carbon::parse($informasi->created_at)->format('d M Y H:m') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Terakhir diperbarui</p>
                        <p class="font-medium">{{ $informasi->updated_at ? \Carbon\Carbon::parse($informasi->updated_at)->format('d M Y H:m') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Link Foto</p>
                        @if($informasi->foto)
                        <div>
                            <a href="{{ $informasi->foto }}" target="_blank" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                                Lihat Foto
                            </a>
                        </div>
                        @else
                        <p class="font-medium">Tidak ada</p>
                        @endif
                    </div>
                </div>
            </div>




            </div> <!-- end informasi -->
        </div> <!-- end container informasi --> 
    </div> <!-- end container keseluruhan halaman termasuk tombol kembali & edit -->
</div>

</x-app-layout>

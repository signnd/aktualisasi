<x-guest-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.yayasan.index') }}" 
                   class="inline-flex items-center text-emerald-600 dark:text-emerald-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Yayasan Buddha
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 text-white p-6">
                    <h1 class="text-3xl font-bold">{{ $yayasan->nama_yayasan }}</h1>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Informasi Lokasi -->
                    <div class="border-b pb-4 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Informasi
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!--<div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kabupaten</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $yayasan->kabupaten->kabupaten ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kecamatan</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $yayasan->kecamatan->kecamatan ?? '-' }}</p>
                            </div>-->
                            @if($yayasan->ketua)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ketua</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $yayasan->ketua }}</p>
                            </div>
                            @endif
                            @if($yayasan->alamat)
                            <div>
                                <p class="text-sm text-gray-300">Alamat</p>
                                <p class="font-medium">{{ $yayasan->alamat }}</p>
                            </div>
                            @endif
                            @if($yayasan->tgl_terdaftar)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Terdaftar</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($yayasan->tgl_terdaftar)->format('d M Y') }}</p>
                            </div>
                            @endif
                            @if($yayasan->keterangan)
                            <div>
                                <p class="text-sm text-gray-300">Keterangan</p>
                                <p class="font-medium">{{ $yayasan->keterangan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
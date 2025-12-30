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
                </div>

                <div class="p-6 space-y-6">
                    <!-- Informasi -->
                    <div class="border-b pb-4 dark:border-zinc-700">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $informasi->teks ?? '-' }}</p>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
<div>
    <!-- Hero Section dengan Statistik -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-8 mb-6">
        <h1 class="text-3xl font-bold mb-2">Informasi Publik</h1>
        
    </div>

    <!-- Filter & Search -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 mb-6">
        <div class="space-y-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Pencarian
                    </label>
                    <input type="text" 
                        wire:model.live.debounce.200ms="search"
                        placeholder="Cari informasi..."
                        class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                </div>
            </div>

            <!-- Filter Aktif & Reset -->
        </div>
    </div>


    <!-- Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse(($informasis ?? collect()) as $info)
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow hover:shadow-md hover:bg-gray-50 dark:hover:bg-zinc-700 transition-all duration-300 overflow-hidden">
            <a href="{{ route('guest.informasi.show', $info) }}" >
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
                <h3 class="font-bold text-lg truncate" title="{{ $info->judul }}">{{ $info->judul }}</h3>
            </div>
            
            <!-- Content Card -->
            <div class="p-4 space-y-3">
                <!-- Lokasi -->
                <div class="flex items-start">
                    <div class="text-sm">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $info->ringkasan ?? '-' }}</p>
                        <p class="text-sm font-medium text-gray-400/80 dark:text-gray-200">{{ $info->updated_at ? \Carbon\Carbon::parse($info->updated_at)->format('d M Y') : '-' }}</p>
                    </div>

                </div>

            </div>
        </a>

        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-lg font-medium mb-2">
                    Tidak ada informasi yang ditemukan
                </p>
                <p class="text-gray-400 dark:text-gray-500 text-sm">
                    Belum ada informasi publik
                </p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        @if(isset($informasis) && method_exists($informasis, 'links'))
            {{ $informasis->links() }}
        @endif
    </div>
</div>
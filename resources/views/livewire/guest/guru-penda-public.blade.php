<div>
    <!-- Hero Section dengan Statistik -->
    <div class="bg-gradient-to-r from-violet-600 to-violet-800 text-white rounded-lg shadow-lg p-8 mb-6">
        <h1 class="text-3xl font-bold mb-2">Guru Pendidikan Agama Buddha</h1>
        <p class="text-violet-100 mb-6">Database Guru Pendidikan Agama Buddha di Provinsi Bali</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-violet-100">Total Guru</p>
                        <p class="text-2xl font-bold">{{ number_format($totalGuruPenda) }}</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 mb-6">
        <div class="space-y-4">
            <!-- Filter Kabupaten -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Filter Kabupaten
                    </label>
                    <select wire:model.live="kabupaten_id"
                            class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                        <option value="">Semua Kabupaten/Kota</option>
                        @foreach($kabupatens as $kab)
                            <option value="{{ $kab->id }}">{{ $kab->kabupaten }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Pencarian
                    </label>
                    <input type="text" 
                           wire:model.live.debounce.200ms="search"
                           placeholder="Cari nama guru, NIP, sekolah..."
                           class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                </div>
            </div>

            <!-- Filter Aktif & Reset -->
            <div class="flex flex-wrap items-center gap-2">
                @if($kabupaten_id || $search)
                    @if($kabupaten_id)
                        <span class="px-3 py-1 bg-violet-100 dark:bg-violet-900/30 text-violet-800 dark:text-violet-400 rounded-full text-sm">
                            📍 {{ $kabupatens->firstWhere('id', $kabupaten_id)->kabupaten ?? 'N/A' }}
                        </span>
                    @endif
                    @if($search)
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 rounded-full text-sm">
                            🔍 "{{ $search }}"
                        </span>
                    @endif
                    <button wire:click="resetFilters" 
                            class="px-3 py-1 bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-gray-300 dark:hover:bg-zinc-600">
                        ✕ Reset
                    </button>
                @else
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Menampilkan semua data
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Loading Indicator
    <div wire:loading class="mb-4">
        <div class="bg-violet-50 dark:bg-violet-900/20 border border-violet-200 dark:border-violet-800 rounded-lg p-4">
            <div class="flex items-center text-violet-600 dark:text-violet-400">
                <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memuat data...
            </div>
        </div>
    </div> -->

    <!-- Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($guruPendas as $g)
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow hover:shadow-xl hover:bg-gray-400 dark:hover:bg-zinc-700 transition-shadow duration-300 overflow-hidden">
            <a href="{{ route('guest.guru-penda.show', $g) }}" >
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-violet-500 to-violet-600 text-white p-4">
                <h3 class="font-bold text-lg truncate" title="{{ $g->nama_guru }}">{{ $g->nama_guru }}</h3>
            </div>
            
            <!-- Content Card -->
            <div class="p-4 space-y-3">
                <!-- Lokasi -->
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $g->kabupaten->kabupaten ?? '-' }}</p>
                        <!--<p class="text-gray-600 dark:text-gray-400">{{ $g->kecamatan->kecamatan ?? '-' }}</p> -->
                    </div>
                </div>

                <!-- Alamat -->
                @if($g->nip)
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3">{{ $g->nip }}</p>
                </div>
                @endif

                <!-- Ketua -->
                <!-- @if($g->ketua)
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $g->no_telp }}</p>
                </div> -->
                @endif
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
                    Tidak ada data ditemukan
                </p>
                <p class="text-gray-400 dark:text-gray-500 text-sm">
                    @if($search || $kabupaten_id)
                        Coba ubah filter atau kata kunci pencarian
                    @else
                        Belum ada data guru
                    @endif
                </p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $guruPendas->links() }}
    </div>
</div>
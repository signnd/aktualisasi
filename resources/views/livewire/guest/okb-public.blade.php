<div>
    <!-- Hero Section dengan Statistik -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white rounded-lg shadow-lg p-8 mb-6">
        <h1 class="text-3xl font-bold mb-2">Organisasi Agama & Keagamaan Buddha (OKB)</h1>
        <p class="text-teal-100 mb-6">Database Organisasi Agama & Keagamaan Buddha di Provinsi Bali</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-teal-100">Total Organisasi Agama & Keagamaan Buddha</p>
                        <p class="text-2xl font-bold">{{ number_format($totalokb) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm text-teal-100">Kabupaten/Kota</p>
                        <p class="text-2xl font-bold">{{ number_format($totalKabupaten) }}</p>
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
                           wire:model.live.debounce.500ms="search"
                           placeholder="Cari nama OKB..."
                           class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                </div>
            </div>

            <!-- Filter Aktif & Reset -->
            <div class="flex flex-wrap items-center gap-2">
                @if($kabupaten_id || $search)
                    @if($kabupaten_id)
                        <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900/30 text-teal-800 dark:text-teal-400 rounded-full text-sm">
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

    <!-- Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($okbs as $okb)
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow hover:shadow-xl hover:bg-gray-100 dark:hover:bg-zinc-700 transition-all duration-300 overflow-hidden">
            <!-- Header Card -->
            <a href="{{ route('guest.okb.show', $okb) }}" >
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white p-4">
                <h3 class="font-bold text-lg truncate">{{ $okb->nama_okb }}</h3>
            </div>
            
            <!-- Content Card -->
            <div class="p-4 space-y-3">
                <!-- Lokasi -->
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $okb->kabupaten->kabupaten ?? '-' }}</p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $okb->kecamatan->kecamatan ?? '-' }}</p>
                    </div>
                </div>

                <!-- Alamat -->
                @if($okb->alamat)
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $okb->alamat }}</p>
                </div>
                @endif

                <!-- Ketua -->
                @if($okb->ketua)
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M16.5562 12.9062L16.1007 13.359C16.1007 13.359 15.0181 14.4355 12.0631 11.4972C9.10812 8.55901 10.1907 7.48257 10.1907 7.48257L10.4775 7.19738C11.1841 6.49484 11.2507 5.36691 10.6342 4.54348L9.37326 2.85908C8.61028 1.83992 7.13596 1.70529 6.26145 2.57483L4.69185 4.13552C4.25823 4.56668 3.96765 5.12559 4.00289 5.74561C4.09304 7.33182 4.81071 10.7447 8.81536 14.7266C13.0621 18.9492 17.0468 19.117 18.6763 18.9651C19.1917 18.9171 19.6399 18.6546 20.0011 18.2954L21.4217 16.883C22.3806 15.9295 22.1102 14.2949 20.8833 13.628L18.9728 12.5894C18.1672 12.1515 17.1858 12.2801 16.5562 12.9062Z"></path>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $okb->no_telp }}</p>
                </div>
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
                        Belum ada data OKB
                    @endif
                </p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $okbs->links() }}
    </div>
</div>
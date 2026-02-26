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
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filter & Search Sidebar -->
        <aside class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 sticky top-6">
                <div class="space-y-6">
                    <!-- Filter Kabupaten -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filter Kabupaten
                        </label>
                        <select wire:model.live="kabupaten_id"
                                class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white text-sm focus:ring-violet-500 focus:border-violet-500">
                            <option value="">Semua Kabupaten/Kota</option>
                            @foreach($kabupatens as $kab)
                                <option value="{{ $kab->id }}">{{ $kab->kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Pencarian -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pencarian
                        </label>
                        <input type="text" 
                               wire:model.live.debounce.200ms="search"
                               placeholder="Cari nama, NIP, sekolah..."
                               class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white text-sm focus:ring-violet-500 focus:border-violet-500">
                    </div>
                    <!-- Filter Aktif & Reset -->
                    <div class="pt-4 border-t border-gray-100 dark:border-zinc-700">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($kabupaten_id || $search)
                                @if($kabupaten_id)
                                    <span class="px-2 py-1 bg-violet-100 dark:bg-violet-900/30 text-violet-800 dark:text-violet-400 rounded-md text-xs">
                                        📍 {{ $kabupatens->firstWhere('id', $kabupaten_id)->kabupaten ?? 'N/A' }}
                                    </span>
                                @endif
                                @if($search)
                                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 rounded-md text-xs">
                                        🔍 {{ Str::limit($search, 15) }}
                                    </span>
                                @endif
                            @else
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Menampilkan semua data
                                </span>
                            @endif
                        </div>
                        
                        @if($kabupaten_id || $search)
                            <button wire:click="resetFilters" 
                                    class="w-full px-4 py-2 bg-gray-100 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-200 dark:hover:bg-zinc-600 transition-colors flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset Filter
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </aside>
        <!-- Main Content Area -->
        <div class="lg:col-span-3">
            <!-- Loading Indicator -->
            <!--<div wire:loading class="mb-6">
                <div class="flex items-center text-violet-600 dark:text-violet-400 bg-violet-50 dark:bg-violet-900/20 px-4 py-2 rounded-lg border border-violet-100 dark:border-violet-800">
                    <svg class="animate-spin h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memperbarui data...</span>
                </div>
            </div> -->
            <!-- Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($guruPendas as $g)
                <div class="bg-white dark:bg-zinc-800 rounded-lg shadow hover:shadow-xl hover:translate-y-[-2px] transition-all duration-300 overflow-hidden border border-transparent hover:border-violet-200 dark:hover:border-violet-900">
                    <a href="{{ route('guest.guru-penda.show', $g) }}{{ request()->getQueryString() ? ('?' . request()->getQueryString()) : '' }}" class="block h-full">
                        <!-- Header Card -->
                        <div class="px-4 py-4">
                            @if($g->foto)
                            @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $g->foto;
                            $fileId = null;
                            $isGoogleDrive = false;
                            $isDirectImage = false;
                            
                            // Cek apakah URL dari Google Drive
                            if (strpos($imageUrl, 'drive.google.com') !== false) {
                                $isGoogleDrive = true;
                                // Extract file ID dari berbagai format URL Google Drive
                                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $imageUrl, $matches)) {
                                    $fileId = $matches[1];
                                } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $imageUrl, $matches)) {
                                    $fileId = $matches[1];
                                }
                                
                                if ($fileId) {
                                    // Gunakan format direct image dari lh3.googleusercontent.com
                                    $imageUrl = "https://lh3.googleusercontent.com/d/{$fileId}=w300";
                                }
                            } 
                            // Cek apakah URL langsung ke gambar (jpg, jpeg, png, gif, webp, svg)
                            elseif (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)(\?.*)?$/i', $imageUrl)) {
                                $isDirectImage = true;
                            }
                        @endphp
                         <img
                            src="{{ $imageUrl }}" 
                             alt="{{ $g->nama_guru }}"
                             class="h-[180px] w-[180px] justify-self-center object-contain rounded-full transition-transform duration-300 group-hover:scale-[1.2]"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($g->nama_guru) }}&size=240&background=random&color=fff&font-size=0.33'; this.nextElementSibling.classList.remove('hidden');">
                    @endif
                            <h3 class="font-bold text-lg truncate text-gray-800" title="{{ $g->nama_guru }}">{{ $g->nama_guru }}</h3>
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
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-12 text-center shadow-sm border border-gray-100 dark:border-zinc-700">
                        <svg class="w-16 h-16 text-gray-300 dark:text-zinc-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-lg font-medium mb-1">
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
            <div class="mt-8">
                {{ $guruPendas->links() }}
            </div>
        </div>
    </div>
</div>
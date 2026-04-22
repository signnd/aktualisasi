<div class="relative w-full max-w-2xl mx-auto mb-8">
    <div class="relative">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="query" 
            class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-lg text-lg transition-shadow"
            placeholder="Cari rumah ibadah, lembaga, atau sekolah..."
            autocomplete="off"
        >
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <div wire:loading class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
            <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-indigo-500"></div>
        </div>
    </div>

    @if(strlen($query) >= 2)
        <div class="absolute z-50 w-full mt-2 bg-white dark:bg-zinc-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden max-h-96 overflow-y-auto">
            @if(count($results['rumah_ibadah']) === 0 && count($results['lembaga']) === 0 && count($results['sekolah']) === 0)
                <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                    Tidak ditemukan hasil untuk "{{ $query }}"
                </div>
            @else
                @if(count($results['rumah_ibadah']) > 0)
                    <div class="p-2 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50 dark:bg-zinc-900/50 rounded-md">Rumah Ibadah</h3>
                        <ul class="mt-1">
                            @foreach($results['rumah_ibadah'] as $item)
                                <li>
                                    <a href="{{ $item['route'] }}" class="block px-3 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-700 dark:hover:text-indigo-300 rounded-lg transition-colors">
                                        <div class="flex justify-between items-center">    
                                        {{ $item['label'] }}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(count($results['lembaga']) > 0)
                    <div class="p-2 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50 dark:bg-zinc-900/50 rounded-md">Lembaga Keagamaan</h3>
                        <ul class="mt-1">
                            @foreach($results['lembaga'] as $item)
                                <li>
                                    <a href="{{ $item['route'] }}" class="block px-3 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-700 dark:hover:text-indigo-300 rounded-lg transition-colors">
                                        <div class="flex justify-between items-center">
                                            <span>{{ $item['label'] }}</span>
                                            <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-zinc-700 rounded-full text-gray-500 dark:text-gray-400">{{ $item['type'] }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(count($results['sekolah']) > 0)
                    <div class="p-2">
                        <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50 dark:bg-zinc-900/50 rounded-md">Pendidikan Agama</h3>
                        <ul class="mt-1">
                            @foreach($results['sekolah'] as $item)
                                <li>
                                    <a href="{{ $item['route'] }}" class="block px-3 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-700 dark:hover:text-indigo-300 rounded-lg transition-colors">
                                        <div class="flex justify-between items-center">
                                            <span>{{ $item['label'] }}</span>
                                            <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-zinc-700 rounded-full text-gray-500 dark:text-gray-400">{{ $item['type'] }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
        </div>
    @endif
</div>

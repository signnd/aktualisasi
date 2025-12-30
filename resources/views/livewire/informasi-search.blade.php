<div>
    <!-- Filter & Search Box -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div class="flex items-center w-full sm:w-auto gap-3">
            <select wire:model.live.debounce.100ms="kategori"
                    class="px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                <option value="">-- Semua Kategori --</option>
                <option value="Informasi Publik">Informasi Publik</option>
                <option value="Informasi Internal">Informasi Internal</option>
                <option value="Informasi Lainnya">Informasi Lainnya</option>
            </select>

            <input type="text" 
               wire:model.live.debounce.100ms="search"
               placeholder="Cari..."
               class="flex flex-1 px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
               autofocus>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div wire:loading class="mb-4">
        <div class="flex items-center text-blue-600 dark:text-blue-400">
            <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Mencari...
        </div>
    </div>

    <div class="shadow-lg rounded-lg overflow-hidden">
        <!-- Konten tabel di sini -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200 dark:bg-zinc-700">
                    <tr>
                        <th class="px-4 py-3 w-1 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800">
                    @forelse(($informasis ?? collect()) as $index => $informasi)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                {{ isset($informasis) && method_exists($informasis, 'firstItem') ? $informasis->firstItem() + $index : ($index + 1) }}
                            </td>
                            <td class="px-6 py-4 whitespace">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $informasi->judul }}</div>
                                <div class="text-sm text-gray-500 dark:text-white">{{ $informasi->ringkasan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $informasi->kategori }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('informasi.show', $informasi) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition" title="Detail">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    @if(auth()->check() && (auth()->id() === $informasi->user_id || auth()->user()->user_role === 'admin'))
                                    <a href="{{ route('informasi.edit', $informasi) }}" 
                                       class="text-green-600 hover:text-green-900 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('informasi.destroy', $informasi) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Hapus">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400 italic">
                            @if(!empty($search))
                                Tidak ada hasil untuk "{{ $search ?? '' }}"
                            @else
                                Belum ada informasi.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4">
            @if(isset($informasis) && method_exists($informasis, 'links'))
                {{ $informasis->links() }}
            @endif
        </div>
    </div>
</div>

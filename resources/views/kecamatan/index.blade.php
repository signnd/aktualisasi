<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Daftar Kecamatan</h2>
    </x-slot>
    <div class="rounded-lg shadow p-6">
        <div x-data="kecModal()" class="relative">
            <!-- Modal overlay -->
            <div x-show="showAddModal" x-transition x-cloak class="fixed inset-0 bg-gray-200/50 dark:bg-gray-900/50 bg-opacity-75 flex items-center justify-center z-50">
                <div @click.away="closeModal()" class="transform transition-all">
                <div class="bg-white dark:bg-gray-600 rounded-lg shadow-lg w-full p-6">
                    <h3 class="text-lg font-bold mb-4">Tambah Kecamatan</h3>
                    <form action="{{ route('kecamatan.store') }}" method="POST" class="flex items-center space-x-2 mb-4">
                        @csrf
                        <div class="flex items-start gap-2 w-full">
                            <input type="text" name="kecamatan"
                                   class="flex-1 py-2 px-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md bg-gray-50 text-gray-700"
                                   placeholder="Nama kecamatan" required>

                            @if(auth()->user()->user_role === 'admin')
                                <select id="kabupaten_id" name="kabupaten_id" required
                                    class="w-48 px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md bg-white text-black">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    @foreach($kabupaten as $k)
                                        <option value="{{ $k->id }}">{{ $k->kabupaten }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select id="kabupaten_id" name="kabupaten_id" required disabled
                                    class="w-48 py-2 px-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md bg-gray-400 text-gray-700 cursor-not-allowed">
                                    @foreach($kabupaten as $k)
                                        @if($k->id == auth()->user()->kabupaten_id)
                                            <option value="{{ $k->id }}" selected>{{ $k->kabupaten }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="hidden" name="kabupaten_id" value="{{ auth()->user()->kabupaten_id }}">
                            @endif
                            <div class="flex items-center gap-2">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Tambah</button>
                                <button type="button" @click="showAddModal = false" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>

            <div x-show="showEditModal" x-transition style="display:none"
                class="fixed inset-0 bg-gray-900/70 bg-opacity-900 flex items-center justify-center z-50">
                <div @click.away="closeModal()" class="transform transition-all">
                <div class="bg-white dark:bg-gray-600 rounded-lg shadow-lg w-full max-w-xl p-6">
                <form :action="'/master/kecamatan/' + kecamatan.id" method="POST" class="flex items-center space-x-2">
                    @csrf @method('PUT')
                    <input type="text" name="kecamatan" x-model="kec.kecamatan"
                        class="border rounded px-2 py-1 w-full">
                    @if(auth()->user()->user_role === 'admin')
                        <select x-model.number="kec.kabupaten_id" class="border rounded px-2 py-1 dark:bg-gray-50 dark:text-gray-900">
                            @foreach($kabupaten as $k)
                                <option value="{{ $k->id }}" selected>{{ $k->kabupaten }}</option>
                            @endforeach
                        </select>
                    @else
                        <!-- show user's kabupaten only and include hidden input so server receives value -->
                        <select x-model.number="kec.kabupaten_id" disabled class="border rounded px-2 py-1 bg-gray-500">
                            @foreach($kabupaten as $k)
                                <option value="{{ $k->id }}" selected>{{ $k->kabupaten }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="kabupaten_id" :value="{{ auth()->user()->kabupaten_id }}">
                    @endif
                    <button type="submit" class="px-2 py-2 bg-green-600 text-white rounded text-xs">Simpan</button>
                    <button type="button" @click="editing = false" class="px-2 py-2 bg-gray-400 text-white rounded text-xs">Batal</button>
                </form>
                </div>
            </div>
            </div>
        <div class="flex justify-between items-center pb-5">
            <h1 class="text-2xl font-bold mb-4">Daftar Kecamatan</h1>
            <!-- tombol buka modal -->
            <button @click="openAddModal()"
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Tambah Kecamatan
            </button>
        </div>
            
        <!-- Tabel daftar kecamatan -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200 dark:bg-zinc-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider w-2">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Nama Kecamatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Kabupaten</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
                <tbody>
                    @forelse ($kecamatan as $kc)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $kc->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $kc->kecamatan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $kc->kabupaten->kabupaten ?? '-' }}</td>
                        @if(auth()->user()->user_role === 'admin' || auth()->user()->kabupaten_id === $kc->kabupaten_id)

                            <td class="px-4 py-2 space-x-2">
                                <!-- Edit button (left) -->
                                <button type="button" @click="openEditModal({{ json_encode($kc) }})" class="text-blue-600 hover:underline mr-3">Edit</button>

                                <!-- Delete button (right) -->
                                <form action="{{ route('kecamatan.destroy',$kc) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus data ini?')" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        @else
                            <!-- readonly view for users without permission -->
                            <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">-</td>
                        @endif
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4">Belum ada data</td>
                        </tr>
                    @endforelse
                 </tbody>
            </table>
            <div class="mt-4">{{ $kecamatan->links() }}</div>
            </div>
    </div>
</div>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('kecModal', () => ({
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        kec: {},
        kecToDelete: {},

        openAddModal() {
            this.showAddModal = true;
        },

        openEditModal(data) {
            this.kec = { ...data };
            this.showEditModal = true;
        },

        openDeleteModal(data) { 
            this.kecToDelete = { ...data };
            this.showDeleteModal = true;
        },

        closeModal() {
            this.showAddModal = false;
            this.showEditModal = false;
            this.showDeleteModal = false;
            this.kec = {};
        },
    }));
});
</script>
</x-app-layout>

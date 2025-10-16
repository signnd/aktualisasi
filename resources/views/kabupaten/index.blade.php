<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold">Daftar Kabupaten/Kota</h2>
    </x-slot>

    <div class="rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Kabupaten/Kota</h3>
    </div>
    <!-- Card Tabel Kabupaten -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200 dark:bg-zinc-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider w-2">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Kode Kabupaten</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Nama Kabupaten</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($kabupaten as $k)
            <tr x-data="{ editing: false }" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $k->id }}</td>
    
                <!-- Kolom kode_kab -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    <span x-show="!editing">{{ $k->kode_kab }}</span>
                    <form x-show="editing" action="{{ route('kabupaten.update', $k) }}" method="POST" class="flex space-x-2">
                        @csrf
                        @method('PUT')
                        <input x-show="editing" type="text" name="kode_kab" value="{{ $k->kode_kab }}"
                               class="border rounded px-2 py-1 w-24 text-sm">
                </td>
                <!-- Kolom nama kabupaten -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    <span x-show="!editing">{{ $k->kabupaten }}</span>
                    <input x-show="editing" type="text" name="kabupaten" value="{{ $k->kabupaten }}"
                           class="border rounded px-2 py-1 w-full text-sm">
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white space-x-2">
                    <button type="button" @click="editing = true" x-show="!editing"
                            class="text-blue-600 hover:underline">Edit</button>
                    <!-- Tombol simpan & batal -->
                    <div x-show="editing" class="flex space-x-2">
                        <button type="submit" class="px-2 py-1 bg-green-600 text-white rounded text-xs">✔</button>
                        <button type="button" @click="editing = false"
                                class="px-2 py-1 bg-gray-400 text-white rounded text-xs">✖</button>
                    </div>
                    </form>
                    <!-- Tombol hapus -->
                    <form action="{{ route('kabupaten.destroy',$k) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus data ini?')" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-6 text-gray-500 italic">
                    Belum ada data kabupaten.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
        <div class="mt-4">{{ $kabupaten->links() }}</div>
            <div class="space-y-6">
        <!-- Card Form Tambah Kabupaten -->
        <div class="rounded-lg shadow p-6">
            <h3 class="text-lg font-bold mb-4">Tambah Kabupaten/Kota</h3>
            <form action="{{ route('kabupaten.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium">
                    <input type="text" name="kode_kab"
                           class="py-2 px-2 w-60 sm:w-20 md:w-60 border rounded-md shadow-sm"
                           placeholder="Masukkan kode kabupaten" required>
                    <input type="text" name="kabupaten"
                           class="mx-2 py-2 px-2 w-60 sm:w-20 md:w-60 border rounded-md shadow-sm"
                           placeholder="Masukkan nama kabupaten/kota" required>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                    </label>
                </div>
            </form>
        </div>

    </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Daftar Kecamatan</h2>
    </x-slot>

        <div class="rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Daftar Kecamatan</h3>
        </div>
        <!-- Tabel daftar kecamatan -->
        <div class="rounded-lg shadow p-6">
            <table class="min-w-full text-sm border">
                <thead class="bg-gray-600">
                    <tr>
                        <th class="px-4 py-2 w-2">ID</th>
                        <th class="px-4 py-2">Nama Kecamatan</th>
                        <th class="px-4 py-2">Kabupaten</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kecamatan as $kc)
                        <tr x-data="{ editing: false }">
                            <td class="px-4 py-2">{{ $kc->id }}</td>
                            <td class="px-4 py-2">
                                <span x-show="!editing">{{ $kc->kecamatan }}</span>
                                <form x-show="editing" action="{{ route('kecamatan.update',$kc) }}" method="POST" class="flex space-x-2">
                                    @csrf @method('PUT')
                                    <input type="text" name="kecamatan" value="{{ $kc->kecamatan }}"
                                           class="border rounded px-2 py-1 w-full">
                            </td>
                            <td class="px-4 py-2">
                                <span x-show="!editing">{{ $kc->kabupaten->kabupaten ?? '-' }}</span>
                                <select x-show="editing" name="kabupaten_id" class="border rounded px-2 py-1">
                                    @foreach($kabupaten as $k)
                                        <option value="{{ $k->id }}" @selected($kc->kabupaten_id == $k->id)>
                                            {{ $k->kabupaten }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <button type="button" @click="editing = true" x-show="!editing"
                                        class="text-blue-600 hover:underline">Edit</button>
                                <div x-show="editing" class="flex space-x-2">
                                    <button type="submit" class="px-2 py-1 bg-green-600 text-white rounded text-xs">✔</button>
                                    <button type="button" @click="editing = false"
                                            class="px-2 py-1 bg-gray-400 text-white rounded text-xs">✖</button>
                                </div>
                                </form>
                                <form action="{{ route('kecamatan.destroy',$kc) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus data ini?')" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center p-4">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $kecamatan->links() }}</div>
            <div class="space-y-6">
                <!-- Card Form Tambah Kecamatan -->
                <div class="rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold mb-4">Tambah Kecamatan</h3>
                    <form action="{{ route('kecamatan.store') }}" method="POST" class="flex items-center space-x-2 mb-4">
                    @csrf
                        <div>
                            <label class="block text-sm font-medium">
                            <input type="text" name="kecamatan"
                                   class="py-2 px-2 w-60 sm:w-20 md:w-60 border rounded-md shadow-sm"
                                   placeholder="Nama kecamatan" required>
                            <select name="kabupaten_id" 
                                class="mx-2 py-2 px-2 w-60 sm:w-20 md:w-60 border rounded-md shadow-sm text-black bg-white" required>
                                <option value="">-- Pilih Kabupaten --</option>
                                @foreach($kabupaten as $k)
                                    <option value="{{ $k->id }}">{{ $k->kabupaten }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Tambah
                            </button>
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah RIAB') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-500 rounded-lg p-6">
                <form action="{{ route('riab.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">Nama RIAB</label>
                        <input type="text" name="nama" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">No Registrasi</label>
                        <input type="text" name="no_registrasi" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Alamat</label>
                        <input type="text" name="alamat" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kabupaten</label>
                        <select name="kabupaten_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($kabupaten as $k)
                                <option value="{{ $k->id }}">{{ $k->kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kecamatan</label>
                        <select name="kecamatan_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($kecamatan as $kc)
                                <option value="{{ $kc->id }}">{{ $kc->kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="{{ route('riab.index') }}" 
                           class="ml-2 text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

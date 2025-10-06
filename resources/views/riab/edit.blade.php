<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit RIAB') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 border border-gray-600 rounded-lg">
            <div class="bg-grey-200 shadow rounded-lg p-6">
                <form action="{{ route('riab.update', $riab) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium">Nama RIAB</label>
                        <input type="text" name="nama" value="{{ $riab->nama }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-lg shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">No Registrasi</label>
                        <input type="text" name="no_registrasi" value="{{ $riab->no_registrasi }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full  rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kabupaten</label>
                        <select name="kabupaten_id" 
                            class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                            @foreach($kabupaten as $k)
                                <option value="{{ $k->id }}" {{ $riab->kabupaten_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->kabupaten }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kecamatan</label>
                        <select name="kecamatan_id" 
                            class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                            @foreach($kecamatan as $kc)
                                <option value="{{ $kc->id }}" {{ $riab->kecamatan_id == $kc->id ? 'selected' : '' }}>
                                    {{ $kc->kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kelurahan</label>
                        <input type="text" name="kelurahan" value="{{ $riab->kelurahan }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Masuk kategori 3T</label>
                        <input type="radio" name="kategori_3t" class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm"
                            value="{{ $riab->kategori_3t == '3T' ? 'checked' : '' }}"> 3T
                        <input type="radio" name="kategori_3t" value="{{ $riab->kategori_3t == 'Non 3T' ? 'checked' : '' }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm"> Non 3T
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Ketua</label>
                        <input type="text" name="ketua" value="{{ $riab->ketua }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tahun berdiri</label>
                        <input type="year" name="thn_berdiri" value="{{ $riab->thn_berdiri }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Alamat</label>
                        <input type="text" name="alamat" value="{{ $riab->alamat }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">tgl_tanda_daftar</label>
                        <input type="date" name="tgl_tanda_daftar" value="{{ $riab->tgl_tanda_daftar }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">jenis_riab</label>
                        <input type="text" name="jenis_riab" value="{{ $riab->jenis_riab }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">status</label>
                        <input type="text" name="status" value="{{ $riab->status }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">kondisi</label>
                        <input type="text" name="kondisi" value="{{ $riab->kondisi }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">email</label>
                        <input type="text" name="email" value="{{ $riab->email }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">no_telp</label>
                        <input type="text" name="no_telp" value="{{ $riab->no_telp }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">media_sosial</label>
                        <input type="text" name="media_sosial" value="{{ $riab->media_sosial }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">latitude</label>
                        <input type="text" name="latitude" value="{{ $riab->latitude }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">longitude</label>
                        <input type="text" name="longitude" value="{{ $riab->longitude }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">link_foto</label>
                        <input type="text" name="link_foto" value="{{ $riab->link_foto }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ $riab->deskripsi }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">jumlah_umat</label>
                        <input type="text" name="jumlah_umat" value="{{ $riab->jumlah_umat }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">eksisting</label>
                        <input type="text" name="eksisting" value="{{ $riab->eksisting }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">tgl_update</label>
                        <input type="text" name="tgl_update" value="{{ $riab->tgl_update }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">status_verifikasi</label>
                        <input type="text" name="status_verifikasi" value="{{ $riab->status_verifikasi }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>

                    <div>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Update
                        </button>
                        <a href="{{ route('riab.index') }}" 
                           class="ml-2 text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

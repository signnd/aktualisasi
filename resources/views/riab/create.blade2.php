<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah RIAB') }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto">
    <!-- Pesan error -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="py-6">
        <h1 class="py-5 text-3xl">Informasi Umum RIAB</h1>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 border border-gray-600 rounded-lg">
            <div class="bg-grey-200 rounded-lg p-6">
                <form action="{{ route('riab.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">Nama RIAB</label>
                        <input type="text" name="nama" 
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-lg shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">No Registrasi</label>
                        <input type="text" name="no_registrasi" 
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-lg shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kabupaten</label>
                        <select id="kabupaten_id" name="kabupaten_id" 
                            class="border-2 border-gray-700 text-black bg-white mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                            <option value="">-- Pilih Kabupaten --</option>
                            @foreach($kabupaten as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->kabupaten }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kecamatan</label>
                        <select id="kecamatan_id" name="kecamatan_id" 
                            class="border-2 border-gray-700 text-black bg-white mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatan as $kc)
                                <option value="{{ $kc->id }}" data-kabupaten="{{ $kc->kabupaten_id }}">
                                    {{ $kc->kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kelurahan/Desa</label>
                        <input type="text" name="kelurahan"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="text-md font-medium">Kategori 3T
                            <a href="https://docs.google.com/document/d/1TI8geSRdMLf19JiWZ_fUzl0vQPpZ-fuz/edit?usp=sharing&ouid=114985864752039801893&rtpof=true&sd=true" class="text-blue-500">(Lihat detail daerah 3T)</a>
                        </label>
                        <br>
                        <label><input type="radio" name="kategori_3t" value="3T">
                        3T</label>
                        <label><input type="radio" name="kategori_3t" value="Non 3T">
                        Non 3T</label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Ketua</label>
                        <input type="text" name="ketua"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tahun Berdiri</label>
                        <input type="number" name="thn_berdiri""
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Alamat</label>
                        <input type="text" name="alamat"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Penerbitan Tanda Daftar</label>
                        <input type="date" name="tgl_tanda_daftar"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jenis RIAB</label>
                        <input type="text" name="jenis_riab"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <label><input type="radio" name="status" value="Disetujui" class="mx-2">
                        Disetujui</label>
                        <label><input type="radio" name="status" value="Ditolak" class="mx-2">
                        Ditolak</label>
                        <label><input type="radio" name="status" value="Ditolak" class="mx-2">
                        Pending</label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kondisi RIAB</label>
                    <label class="block items-center space-x-2">
                        <label><input type="radio" name="kondisi" value="Sangat Baik" class="mx-2">
                        Sangat Baik</label>
                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Baik" class="mx-2">
                        Baik</label>

                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Rusak Ringan" class="mx-2">
                        Rusak Ringan</label>

                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Rusak Sedang" class="mx-2">
                        Rusak Sedang</label>

                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Rusak Berat" class="mx-2">
                        Rusak Berat</label>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">E-mail</label>
                        <input type="text" name="email"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">No. Telp/HP/WhatsApp</label>
                        <input type="text" name="no_telp"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Media Sosial (Instagram/Facebook/Twitter/YouTube/TikTok)</label>
                        <input type="text" name="media_sosial"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Garis Latitude</label>
                        <input type="text" name="latitude"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Garis Longitude</label>
                        <input type="text" name="longitude"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Link foto SIORI</label>
                        <input type="text" name="link_foto"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="deskripsi"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jumlah Umat</label>
                        <input type="text" name="jumlah_umat"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status Eksisting</label>
                        <label><input type="radio" name="eksisting" value="Aktif" class="mx-2">
                        Aktif</label>
                        <label><input type="radio" name="eksisting" value="Tidak Aktif" class="mx-2">
                        Tidak Aktif</label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Update</label>
                        <input type="date" name="tgl_update"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status Verifikasi</label>
                        <label><input type="radio" name="status_verifikasi" value="TRUE" class="mx-2">
                        Terverifikasi</label>
                        <label><input type="radio" name="status_verifikasi" value="FALSE" class="mx-2">
                        Tidak Terverifikasi</label>
                    </div>

                    <div>
                    <!-- Jika ada user login -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Tambah
                        </button>
                        <button href="{{ route('riab.index') }}" 
                                class="px-4 py-2 bg-gray-600 rounded hover:underline">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kabSelect = document.getElementById('kabupaten_id');
        const kecSelect = document.getElementById('kecamatan_id');
        const allKec = Array.from(kecSelect.options);

        // Simpan kecamatan yang sudah dipilih sebelumnya
        const selectedKecId = kecSelect.value;
        
        function filterKecamatan() {
            const kabId = kabSelect.value;
            
            // Reset dropdown kecamatan
            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            
            if (kabId) {
                // Filter dan tampilkan kecamatan sesuai kabupaten
                allKec.forEach(opt => {
                    if (opt.dataset.kabupaten === kabId) {
                        kecSelect.appendChild(opt.cloneNode(true));
                    }
                });
                
                // Set kembali kecamatan yang dipilih jika masih sesuai kabupaten
                if (selectedKecId) {
                    kecSelect.value = selectedKecId;
                }
            }
        }
        
        // Filter saat kabupaten berubah
        kabSelect.addEventListener('change', filterKecamatan);
        
        // Filter saat halaman pertama kali dimuat (untuk mode edit)
        filterKecamatan();
    });
</script>
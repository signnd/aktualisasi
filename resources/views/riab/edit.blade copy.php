<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit RIAB') }}
        </h2>
    </x-slot>

@php
    // Helper untuk memastikan data dalam format array
    $kondisiGeo = [];
    $petaRawan = [];
    
    if ($riab->riabdetail) {
        // Kondisi Geografis
        if (is_array($riab->riabdetail->kondisi_geografis)) {
            $kondisiGeo = $riab->riabdetail->kondisi_geografis;
        } elseif (is_string($riab->riabdetail->kondisi_geografis)) {
            $decoded = json_decode($riab->riabdetail->kondisi_geografis, true);
            $kondisiGeo = is_array($decoded) ? $decoded : [];
        }
        
        // Peta Rawan Bencana
        if (is_array($riab->riabdetail->peta_rawan_bencana)) {
            $petaRawan = $riab->riabdetail->peta_rawan_bencana;
        } elseif (is_string($riab->riabdetail->peta_rawan_bencana)) {
            $decoded = json_decode($riab->riabdetail->peta_rawan_bencana, true);
            $petaRawan = is_array($decoded) ? $decoded : [];
        }
    }
@endphp

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
        <h1 class="text-lg">Edit Informasi Umum RIAB</h1>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 border border-gray-600 rounded-lg">
            <div class="bg-grey-200 shadow rounded-lg p-6">
                <form action="{{ route('riab.update', $riab->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium">Nama RIAB</label>
                        <input type="text" name="nama" value="{{ old('nama', $riab->nama) }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-lg shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">No Registrasi</label>
                        <input type="text" name="no_registrasi" value="{{ old('no_registrasi', $riab->no_registrasi) }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kabupaten</label>
                        <select id="kabupaten_id" name="kabupaten_id" 
                            class="border-2 border-gray-700 text-black bg-white mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                            <option value="">-- Pilih Kabupaten --</option>
                            @foreach($kabupaten as $k)
                                <option value="{{ $k->id }}" @selected(old('kabupaten_id', $riab->kabupaten_id) == $k->id)>
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
                                <option value="{{ $kc->id }}" data-kabupaten="{{ $kc->kabupaten_id }}"
                                    @selected(old('kecamatan_id', $riab->kecamatan_id) == $kc->id)>
                                    {{ $kc->kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kelurahan/Desa</label>
                        <input type="text" name="kelurahan" value="{{ $riab->kelurahan }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="text-md font-medium">Kategori 3T
                            <a href="https://docs.google.com/document/d/1TI8geSRdMLf19JiWZ_fUzl0vQPpZ-fuz/edit?usp=sharing&ouid=114985864752039801893&rtpof=true&sd=true" class="text-blue-500">(Lihat detail daerah 3T)</a>
                        </label>
                        <br>
                        <label><input type="radio" name="kategori_3t" value="3T"
                               {{ old('kategori_3t', $riab->kategori_3t) == '3T' ? 'checked' : '' }}>
                        3T</label>
                        <label><input type="radio" name="kategori_3t" value="Non 3T"
                               {{ old('kategori_3t', $riab->kategori_3t) == 'Non 3T' ? 'checked' : '' }}>
                        Non 3T</label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Ketua</label>
                        <input type="text" name="ketua" value="{{ $riab->ketua }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tahun Berdiri</label>
                        <input type="number" name="thn_berdiri" value="{{ $riab->thn_berdiri }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Alamat</label>
                        <input type="text" name="alamat" value="{{ $riab->alamat }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Penerbitan Tanda Daftar</label>
                        <input type="date" name="tgl_tanda_daftar" value="{{ $riab->tgl_tanda_daftar }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jenis RIAB</label>
                        <input type="text" name="jenis_riab" value="{{ $riab->jenis_riab }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <label><input type="radio" name="status" value="Disetujui" class="mx-2"
                               {{ old('status', $riab->status) == 'Disetujui' ? 'checked' : '' }}>
                        Disetujui</label>
                        <label><input type="radio" name="status" value="Ditolak" class="mx-2"
                               {{ old('status', $riab->status) == 'Ditolak' ? 'checked' : '' }}>
                        Ditolak</label>
                        <label><input type="radio" name="status" value="Pending" class="mx-2"
                               {{ old('status', $riab->status) == 'Pending' ? 'checked' : '' }}>
                        Pending</label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kondisi RIAB</label>
                    <label class="block items-center space-x-2">
                        <label><input type="radio" name="kondisi" value="Sangat Baik" class="mx-2"
                               @checked(old('kondisi', $riab->kondisi) == 'Sangat Baik')>
                        Sangat Baik</label>
                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Baik" class="mx-2"
                               @checked(old('kondisi', $riab->kondisi) == 'Baik')>
                        Baik</label>

                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Rusak Ringan" class="mx-2"
                               @checked(old('kondisi', $riab->kondisi) == 'Rusak Ringan')>
                        Rusak Ringan</label>

                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Rusak Sedang" class="mx-2"
                               @checked(old('kondisi', $riab->kondisi) == 'Rusak Sedang')>
                        Rusak Sedang</label>

                        <label class="block items-center space-x-2"><input type="radio" name="kondisi" value="Rusak Berat" class="mx-2"
                               @checked(old('kondisi', $riab->kondisi) == 'Rusak Berat')>
                        Rusak Berat</label>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">E-mail</label>
                        <input type="text" name="email" value="{{ $riab->email }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">No. Telp/HP/WhatsApp</label>
                        <input type="text" name="no_telp" value="{{ $riab->no_telp }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Media Sosial (Instagram/Facebook/Twitter/YouTube/TikTok)</label>
                        <input type="text" name="media_sosial" value="{{ $riab->media_sosial }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Garis Latitude</label>
                        <input type="text" name="latitude" value="{{ $riab->latitude }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Garis Longitude</label>
                        <input type="text" name="longitude" value="{{ $riab->longitude }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Link foto SIORI</label>
                        <input type="text" name="link_foto" value="{{ $riab->link_foto }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="deskripsi"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">{{ old('deskripsi', $riab->deskripsi) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jumlah Umat</label>
                        <input type="text" name="jumlah_umat" value="{{ $riab->jumlah_umat }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status Eksisting</label>
                        <label><input type="radio" name="eksisting" value="Aktif" class="mx-2"
                               {{ old('eksisting', $riab->eksisting) == 'Aktif' ? 'checked' : '' }}>
                        Aktif</label>
                        <label><input type="radio" name="eksisting" value="Tidak Aktif" class="mx-2"
                               {{ old('eksisting', $riab->eksisting) == 'TidakAktif' ? 'checked' : '' }}>
                        Tidak AKtif</label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Update</label>
                        <input type="date" name="tgl_update" value="{{ $riab->tgl_update }}"
                               class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status Verifikasi</label>
                        <label><input type="radio" name="status_verifikasi" value="TRUE" class="mx-2"
                               {{ old('status_verifikasi', $riab->status_verifikasi) == 'TRUE' ? 'checked' : '' }}>
                        Terverifikasi</label>
                        <label><input type="radio" name="status_verifikasi" value="FALSE" class="mx-2"
                               {{ old('status_verifikasi', $riab->status_verifikasi) == 'FALSE' ? 'checked' : '' }}>
                        Tidak Terverifikasi</label>
                    </div>

    <div class="mt-6 border-t pt-4">
    <h3 class="text-lg font-semibold mb-2">Informasi Tambahan</h3>

    <div class="space-y-3">
        <div>
            <label class="block text-sm font-medium">Periode Update SISFO</label>
            <input type="text" name="update_sisfo" value="{{ $riab->riabdetail->update_sisfo }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">terdaftar_siori</label>
            <input type="text" name="terdaftar_siori" value="{{ $riab->riabdetail->terdaftar_siori }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">status_tanah</label>
            <input type="text" name="status_tanah" value="{{ $riab->riabdetail->status_tanah }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">th_menerima_sertifikasi</label>
            <input type="text" name="th_menerima_sertifikasi" value="{{ $riab->riabdetail->th_menerima_sertifikasi }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">th_menerima_rehabilitasi</label>
            <input type="text" name="th_menerima_rehabilitasi" value="{{ $riab->riabdetail->th_menerima_rehabilitasi }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">th_menerima_bersih_sehat</label>
            <input type="text" name="th_menerima_bersih_sehat" value="{{ $riab->riabdetail->th_menerima_bersih_sehat }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">th_menerima_kek</label>
            <input type="text" name="th_menerima_kek" value="{{ $riab->riabdetail->th_menerima_kek }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">th_menerima_bantuan_bangun</label>
            <input type="text" name="th_menerima_bantuan_bangun" value="{{ $riab->riabdetail->th_menerima_bantuan_bangun }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">th_menerima_bpriab_perpus</label>
            <input type="text" name="th_menerima_bpriab_perpus" value="{{ $riab->riabdetail->th_menerima_bpriab_perpus }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">luas_tanah</label>
            <input type="text" name="luas_tanah" value="{{ $riab->riabdetail->luas_tanah }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">luas_bangunan</label>
            <input type="text" name="luas_bangunan" value="{{ $riab->riabdetail->luas_bangunan }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>

        <label class="block items-center space-x-2">
            <span>Kondisi Geografis Wilayah</span>
        <input type="checkbox" name="kondisi_geografis[]" value="Gunung Api"
             {{ in_array('Gunung Api', $kondisiGeo) ? 'checked' : '' }}
             class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Gunung Api
        <input type="checkbox" name="kondisi_geografis[]" value="Dataran Tinggi"
             {{ in_array('Dataran Tinggi', $kondisiGeo) ? 'checked' : '' }}
             class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Dataran Tinggi
        </label>
            <input type="checkbox" name="kondisi_geografis[]" value="Pesisir"
        {{ in_array('Pesisir', $kondisiGeo) ? 'checked' : '' }}
        class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Pesisir
        <input type="checkbox" name="kondisi_geografis[]" value="Dataran Rendah"
        {{ in_array('Dataran Rendah', $kondisiGeo) ? 'checked' : '' }}
        class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Dataran Rendah
        <label class="block items-center space-x-2">
            <span>Peta Rawan Bencana</span>
            <input type="checkbox" name="peta_rawan_bencana[]" value="Banjir"
                {{ in_array('Banjir', $petaRawan) ? 'checked' : '' }}
                class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Banjir
            <input type="checkbox" name="peta_rawan_bencana[]" value="Gempa"
                {{ in_array('Gempa', $petaRawan) ? 'checked' : '' }}
                class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Gempa
            <input type="checkbox" name="peta_rawan_bencana[]" value="Tsunami"
                {{ in_array('Tsunami', $petaRawan) ? 'checked' : '' }}
                class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Tsunami
            <input type="checkbox" name="peta_rawan_bencana[]" value="Longsor"
                {{ in_array('Longsor', $petaRawan) ? 'checked' : '' }}
                class="border-2 border-gray-700 px-2 py-1 rounded-md shadow-sm"> Longsor
        </label>

        <label class="flex items-center space-x-2">
            <input type="checkbox" name="sertifikasi_tanah" value="1"
                @checked(old('sertifikasi_tanah', $riab->riabdetail->sertifikasi_tanah ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Sertifikasi Tanah</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="lahan_parkir" value="1"
                @checked(old('lahan_parkir', $riab->riabdetail->lahan_parkir ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Lahan Parkir</span>
        </label>

        <label class="flex items-center space-x-2">
            <input type="checkbox" name="kursi_roda" value="1"
                @checked(old('kursi_roda', $riab->riabdetail->kursi_roda ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Toilet Disable</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="jalur_kursi_roda" value="1"
                @checked(old('jalur_kursi_roda', $riab->riabdetail->jalur_kursi_roda ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Jalur Kursi Roda</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="fasilitas_jalur_kursi_roda" value="1"
                @checked(old('fasilitas_jalur_kursi_roda', $riab->riabdetail->fasilitas_jalur_kursi_roda ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Fasilitas Jalur Kursi Roda</span>
        </label>
                <label class="flex items-center space-x-2">
            <input type="checkbox" name="tempat_bermain" value="1"
                @checked(old('tempat_bermain', $riab->riabdetail->tempat_bermain ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Tempat Bermain</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="toilet_anak" value="1"
                @checked(old('toilet_anak', $riab->riabdetail->toilet_anak ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Toilet Anak</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="wastafel_anak" value="1"
                @checked(old('wastafel_anak', $riab->riabdetail->wastafel_anak ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Wastafel Anak</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="ruang_ac" value="1"
                @checked(old('ruang_ac', $riab->riabdetail->ruang_ac ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Ruang AC</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="perpustakaan" value="1"
                @checked(old('perpustakaan', $riab->riabdetail->perpustakaan ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Perpustakaan</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="pengelola_perpustakaan" value="1"
                @checked(old('pengelola_perpustakaan', $riab->riabdetail->pengelola_perpustakaan ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Ketersediaan Pengelola Perpustakaan</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="alas_duduk" value="1"
                @checked(old('alas_duduk', $riab->riabdetail->alas_duduk ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Alas Duduk</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="sound_system" value="1"
                @checked(old('sound_system', $riab->riabdetail->sound_system ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Sound System</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="lcd_proyektor" value="1"
                @checked(old('lcd_proyektor', $riab->riabdetail->lcd_proyektor ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>LCD Proyektor</span></label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="ruang_laktasi" value="1"
                @checked(old('ruang_laktasi', $riab->riabdetail->ruang_laktasi ?? '') == 'Ada')
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Ruang Laktasi</span></label>
        <div>
            <label class="block text-sm font-medium">jumlah_pengelola_perpustakaan</label>
            <input type="text" name="jumlah_pengelola_perpustakaan" value="{{ $riab->riabdetail->jumlah_pengelola_perpustakaan }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">jumlah_pengelola_riab</label>
            <input type="text" name="jumlah_pengelola_riab" value="{{ $riab->riabdetail->jumlah_pengelola_riab }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">jumlah_kitab_suci</label>
            <input type="text" name="jumlah_kitab_suci" value="{{ $riab->riabdetail->jumlah_kitab_suci }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">jumlah_buku_keagamaan</label>
            <input type="text" name="jumlah_buku_keagamaan" value="{{ $riab->riabdetail->jumlah_buku_keagamaan }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">lpj_bantuan</label>
            <input type="text" name="lpj_bantuan" value="{{ $riab->riabdetail->lpj_bantuan }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">foto_sebelum_bantuan</label>
            <input type="text" name="foto_sebelum_bantuan" value="{{ $riab->riabdetail->foto_sebelum_bantuan }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">foto_setelah_bantuan</label>
            <input type="text" name="foto_setelah_bantuan" value="{{ $riab->riabdetail->foto_setelah_bantuan }}"
                   class="border-2 border-gray-700 mt-2 px-2 py-1 block w-full rounded-md shadow-sm">
        </div>

        </div>
    </div>

                    <!-- Jika ada user login -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Update
                        </button>
                        <button href="{{ route('riab.index') }}" 
                                class="px-4 py-2 bg-gray-600 rounded hover:underline">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
</x-app-layout>

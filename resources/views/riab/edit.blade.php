<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-200">
            {{ __('Edit RIAB') }}
        </h2>
    </x-slot>

@php
    // Helper untuk memastikan data dalam format array
    $kondisiGeo = [];
    $petaRawan = [];
    
    // Cek apakah riabdetail ada
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
    // Jika riabdetail tidak ada, $kondisiGeo dan $petaRawan sudah diinisialisasi sebagai array kosong
@endphp

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pesan error -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <strong>Terdapat kesalahan pada form:</strong>
                    </div>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-gray-900 border border-gray-300 shadow-lg rounded-lg overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-6">
                    <h3 class="text-2xl font-bold">Edit Data RIAB</h3>
                    <p class="text-sm mt-1 opacity-90">{{ $riab->nama }}</p>
                </div>

                <form action="{{ route('riab.update', $riab->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Informasi Lokasi -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-blue-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Lokasi
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Nama RIAB <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama', $riab->nama) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">No Registrasi</label>
                                <input type="text" name="no_registrasi" value="{{ old('no_registrasi', $riab->no_registrasi) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Kabupaten <span class="text-red-500">*</span></label>
                                <select id="kabupaten_id" name="kabupaten_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    @foreach($kabupaten as $k)
                                        <option value="{{ $k->id }}" @selected(old('kabupaten_id', $riab->kabupaten_id) == $k->id)>
                                            {{ $k->kabupaten }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Kecamatan <span class="text-red-500">*</span></label>
                                <select id="kecamatan_id" name="kecamatan_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300">
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
                                <label class="block text-sm font-medium text-gray-100 mb-1">Kelurahan/Desa</label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan', $riab->kelurahan) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">
                                    Kategori 3T 
                                    <a href="https://docs.google.com/document/d/1TI8geSRdMLf19JiWZ_fUzl0vQPpZ-fuz/edit" target="_blank" class="text-blue-500 hover:underline text-xs">(Lihat detail)</a>
                                </label>
                                <div class="flex items-center space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori_3t" value="3T" {{ old('kategori_3t', $riab->kategori_3t) == '3T' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>3T</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori_3t" value="Non 3T" {{ old('kategori_3t', $riab->kategori_3t) == 'Non 3T' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Non 3T</span>
                                    </label>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-100 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="2" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('alamat', $riab->alamat) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Latitude</label>
                                <input type="text" name="latitude" value="{{ old('latitude', $riab->latitude) }}"
                                       placeholder="Contoh: -8.123456"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Longitude</label>
                                <input type="text" name="longitude" value="{{ old('longitude', $riab->longitude) }}"
                                       placeholder="Contoh: 115.123456"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Umum -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-green-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Umum
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Ketua</label>
                                <input type="text" name="ketua" value="{{ old('ketua', $riab->ketua) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Berdiri</label>
                                <input type="number" name="thn_berdiri" value="{{ old('thn_berdiri', $riab->thn_berdiri) }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tanggal Penerbitan Tanda Daftar</label>
                                <input type="date" name="tgl_tanda_daftar" value="{{ old('tgl_tanda_daftar', $riab->tgl_tanda_daftar) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Jenis RIAB</label>
                                <input type="text" name="jenis_riab" value="{{ old('jenis_riab', $riab->jenis_riab) }}"
                                       placeholder="Contoh: Vihara, TITD, Kelenteng Buddha, Cetiya"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Jumlah Umat</label>
                                <input type="number" name="jumlah_umat" value="{{ old('jumlah_umat', $riab->jumlah_umat) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tanggal Update</label>
                                <input type="date" name="tgl_update" value="{{ old('tgl_update', $riab->tgl_update) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-2">Status</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Disetujui" {{ old('status', $riab->status) == 'Disetujui' ? 'checked' : '' }}
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Disetujui</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Ditolak" {{ old('status', $riab->status) == 'Ditolak' ? 'checked' : '' }}
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Ditolak</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Pending" {{ old('status', $riab->status) == 'Pending' ? 'checked' : '' }}
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Pending</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-2">Status Eksisting</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="eksisting" value="Aktif" {{ old('eksisting', $riab->eksisting) == 'Aktif' ? 'checked' : '' }}
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Aktif</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="eksisting" value="Tidak Aktif" {{ old('eksisting', $riab->eksisting) == 'Tidak Aktif' ? 'checked' : '' }}
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Tidak Aktif</span>
                                    </label>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-100 mb-2">Kondisi RIAB</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Sangat Baik" @checked(old('kondisi', $riab->kondisi) == 'Sangat Baik')
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Sangat Baik</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Baik" @checked(old('kondisi', $riab->kondisi) == 'Baik')
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Baik</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Rusak Ringan" @checked(old('kondisi', $riab->kondisi) == 'Rusak Ringan')
                                               class="mr-2 text-yellow-600 focus:ring-yellow-500">
                                        <span>Rusak Ringan</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Rusak Sedang" @checked(old('kondisi', $riab->kondisi) == 'Rusak Sedang')
                                               class="mr-2 text-orange-600 focus:ring-orange-500">
                                        <span>Rusak Sedang</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Rusak Berat" @checked(old('kondisi', $riab->kondisi) == 'Rusak Berat')
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Rusak Berat</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-2">Status Verifikasi</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="status_verifikasi" value="TRUE" {{ old('status_verifikasi', $riab->status_verifikasi) == 'TRUE' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Terverifikasi</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status_verifikasi" value="FALSE" {{ old('status_verifikasi', $riab->status_verifikasi) == 'FALSE' ? 'checked' : '' }}
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Tidak Terverifikasi</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-purple-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi Kontak
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $riab->email) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">No. Telp/HP/WhatsApp</label>
                                <input type="text" name="no_telp" value="{{ old('no_telp', $riab->no_telp) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-100 mb-1">Media Sosial</label>
                                <input type="text" name="media_sosial" value="{{ old('media_sosial', $riab->media_sosial) }}"
                                       placeholder="Instagram/Facebook/Twitter/YouTube/TikTok"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi & Dokumentasi -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-orange-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            Deskripsi & Dokumentasi
                        </h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Deskripsi</label>
                                <textarea name="deskripsi" rows="4"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('deskripsi', $riab->deskripsi) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Link Foto SIORI</label>
                                <input type="url" name="link_foto" value="{{ old('link_foto', $riab->link_foto) }}"
                                       placeholder="https://..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Detail -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-red-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Tanah & Bangunan
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Status Tanah</label>
                                <input type="text" name="status_tanah" value="{{ old('status_tanah', $riab->riabdetail->status_tanah ?? '') }}"
                                       placeholder="Contoh: Hak Milik, Sewa"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Luas Tanah (m²)</label>
                                <input type="number" name="luas_tanah" value="{{ old('luas_tanah', $riab->riabdetail->luas_tanah ?? '') }}"
                                       step="0.01"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Luas Bangunan (m²)</label>
                                <input type="number" name="luas_bangunan" value="{{ old('luas_bangunan', $riab->riabdetail->luas_bangunan ?? '') }}"
                                       step="0.01"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="flex items-center space-x-2 cursor-pointer p-3 border border-gray-300 rounded-lg hover:bg-gray-500">
                                    <input type="checkbox" name="sertifikasi_tanah" value="Ada"
                                        @checked(old('sertifikasi_tanah', $riab->riabdetail->sertifikasi_tanah ?? '') == 'Sudah')
                                        class="rounded text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-medium text-gray-100">Memiliki Sertifikasi Tanah</span>
                                </label>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-100 mb-2">Kondisi Geografis Wilayah</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Gunung Api"
                                             {{ in_array('Gunung Api', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Gunung Api</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Gunung Api"
                                             {{ in_array('Pegunungan', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Pegunungan</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Gunung Api"
                                             {{ in_array('Lembah', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Lembah</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Gunung Api"
                                             {{ in_array('Bukit', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Bukit</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Dataran Tinggi"
                                             {{ in_array('Dataran Tinggi', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Dataran Tinggi</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Dataran Tinggi"
                                             {{ in_array('Dataran Tinggi', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Dataran Tinggi</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Dataran Rendah"
                                             {{ in_array('Dataran Rendah', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Dataran Rendah</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Dataran Tinggi"
                                             {{ in_array('Pantai', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Pantai</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="kondisi_geografis[]" value="Pesisir"
                                             {{ in_array('Pesisir', $kondisiGeo) ? 'checked' : '' }}
                                             class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Pesisir</span>
                                    </label>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-100 mb-2">Peta Rawan Bencana</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="peta_rawan_bencana[]" value="Banjir"
                                            {{ in_array('Banjir', $petaRawan) ? 'checked' : '' }}
                                            class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Banjir</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="peta_rawan_bencana[]" value="Gempa"
                                            {{ in_array('Gempa', $petaRawan) ? 'checked' : '' }}
                                            class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Gempa</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="peta_rawan_bencana[]" value="Tsunami"
                                            {{ in_array('Tsunami', $petaRawan) ? 'checked' : '' }}
                                            class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Tsunami</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="peta_rawan_bencana[]" value="Tsunami"
                                            {{ in_array('Kekeringan', $petaRawan) ? 'checked' : '' }}
                                            class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Kekeringan</span>
                                    </label>
                                    <label class="flex items-center space-x-2 p-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-500">
                                        <input type="checkbox" name="peta_rawan_bencana[]" value="Longsor"
                                            {{ in_array('Tanah Longsor', $petaRawan) ? 'checked' : '' }}
                                            class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm">Tanah Longsor</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Bantuan -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-indigo-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                            Riwayat Penerimaan Bantuan
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Menerima Bantuan Sertifikasi Tanah RIAB</label>
                                <input type="number" name="th_menerima_sertifikasi" value="{{ old('th_menerima_sertifikasi', $riab->riabdetail->th_menerima_sertifikasi ?? '') }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Menerima Bantuan Rehabilitasi/Renovasi RIAB</label>
                                <input type="number" name="th_menerima_rehabilitasi" value="{{ old('th_menerima_rehabilitasi', $riab->riabdetail->th_menerima_rehabilitasi ?? '') }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Menerima Bantuan RIAB Bersih & Sehat</label>
                                <input type="number" name="th_menerima_bersih_sehat" value="{{ old('th_menerima_bersih_sehat', $riab->riabdetail->th_menerima_bersih_sehat ?? '') }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Menerima Bantuan Pemberdayaan RIAB Subsidi Kelompok Ekonomi Kreatif</label>
                                <input type="number" name="th_menerima_kek" value="{{ old('th_menerima_kek', $riab->riabdetail->th_menerima_kek ?? '') }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Menerima Bantuan Pembangunan RIAB</label>
                                <input type="number" name="th_menerima_bantuan_bangun" value="{{ old('th_menerima_bantuan_bangun', $riab->riabdetail->th_menerima_bantuan_bangun ?? '') }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Menerima Bantuan Pemberdayaan RIAB Perpustakaan</label>
                                <input type="number" name="th_menerima_bpriab_perpus" value="{{ old('th_menerima_bpriab_perpus', $riab->riabdetail->th_menerima_bpriab_perpus ?? '') }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-pink-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
                            </svg>
                            Fasilitas & Kelengkapan
                        </h4>
                        <p class="text-sm pb-2 text-gray-300">(Centang fasilitas yang tersedia di rumah ibadah)</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-800">
                                <input type="checkbox" name="lahan_parkir" value="Ada"
                                    @checked(old('lahan_parkir', $riab->riabdetail->lahan_parkir ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Lahan Parkir</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="toilet_disable" value="Ada"
                                    @checked(old('toilet_disable', $riab->riabdetail->toilet_disable ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Toilet Difabel</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="kursi_roda" value="Ada"
                                    @checked(old('kursi_roda', $riab->riabdetail->kursi_roda ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Kursi Roda</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="jalur_kursi_roda" value="Ada"
                                    @checked(old('jalur_kursi_roda', $riab->riabdetail->jalur_kursi_roda ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Jalur Kursi Roda</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="fasilitas_jalur_kursi_roda" value="Ada"
                                    @checked(old('fasilitas_jalur_kursi_roda', $riab->riabdetail->fasilitas_jalur_kursi_roda ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Fasilitas Jalur Kursi Roda</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="lift" value="Ada"
                                    @checked(old('lift', $riab->riabdetail->lift ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Sarana Lift</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="tempat_bermain" value="Ada"
                                    @checked(old('tempat_bermain', $riab->riabdetail->tempat_bermain ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Taman/Tempat Bermain</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="toilet_anak" value="Ada"
                                    @checked(old('toilet_anak', $riab->riabdetail->toilet_anak ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Toilet Anak</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="wastafel_anak" value="Ada"
                                    @checked(old('wastafel_anak', $riab->riabdetail->wastafel_anak ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Wastafel Anak</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="ruang_ac" value="Ada"
                                    @checked(old('ruang_ac', $riab->riabdetail->ruang_ac ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Ruangan AC</span> 
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="ruang_belajar_anak" value="Ada"
                                    @checked(old('ruang_belajar_anak', $riab->riabdetail->ruang_belajar_anak ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Ruangan Belajar Anak</span> 
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="perpustakaan" value="Ada"
                                    @checked(old('perpustakaan', $riab->riabdetail->perpustakaan ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Perpustakaan</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="pengelola_perpustakaan" value="Ada"
                                    @checked(old('pengelola_perpustakaan', $riab->riabdetail->pengelola_perpustakaan ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Pengelola Perpustakaan</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="alas_duduk" value="Ada"
                                    @checked(old('alas_duduk', $riab->riabdetail->alas_duduk ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Alas Duduk</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="sound_system" value="Ada"
                                    @checked(old('sound_system', $riab->riabdetail->sound_system ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Sound System</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="lcd_proyektor" value="Ada"
                                    @checked(old('lcd_proyektor', $riab->riabdetail->lcd_proyektor ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">LCD Proyektor</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="ruang_laktasi" value="Ada"
                                    @checked(old('ruang_laktasi', $riab->riabdetail->ruang_laktasi ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Ruang Laktasi</span>
                            </label>
                            <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-500">
                                <input type="checkbox" name="tempat_duduk_lansia" value="Ada"
                                    @checked(old('tempat_duduk_lansia', $riab->riabdetail->tempat_duduk_lansia ?? '') == 'Ada')
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">Tempat Duduk Ramah Lansia</span>
                            </label>
                        </div>
                    </div>

                    <!-- Statistik & Pengelolaan -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-teal-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                            Statistik & Data Pengelolaan
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Jumlah Pengelola RIAB</label>
                                <input type="number" name="jumlah_pengelola_riab" value="{{ old('jumlah_pengelola_riab', $riab->riabdetail->jumlah_pengelola_riab ?? '') }}"
                                       min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Jumlah Pengelola Perpustakaan</label>
                                <input type="number" name="jumlah_pengelola_perpustakaan" value="{{ old('jumlah_pengelola_perpustakaan', $riab->riabdetail->jumlah_pengelola_perpustakaan ?? '') }}"
                                       min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Jumlah Kitab Suci</label>
                                <input type="number" name="jumlah_kitab_suci" value="{{ old('jumlah_kitab_suci', $riab->riabdetail->jumlah_kitab_suci ?? '') }}"
                                       min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Jumlah Buku Keagamaan</label>
                                <input type="number" name="jumlah_buku_keagamaan" value="{{ old('jumlah_buku_keagamaan', $riab->riabdetail->jumlah_buku_keagamaan ?? '') }}"
                                       min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Lainnya -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-200 mb-4 pb-2 border-b-2 border-gray-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Lainnya
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Periode Update SISFO</label>
                                <input type="text" name="update_sisfo" value="{{ old('update_sisfo', $riab->riabdetail->update_sisfo ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Terdaftar SIORI</label>
                                    <div class="flex items-center space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="terdaftar_siori" value="Sudah" {{ old('terdaftar_siori', $riab->riabdetail->terdaftar_siori ?? '') == 'sudah' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Sudah</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="terdaftar_siori" value="Belum" {{ old('terdaftar_siori', $riab->riabdetail->terdaftar_siori ?? '') == 'belum' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Belum</span>
                                    </label>
                            </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">LPJ Bantuan</label>
                                <input type="text" name="lpj_bantuan" value="{{ old('lpj_bantuan', $riab->riabdetail->lpj_bantuan ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Listrik</label>
                                <input type="text" name="listrik" value="{{ old('listrik', $riab->riabdetail->listrik ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="(diisi penyedia listrik)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Foto Sebelum Bantuan (URL)</label>
                                <input type="url" name="foto_sebelum_bantuan" value="{{ old('foto_sebelum_bantuan', $riab->riabdetail->foto_sebelum_bantuan ?? '') }}"
                                       placeholder="https://..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Foto Setelah Bantuan (URL)</label>
                                <input type="url" name="foto_setelah_bantuan" value="{{ old('foto_setelah_bantuan', $riab->riabdetail->foto_setelah_bantuan ?? '') }}"
                                       placeholder="https://..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Link Berita Acara Penonaktifan</label>
                                <input type="url" name="link_berita_acara_nonaktif" value="{{ old('link_berita_acara_nonaktif', $riab->riabdetail->link_berita_acara_nonaktif ?? '') }}"
                                       placeholder="https://..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Field -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('riab.index') }}" 
                           class="px-6 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Simpan Perubahan
                        </button>
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

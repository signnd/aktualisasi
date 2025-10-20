<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-200">
            {{ __('Tambah OKB') }}
        </h2>
    </x-slot>

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
                    <h3 class="text-2xl font-bold">Edit Data Organisasi Keagamaan Buddha (OKB)</h3>
                    <p class="text-sm mt-1 opacity-90">{{ $okb->nama_okb }}</p>
                </div>

                <form action="{{ route('okb.update', $okb->id) }}" method="POST" class="p-6">
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
                                <label class="block text-sm font-medium text-gray-100 mb-1">Nama Organisasi Keagamaan Buddha<span class="text-red-500">*</span></label>
                                <input type="text" name="nama_okb" value="{{ old('nama_okb', $okb->nama_okb) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">No Registrasi</label>
                                <input type="text" name="no_registrasi" value="{{ old('no_registrasi', $okb->no_registrasi) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Kabupaten/Kota <span class="text-red-500">*</span></label>
                                @if(auth()->user()->user_role === 'admin')
                                    <!-- Admin bisa pilih semua kabupaten -->
                                    <select id="kabupaten_id" name="kabupaten_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300">
                                        <option value="">-- Pilih Kabupaten --</option>
                                        @foreach($kabupaten as $k)
                                            <option value="{{ $k->id }}" {{ old('kabupaten_id', $okb->kabupaten_id) == $k->id ? 'selected' : '' }}>
                                                {{ $k->kabupaten }}
                                            </option>   
                                        @endforeach
                                    </select>
                                @else
                                    <!-- User non-admin hanya bisa lihat kabupatennya -->
                                    <select id="kabupaten_id" name="kabupaten_id" required disabled
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-400 text-gray-700 cursor-not-allowed">
                                        @foreach($kabupaten as $k)
                                            @if($k->id == auth()->user()->kabupaten_id)
                                                <option value="{{ $k->id }}" selected>
                                                    {{ $k->kabupaten }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <!-- Hidden input untuk mengirim value karena disabled field tidak terkirim -->
                                    <input type="hidden" name="kabupaten_id" value="{{ auth()->user()->kabupaten_id }}">
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Kecamatan <span class="text-red-500">*</span></label>
                                <select id="kecamatan_id" name="kecamatan_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach($kecamatan as $kc)
                                        <option value="{{ $kc->id }}" data-kabupaten="{{ $kc->kabupaten_id }}"
                                         @selected(old('kecamatan_id', $okb->kecamatan_id) == $kc->id)>
                                            {{ $kc->kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Kelurahan/Desa</label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan', $okb->kelurahan) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">
                                    Kategori 3T 
                                    <a href="https://docs.google.com/document/d/1TI8geSRdMLf19JiWZ_fUzl0vQPpZ-fuz/edit" target="_blank" class="text-blue-500 hover:underline text-xs">(Lihat detail wilayah 3T)</a>
                                </label>
                                <div class="flex items-center space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori_3t" value="3T" {{ old('kategori_3t', $okb->kategori_3t) == '3T' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>3T</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori_3t" value="Non 3T" {{ old('kategori_3t', $okb->kategori_3t) == 'Non 3T' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Non 3T</span>
                                    </label>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-100 mb-1">Alamat <span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="2" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('alamat', $okb->alamat) }}</textarea>
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
                                <input type="text" name="ketua" value="{{ old('ketua', $okb->ketua) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tahun Berdiri</label>
                                <input type="number" name="thn_berdiri" value="{{ old('thn_berdiri', $okb->thn_berdiri) }}"
                                       min="1900" max="{{ date('Y') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Jenis Kelembagaan</label>

                                <select id="jenis_kelembagaan" name="jenis_kelembagaan" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300"
                                     >
                                    <option value="">-- Pilih Jenis Kelembagaan --</option>
                                        <option value="Majelis/Perkumpulan/Perhimpunan Keagamaan Buddha" id="10" @selected(old('jenis_kelembagaan', $okb->jenis_kelembagaan) == "Majelis/Perkumpulan/Perhimpunan Keagamaan Buddha")>Majelis/Perkumpulan/Perhimpunan Keagamaan Buddha</option>
                                        <option value="Yayasan Keagamaan Buddha" id="20" @selected(old('jenis_kelembagaan', $okb->jenis_kelembagaan) == "Yayasan Keagamaan Buddha")>Yayasan Keagamaan Buddha</option>
                                        <option value="Organisasi Keagamaan Buddha" id="30" @selected(old('jenis_kelembagaan', $okb->jenis_kelembagaan) == "Organisasi Keagamaan Buddha")>Organisasi Keagamaan Buddha</option>
                                        <option value="Organisasi Wanita Keagamaan Buddha" id="31" @selected(old('jenis_kelembagaan', $okb->jenis_kelembagaan) == "Organisasi Wanita Keagamaan Buddha")>Organisasi Wanita Keagamaan Buddha</option>
                                        <option value="Organisasi Kepemudaan/Mahasiswa Buddha" id="32" @selected(old('jenis_kelembagaan', $okb->jenis_kelembagaan) == "Organisasi Kepemudaan/Mahasiswa Buddha")>Organisasi Kepemudaan/Mahasiswa Buddha</option>
                                        <option value="Organisasi yang tidak berbadan hukum dan sejenisnya" id="35" @selected(old('jenis_kelembagaan', $okb->jenis_kelembagaan) == "Organisasi yang tidak berbadan hukum dan lainnya")>Organisasi yang tidak berbadan hukum dan sejenisnya</option>
                                </select>
                            </div>
                            @if(auth()->user()->user_role === 'admin')
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-2">Status</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Disetujui" {{ old('status', $okb->status) == 'Disetujui' ? 'checked' : ''  }}
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Disetujui</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Ditolak" {{ old('status', $okb->status) == 'Ditolak' ? 'checked' : ''  }}
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Ditolak</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Pending" {{ old('status', $okb->status) == 'Pending' ? 'checked' : ''  }}
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Pending</span>
                                    </label>
                                </div>
                            </div>    
                            @endif              
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-2">Status Eksisting</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="eksisting" value="Aktif" {{ old('eksisting', $okb->eksisting) == 'Aktif' ? 'checked' : ''  }}
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Aktif</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="eksisting" value="Tidak Aktif" {{ old('eksisting', $okb->eksisting) == 'Tidak Aktif' ? 'checked' : '' }}
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Tidak Aktif</span>
                                    </label>
                                </div>
                            </div>
                            @if(auth()->user()->user_role === 'admin')
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-2">Status Verifikasi</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="status_verifikasi" value="TRUE" {{ old('status_verifikasi', $okb->status_verifikasi) == 'TRUE' ? 'checked' : ''  }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Terverifikasi</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status_verifikasi" value="FALSE" {{ old('status_verifikasi', $okb->status_verifikasi) == 'FALSE' ? 'checked' : ''  }}
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Tidak Terverifikasi</span>
                                    </label>
                                </div>
                            </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tanggal Penerbitan Tanda Daftar</label>
                                <input type="date" name="tgl_tanda_daftar" value="{{ old('tgl_tanda_daftar', $okb->tgl_tanda_daftar) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Tanggal Update</label>
                                <input type="date" name="tgl_update" value="{{ old('tgl_update', $okb->tgl_update) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Periode Update SISFO</label>
                                <input type="text" name="update_sisfo" value="{{ old('update_sisfo', $okb->update_sisfo) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                                <input type="email" name="email" value="{{ old('email', $okb->email) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">No. Telp/HP (Kantor/PIC)</label>
                                <input type="text" name="no_telp" value="{{ old('no_telp', $okb->no_telp) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Media Sosial</label>
                                <input type="text" name="media_sosial" value="{{ old('media_sosial', $okb->media_sosial) }}"
                                       placeholder="Instagram/Facebook/Twitter/YouTube/TikTok"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100 mb-1">Logo OKB</label>
                                <input type="url" name="logo_okb" value="{{ old('logo_okb', $okb->logo_okb) }}"
                                       placeholder="https://..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Hidden Field -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('okb.index') }}" 
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
        const selectedKecId = "{{ $okb->kecamatan_id }}";
        
        function filterKecamatan() {
            // Ambil kabupaten_id dari select (jika admin) atau dari hidden input (jika user biasa)
            let kabId;
            @if(auth()->user()->user_role === 'admin')
                kabId = kabSelect.value;
            @else
                kabId = "{{ $okb->kabupaten_id }}";
            @endif
            
            // Reset dropdown kecamatan
            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            
            if (kabId) {
                // Filter dan tampilkan kecamatan sesuai kabupaten
                allKec.forEach(opt => {
                    if (opt.dataset.kabupaten === kabId) {
                        const newOpt = opt.cloneNode(true);
                        kecSelect.appendChild(newOpt);
                    }
                });

                // Set kembali kecamatan yang dipilih jika masih sesuai kabupaten
                if (selectedKecId) {
                    kecSelect.value = selectedKecId;
                }
            }
        }
        
        // Filter saat kabupaten berubah
        @if(auth()->user()->user_role === 'admin')
            kabSelect.addEventListener('change', filterKecamatan);
        @endif
        
        // Untuk user non-admin, langsung filter berdasarkan kabupaten mereka
        filterKecamatan();
});
</script>
</x-app-layout>

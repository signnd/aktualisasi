<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-gray-200">
            {{ __('Tambah dhammasekha') }}
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

            <div class="bg-gray-100 dark:bg-gray-900 border border-gray-800 dark:border-gray-300 shadow-lg rounded-lg overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-6">
                    <h3 class="text-2xl font-bold">Tambah Dhammasekha</h3>
                </div>

                <form action="{{ route('dhammasekha.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <!-- Informasi Lokasi -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-blue-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Umum
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nama Dhammasekha<span class="text-red-500">*</span></label>
                                <input type="text" name="nama" required
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Jenis Dhammasekha</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis" value="Dhammasekha Non Formal"
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Dhammasekha Non Formal</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis" value="Nava Dhammasekha"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Nava Dhammasekha</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis" value="Mula Dhammasekha"
                                               class="mr-2 text-yellow-600 focus:ring-yellow-500">
                                        <span>Mula Dhammasekha</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis" value="Uttama Dhammasekha"
                                               class="mr-2 text-orange-600 focus:ring-orange-500">
                                        <span>Uttama Dhammasekha</span>
                                    </label>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Alamat<span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="2" required
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal Berdiri</label>
                                <input type="date" name="tgl_berdiri"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                    <!-- Informasi Perizinan & Penanggung Jawab -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-green-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Perizinan & Penanggung Jawab
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nomor Izin Operasional</label>
                                <input type="text" name="no_izop"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">IZOP PPJG</label>
                                <input type="text" name="izop_ppjg"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal IZOP</label>
                                <input type="date" name="tgl_izop"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Masa IZOP</label>
                                <input type="date" name="masa_izop"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">No Statistik</label>
                                <input type="text" name="no_statistik"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">NPYP</label>
                                <input type="text" name="npyp"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">NPSN</label>
                                <input type="text" name="npsn"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Akreditasi</label>
                                <input type="text" name="akreditasi"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nama Yayasan</label>
                                <input type="text" name="nama_yayasan"
                                       placeholder=""
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Alamat Yayasan</label>
                                <textarea name="alamat_yayasan" rows="2"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Kabupaten/Kota<span class="text-red-500">*</span></label>
                                @if(auth()->user()->user_role === 'admin')
                                    <!-- Admin bisa pilih semua kabupaten -->
                                    <select id="kabupaten_id" name="kabupaten_id" required
                                        class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300">
                                        <option value="">-- Pilih Kabupaten --</option>
                                        @foreach($kabupaten as $k)
                                            <option value="{{ $k->id }}">
                                                {{ $k->kabupaten }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <!-- User non-admin hanya bisa lihat kabupatennya -->
                                    <select id="kabupaten_id" name="kabupaten_id" required disabled
                                        class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg bg-gray-400 text-gray-700 cursor-not-allowed">
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
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nama PIC</label>
                                <input type="text" name="nama_pic"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">No. Telp/HP/WhatsApp</label>
                                <input type="text" name="no_hp"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Email</label>
                                <input type="text" name="email"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Naungan Kemenag</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="naungan_kemenag" value="Ya"
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Ya</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="naungan_kemenag" value="Tidak"
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Tidak</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Naungan Dinas Pendidikan</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="naungan_disdik" value="Ya"
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Ya</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="naungan_disdik" value="Tidak"
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Tidak</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">TK Dinas Pendidikan KB Kemenag</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="tk_disdik_kb_kemenag" value="Ya"
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Ya</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="tk_disdik_kb_kemenag" value="Tidak"
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Tidak</span>
                                    </label>
                                </div>
                            </div>
                            @if(auth()->user()->user_role === 'admin')
                            <!--<div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Status</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Disetujui"
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Disetujui</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Ditolak"
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Ditolak</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status" value="Pending"
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Pending</span>
                                    </label>
                                </div>
                            </div>-->
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Status Eksisting</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="eksisting" value="Aktif"
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Aktif</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="eksisting" value="Tidak Aktif"
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Tidak Aktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Informasi Kondisi dhammasekha -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-purple-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Kondisi Dhammasekha
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Kondisi Dhammasekha</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Sangat Baik"
                                               class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>Sangat Baik</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Baik"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Baik</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Rusak Ringan"
                                               class="mr-2 text-yellow-600 focus:ring-yellow-500">
                                        <span>Rusak Ringan</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Rusak Sedang"
                                               class="mr-2 text-orange-600 focus:ring-orange-500">
                                        <span>Rusak Sedang</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kondisi" value="Rusak Berat"
                                               class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>Rusak Berat</span>
                                    </label>
                                </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 my-2">Link Foto</label>
                                <input type="url" name="foto" 
                                       placeholder="Paste link Google Drive atau link ke gambar di sini..."
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                                <!--<label class="block text-sm font-medium text-gray-800 dark:text-gray-100 my-2">Jumlah Siswa</label>
                                <input type="number" name="jml_siswa"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">-->
                            </div>
                        </div>
                    </div>
                        <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-gray-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Lainnya
                        </h4>
                            <div classs="flex flex-wrap gap-3">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 my-2">Link Berita Acara Penonaktifan</label>
                                <input type="url" name="link_nonaktif" 
                                       placeholder="https://..."
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal Update Terakhir</label>
                                    <input type="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg bg-gray-200 dark:bg-gray-700">
                            </div>
                            <div class="my-3">
                            @if(auth()->user()->user_role === 'admin')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Status</label>
                                    <div class="flex flex-wrap gap-3">
                                        <label class="flex items-center">
                                            <input type="radio" name="status" value="Disetujui"
                                                   class="mr-2 text-green-600 focus:ring-green-500">
                                            <span>Disetujui</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="status" value="Ditolak"
                                                   class="mr-2 text-red-600 focus:ring-red-500">
                                            <span>Ditolak</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="status" value="Pending"
                                                   class="mr-2 text-gray-600 focus:ring-gray-500">
                                            <span>Pending</span>
                                        </label>
                                    </div>
                                </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Status Verifikasi</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="status_verifikasi" value="TRUE"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Terverifikasi</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status_verifikasi" value="FALSE"
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Tidak Terverifikasi</span>
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                    <!-- Deskripsi & Dokumentasi
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-orange-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            Deskripsi & Dokumentasi
                        </h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Deskripsi</label>
                                <textarea name="deskripsi" rows="4"
                                       class="w-full px-3 py-2 border border-gray-800 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>
                        </div>
                    </div> -->

                    <!-- Informasi Lainnya -->

                    <!-- Hidden Field -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('dhammasekha.index') }}" 
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

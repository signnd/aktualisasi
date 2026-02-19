<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-gray-200">
            {{ __('Tambah Guru Agama') }}
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

            <div class="bg-gray-50 dark:bg-gray-900 border border-gray-300 shadow-lg rounded-lg overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-6">
                    <h3 class="text-2xl font-bold">Tambah Data Guru Pendidikan Agama Buddha</h3>
                </div>

                <form action="{{ route('guru-penda.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <!-- Informasi Lokasi -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-green-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Informasi Identitas
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nama Guru<span class="text-red-500">*</span></label>
                                <input type="text" name="nama_guru" required
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">NIP</label>
                                <input type="text" name="nip" placeholder="Diisi NIP/NIPPK untuk ASN"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">NIK</label>
                                <input type="text" name="nik"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">NRG</label>
                                <input type="text" name="nrg"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                    Jenis Kelamin
                                </label>
                                <div class="flex items-center space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Laki-laki</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan"
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Perempuan</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Alamat <span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="2"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Kabupaten <span class="text-red-500">*</span></label>
                                <select id="kabupaten_id" name="kabupaten_id" required
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    @foreach($kabupaten as $k)
                                        <option value="{{ $k->id }}">
                                            {{ $k->kabupaten }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Email</label>
                                <input type="email" name="email"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">No. Telp/HP (Kantor/PIC)</label>
                                <input type="text" name="no_telp"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Status Pegawai</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="status_pegawai" value="PNS" class="mr-2 text-green-600 focus:ring-green-500">
                                        <span>PNS</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status_pegawai" value="PPPK"  class="mr-2 text-red-600 focus:ring-red-500">
                                        <span>PPPK</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status_pegawai" value="Non ASN" class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Non ASN</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="status_pegawai" value="Nonaktif" class="mr-2 text-gray-600 focus:ring-gray-500">
                                            <span>Nonaktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- Informasi Umum -->
            <div class="mb-8" x-data="{ 
                sekolahSD: [''], 
                alamatSD: [''],
                sekolahSMP: [''], 
                alamatSMP: [''],
                sekolahSMA: [''], 
                alamatSMA: ['']
            }">
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-green-500 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        Informasi Sekolah
                    </h4>
                    <div class="space-y-6">
                        <!-- SD Section -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-gray-800 dark:text-gray-100">SD Tempat Mengajar</label>
                            </div>
                            <div class="md:col-span-3 space-y-3">
                                <template x-for="(sekolah, index) in sekolahSD" :key="index">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            <input type="text" 
                                                   :name="`nama_sekolah_sd[${index}]`" 
                                                   x-model="sekolahSD[index]"
                                                   placeholder="Nama SD" 
                                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-200 dark:bg-gray-800">
                                            <input type="text" 
                                                   :name="`alamat_sekolah_sd[${index}]`" 
                                                   x-model="alamatSD[index]"
                                                   placeholder="Alamat SD" 
                                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-200 dark:bg-gray-800">
                                        </div>
                                        <button type="button" 
                                                @click="sekolahSD.splice(index, 1); alamatSD.splice(index, 1)"
                                                class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none transition-colors"
                                                x-show="sekolahSD.length > 1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <button type="button" 
                                        @click="sekolahSD.push(''); alamatSD.push('')"
                                        class="mt-2 px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition duration-200 flex items-center text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    + Tambah Sekolah
                                </button>
                            </div>
                        </div>

                        <!-- SMP Section -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-gray-800 dark:text-gray-100">SMP Tempat Mengajar</label>
                            </div>
                            <div class="md:col-span-3 space-y-3">
                                <template x-for="(sekolah, index) in sekolahSMP" :key="index">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            <input type="text" 
                                                   :name="`nama_sekolah_smp[${index}]`" 
                                                   x-model="sekolahSMP[index]"
                                                   placeholder="Nama SMP" 
                                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-200 dark:bg-gray-800">
                                            <input type="text" 
                                                   :name="`alamat_sekolah_smp[${index}]`" 
                                                   x-model="alamatSMP[index]"
                                                   placeholder="Alamat SMP" 
                                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-200 dark:bg-gray-800">
                                        </div>
                                        <button type="button" 
                                                @click="sekolahSMP.splice(index, 1); alamatSMP.splice(index, 1)"
                                                class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none transition-colors"
                                                x-show="sekolahSMP.length > 1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <button type="button" 
                                        @click="sekolahSMP.push(''); alamatSMP.push('')"
                                        class="mt-2 px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition duration-200 flex items-center text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    + Tambah Sekolah
                                </button>
                            </div>
                        </div>

                        <!-- SMA Section -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-gray-800 dark:text-gray-100">SMA Tempat Mengajar</label>
                            </div>
                            <div class="md:col-span-3 space-y-3">
                                <template x-for="(sekolah, index) in sekolahSMA" :key="index">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            <input type="text" 
                                                   :name="`nama_sekolah_sma[${index}]`" 
                                                   x-model="sekolahSMA[index]"
                                                   placeholder="Nama SMA/SMK" 
                                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-200 dark:bg-gray-800">
                                            <input type="text" 
                                                   :name="`alamat_sekolah_sma[${index}]`" 
                                                   x-model="alamatSMA[index]"
                                                   placeholder="Alamat SMA/SMK" 
                                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-200 dark:bg-gray-800">
                                        </div>
                                        <button type="button" 
                                                @click="sekolahSMA.splice(index, 1); alamatSMA.splice(index, 1)"
                                                class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none transition-colors"
                                                x-show="sekolahSMA.length > 1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <button type="button" 
                                        @click="sekolahSMA.push(''); alamatSMA.push('')"
                                        class="mt-2 px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition duration-200 flex items-center text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    + Tambah Sekolah
                                </button>
                            </div>
                        </div>
                    </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Mata Pelajaran yang disertifikasi</label>
                            <input type="text" name="mapel_sertifikasi"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Link Sertifikasi</label>
                            <input type="url" name="link_sertifikasi"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Link Foto</label>
                            <input type="url" name="foto"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Jumlah Siswa</label>
                            <input type="text" name="jml_siswa"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Keterangan</label>
                            <input type="text" name="keterangan"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        </div>
                    </div>
                </div>


                    <!-- Informasi Lainnya -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-purple-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Informasi Lainnya
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal Update</label>
                                <input type="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md bg-gray-200 dark:bg-gray-700">                            </div>
                            @if(auth()->user()->user_role === 'admin')
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Status Verifikasi</label>
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

                    <!-- Hidden Field -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('guru-penda.index') }}" 
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-gray-200">
            {{ __('Tambah Tenaga Kependidikan (Tendik)') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
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
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h3 class="text-2xl font-bold">Tambah Data Tenaga Kependidikan</h3>
                </div>

                <form action="{{ route('tendik.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 pb-2 border-b-2 border-blue-500 flex items-center">
                            Informasi Identitas
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nama<span class="text-red-500">*</span></label>
                                <input type="text" name="nama_tendik" required
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">NIK</label>
                                <input type="text" name="nik"
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
                                <select name="kabupaten_id" required
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    @foreach($kabupaten as $k)
                                        <option value="{{ $k->id }}">{{ $k->kabupaten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Email</label>
                                <input type="email" name="email"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">No. HP</label>
                                <input type="text" name="no_hp"
                                       class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nama Lembaga</label>
                                <select name="nama_lembaga" class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Pilih Lembaga --</option>
                                    <optgroup label="SMB">
                                        @foreach($smbs as $smb)
                                            <option value="{{ $smb->nama_smb }}">{{ $smb->nama_smb }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Dhammasekha">
                                        @foreach($dhammasekha as $ds)
                                            <option value="{{ $ds->nama }}">{{ $ds->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Pusdiklat">
                                        @foreach($pusdiklat as $pk)
                                            <option value="{{ $pk->nama }}">{{ $pk->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Jika lembaga tidak ada di daftar, silakan tambahkan terlebih dahulu pada data SMB/Dhammasekha/Pusdiklat</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir"
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Program Studi</label>
                                <input type="text" name="program_studi"
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>  

                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">TMT Pendidik</label>
                                <input type="date" name="tmt_pendidik"
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Satker</label>
                                <input type="text" name="satker"
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Instansi yang Mengangkat</label>
                                <input type="text" name="yang_mengangkat"
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Status Pegawai</label>
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

                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Jabatan</label>
                                <input type="text" name="jabatan"
                                    class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Link SK/Surat Keterangan/Mutasi/Resign/Meninggal/Pensiun</label>
                            <input type="text" name="link_sk"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Link Sertifikat</label>
                            <input type="text" name="link_sertifikat"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Link Foto (Google Drive)</label>
                            <input type="text" name="foto"
                                   class="w-full px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Menerima Tunjangan Insentif dari Kemenag</label>
                            <div class="flex gap-3">
                                <label class="flex items-center">
                                    <input type="radio" name="menerima_insentif" value="Ya"
                                           class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Ya</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="menerima_insentif" value="Tidak"
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Tidak</span>
                                    </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-2">Menerima Tunjangan Profesi Guru dari Kemenag</label>
                            <div class="flex gap-3">
                                <label class="flex items-center">
                                    <input type="radio" name="menerima_tpg" value="Ya"
                                           class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Ya</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="menerima_tpg" value="Tidak"
                                               class="mr-2 text-gray-600 focus:ring-gray-500">
                                        <span>Tidak</span>
                                    </label>
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
                    </div>

                    <!-- Hidden Field -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('tendik.index') }}" 
                           class="px-6 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow-lg">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

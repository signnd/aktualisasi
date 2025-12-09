<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            {{ __('Detail SMB') }}
        </h2>
</x-slot>

<div class="py-6">
    <div x-data="siswaModal()" class="relative">
        <div x-show="showAddModal" x-transition style="display:none" class="fixed inset-0 bg-gray-900 bg-opacity-900 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-600 rounded-lg shadow-lg w-full max-w-lg p-6">
                <h2 class="text-lg font-semibold mb-4 dark:text-white">Tambah Siswa Baru</h2>
                <form action="{{ route('smb.siswa.store', $smb->id) }}"method="POST">
                    @csrf
                    <div class="space-y-2">
                        <input type="hidden" name="smb_id" value="{{ $smb->id }}">
                        <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Nama Siswa</label>
                        <input type="text" name="nama_siswa"
                            class="w-full p-1 text-gray-800 dark:text-gray-100 focus:ring-blue-500 rounded-md border-2 border-zinc-800" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Jenis Kelamin</label>
                            <span><input type="radio" name="jenis_kelamin" value="Laki-laki"
                                   class="mr-2 text-green-600 focus:ring-green-500">
                            Laki-laki</span>
                            <span><input type="radio" name="jenis_kelamin" value="Perempuan"
                                   class="mr-2 text-green-600 focus:ring-green-500 mx-2">
                            Perempuan</span>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">NIK</label>
                            <input type="text" name="nik" class="w-full p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100">Tempat Lahir</label>
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100">Tanggal Lahir</label>
                            <input type="text" name="tempat_lahir" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                            <input type="date" name="tgl_lahir" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Alamat</label>
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Kabupaten</label>
                            <input type="text" name="alamat" class="w-full p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                            <select id="kabupaten_id" name="kabupaten_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300/50">
                                <option value="">-- Pilih Kabupaten --</option>
                                @foreach($kabupatens as $k)
                                    <option value="{{ $k->id }}" @selected(old('kabupaten_id', $smb->kabupaten_id) == $k->id)>
                                        {{ $k->kabupaten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">No. HP</label>
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Kelas</label>
                            <input type="text" name="no_hp" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                            <input type="text" name="kelas" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Keterangan</label>
                            <input type="text" name="keterangan" placeholder="Keterangan" class="w-full p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                            <input type="hidden" name="kabupaten_id" value="{{ $smb->kabupaten_id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="closeModal()"
                            class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 dark:text-black">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div x-show="showEditModal" x-transition style="display:none"
        class="fixed inset-0 bg-gray-900 bg-opacity-900 flex items-center justify-center z-50">
            <div @click.away="closeModal()" class="transform transition-all">
            <div class="bg-white dark:bg-gray-600 rounded-lg shadow-lg w-full max-w-lg p-6">
                <h2 class="text-lg font-semibold mb-4 dark:text-white">Edit Siswa</h2>
                <form :action="'/smb/{{ $smb->id }}/siswa/' + siswa.id" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-2">
                        <input type="hidden" name="smb_id" value="{{ $smb->id }}">
                        <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Nama Siswa</label>
                        <input type="text" name="nama_siswa" x-model="siswa.nama_siswa"
                            class="w-full p-1 text-gray-800  dark:text-gray-100 focus:ring-blue-500 rounded-md border-2 border-zinc-800" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Jenis Kelamin</label>
                            <span><input type="radio" name="jenis_kelamin" value="Laki-laki" x-model="siswa.jenis_kelamin"
                                   class="mr-2 text-green-600 focus:ring-green-500">
                            Laki-laki</span>
                            <span><input type="radio" name="jenis_kelamin" value="Perempuan" x-model="siswa.jenis_kelamin"
                                   class="mr-2 text-green-600 focus:ring-green-500 mx-2">
                            Perempuan</span>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">NIK</label>
                            <input type="text" name="nik" x-model="siswa.nik" class="w-full p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100">Tempat Lahir</label>
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100">Tanggal Lahir</label>
                            <input type="text" name="tempat_lahir" x-model="siswa.tempat_lahir" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                            <input type="date" name="tgl_lahir" x-model="siswa.tgl_lahir" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Alamat</label>
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Kabupaten</label>
                            <input type="text" name="alamat" x-model="siswa.alamat" class="w-full p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                            <select id="kabupaten_id" name="kabupaten_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300/50">
                                <option value="">-- Pilih Kabupaten --</option>
                                @foreach($kabupatens as $k)
                                    <option value="{{ $k->id }}" @selected(old('kabupaten_id', $smb->kabupaten_id) == $k->id)>
                                        {{ $k->kabupaten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">No. HP</label>
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Kelas</label>
                            <input type="text" name="no_hp" x-model="siswa.no_hp" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                            <input type="text" name="kelas" x-model="siswa.kelas" class="p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-800  dark:text-gray-100 my-1">Keterangan</label>
                            <input type="text" name="keterangan" x-model="siswa.keterangan" class="w-full p-1 focus:ring-blue-500 rounded-md border-2 border-zinc-800">
                        </div>
                            <input type="hidden" name="kabupaten_id" value="{{ $smb->kabupaten_id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="closeModal()"
                            class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 dark:text-black">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div x-show="showDeleteModal" x-transition style="display:none"
            class="fixed inset-0 bg-gray-900 bg-opacity-900 flex items-center justify-center z-50">
            <div @click.away="closeModal()" class="bg-white dark:bg-gray-600 rounded-lg shadow-lg w-full max-w-sm p-6 transform transition-all">
                <h2 class="text-xl font-semibold mb-4 text-red-600">Konfirmasi Hapus</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-100">
                    Apakah Anda yakin ingin menghapus data siswa: 
                    <strong x-text="siswaToDelete.nama_siswa"></strong>?
                </p>
            <form :action="'/smb/{{ $smb->id }}/siswa/' + siswaToDelete.id" method="POST">
                @csrf
                @method('DELETE')
                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" @click="closeModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </form>
    </div>
</div>


    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray- shadow-lg overflow-hidden">
            <!-- Action Buttons -->
            <div class="px-6 py-4 flex justify-between items-center">
                <a href="{{ route('smb.index', ['page' => session('smb_page', 1)]) }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    ← Kembali
                </a>
                @if(auth()->user()->kabupaten_id === $smb->kabupaten_id || auth()->user()->user_role === 'admin')
                <a href="{{ route('smb.edit', $smb) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Edit Data
                </a>
                @endif
            </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                <h3 class="text-2xl font-bold">{{ $smb->nama_smb }}</h3>
                <p class="text-sm mt-1 opacity-90">NSSMB: {{ $smb->nssmb ?? '-' }}</p>
            </div>

            <div class="p-6 space-y-6"> 

                <!-- Informasi Umum -->
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        Informasi Umum
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Alamat Lengkap</p>
                            <p class="font-medium">{{ $smb->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Kabupaten</p>
                            <p class="font-medium">{{ $smb->kabupaten->kabupaten ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Didirikan</p>
                            <p class="font-medium">{{ $smb->didirikan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">IZOP 1</p>
                            <p class="font-medium">{{ $smb->izop_1 ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">PPJG 1</p>
                            <p class="font-medium">{{ $smb->ppjg_1 ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">PPJG 2</p>
                            <p class="font-medium">{{ $smb->ppjg_2 ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal IZOP</p>
                            <p class="font-medium">{{ $smb->tgl_izop ? \Carbon\Carbon::parse($smb->tgl_izop)->format('d M Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Masa IZOP</p>
                            <p class="font-medium">{{ $smb->masa_izop ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Bapen</p>
                            <p class="font-medium">{{ $smb->bapen ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Alamat Bapen</p>
                            <p class="font-medium">{{ $smb->alamat_bapen ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Jumlah Siswa</p>
                            <p class="font-medium">{{ $smb->siswasmb->count() }} orang</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Kondisi Bangunan</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm 
                                    {{ $smb->kondisi == 'Sangat Baik' ? 'bg-green-100 text-green-800' : 
                                       ($smb->kondisi == 'Baik' ? 'bg-blue-100 text-blue-800' : 
                                       ($smb->kondisi == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($smb->kondisi == 'Rusak Sedang' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800'))) }}">
                                    {{ $smb->kondisi ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Status Eksisting</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $smb->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $smb->eksisting ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Status Verifikasi</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $smb->status_verifikasi == 'TRUE' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 dark:text-gray-100' }}">
                                    {{ $smb->status_verifikasi == 'TRUE' ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal Update</p>
                            <p class="font-medium">{{ $smb->tgl_update ? \Carbon\Carbon::parse($smb->tgl_update)->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        Informasi Kontak
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Nama PIC</p>
                            <p class="font-medium">{{ $smb->nama_pic ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">No. Telp/HP/WhatsApp</p>
                            <p class="font-medium">{{ $smb->no_telp ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Link Dokumentasi -->
                @if($smb->link_foto)
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">Dokumentasi</h4>
                    <div class="space-y-2">
                        <div>
                            <a href="{{ $smb->link_foto }}" target="_blank" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                                Lihat Foto
                            </a>
                        </div>
                        @endif
                        @if(!empty($smb->link_berita_acara_nonaktif) || $smb->link_berita_acara_nonaktif != '-')
                        <!--<div>
                            <a href="{{ $smb->link_berita_acara_nonaktif }}" target="_blank" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                </svg>
                                Lihat Berita Acara Non-Aktif
                            </a>
                        </div>-->
                        @endif
                    </div>
                </div>

                <!-- Data Siswa SMB -->
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Data Siswa ({{ $smb->siswasmb ? $smb->siswasmb->count() : 0 }} siswa)
                        </h4>
                        @if(auth()->user()->kabupaten_id === $smb->kabupaten_id || auth()->user()->user_role === 'admin')
                        <button @click="openAddModal()" 
                           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Tambah Siswa
                        </button>
                        @endif
                    </div>

                    @if($siswas->count() > 0)
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden border border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100 dark:bg-zinc-600 dark">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Nama Siswa</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Jenis Kelamin</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Kelas</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Alamat</th>
                                        @if(auth()->user()->kabupaten_id === $smb->kabupaten_id || auth()->user()->user_role === 'admin')
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">No. HP</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                @foreach($siswas as $index => $siswa)
                                <tbody class="bg-white divide-y dark:bg-zinc-800 divide-gray-200">
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-500 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900  dark:text-gray-100">{{ ($siswas->firstItem() ?? 0) + $loop->index }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900  dark:text-gray-100">{{ $siswa->nama_siswa }}</div>
                                            @if(auth()->user()->kabupaten_id === $smb->kabupaten_id || auth()->user()->user_role === 'admin')
                                            <div class="text-sm text-gray-500 dark:text-gray-300">NIK: {{ $siswa->nik ?? '-' }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900  dark:text-gray-100">{{ $siswa->jenis_kelamin ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900  dark:text-gray-100">{{ $siswa->kelas ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900  dark:text-gray-100">{{ $siswa->alamat ?? '-' }}</td>
                                        @if(auth()->user()->kabupaten_id === $siswa->kabupaten_id || auth()->user()->user_role === 'admin')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900  dark:text-gray-100">{{ $siswa->no_hp ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-2">
                                                <button @click="openEditModal({{ json_encode($siswa) }})" 
                                                   class="text-blue-600 hover:text-blue-900 transition" title="Edit">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        <button @click="openDeleteModal({{ json_encode($siswa) }})" title="Hapus"
                                            class="text-red-600 hover:text-red-900 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                        </button>
                                        @endif
                                        </td>
                                    </tr> 
                                </tbody>
                                @endforeach
                            </table>
                    @if($siswas->hasPages())
                    <div class="bg-white dark:bg-zinc-900 px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $siswas->links() }}
                    </div>
                @endif

                        @else
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg border-button border-gray-300 p-10 text-center">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <p class="text-gray-600 font-medium mb-2">Belum Ada Data Siswa</p>
                            <p class="text-sm text-gray-500 mb-4">Klik tombol "Tambah Siswa" untuk menambahkan data siswa</p>
                        </div>
                        @endif
                </div> <!-- end data siswa -->
            </div> <!-- end informasi -->
        </div> <!-- end container informasi --> 
    </div> <!-- end container keseluruhan halaman termasuk tombol kembali & edit -->
</div>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('siswaModal', () => ({
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        siswa: {},
        siswaToDelete: {},

        openAddModal() {
            this.showAddModal = true;
        },

        openEditModal(data) {
            this.siswa = { ...data };
            this.showEditModal = true;
        },

        openDeleteModal(data) { 
            // Menyimpan data siswa yang akan dihapus
            this.siswaToDelete = { ...data };
            this.showDeleteModal = true;
        },

        closeModal() {
            this.showAddModal = false;
            this.showEditModal = false;
            this.showDeleteModal = false;
            this.siswa = {};
        },
    }));
});
</script>

</x-app-layout>

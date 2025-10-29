<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            {{ __('Detail GUru Pendidikan Agama') }}
        </h2>
</x-slot>

<div class="py-6">


    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray- shadow-lg overflow-hidden">
            <!-- Action Buttons -->
            <div class="px-6 py-4 flex justify-between items-center">
                <a href="{{ route('guru-penda.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    ← Kembali
                </a>
                @if(auth()->user()->kabupaten_id === $guruPenda->kabupaten_id || auth()->user()->user_role === 'admin')
                <a href="{{ route('guru-penda.edit', $guruPenda) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Edit Data
                </a>
                @endif
            </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                <h3 class="text-2xl font-bold">{{ $guruPenda->nama_guru }}</h3>
            </div>

            <div class="p-6 space-y-6"> <!-- informasi -->

                <!-- Informasi Umum -->
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        Informasi Umum
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div">
                            <p class="text-sm text-gray-600 dark:text-gray-300">NIP</p>
                            <p class="font-medium">{{ $guruPenda->nip ?? '-' }}</p>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">NIK</p>
                        <p class="font-medium">{{ $guruPenda->nik ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">NRG</p>
                        <p class="font-medium">{{ $guruPenda->nrg ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Jenis Kelamin</p>
                        <p class="font-medium">{{ $guruPenda->jenis_kelamin ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Tempat/Tanggal Lahir</p>
                        <p class="font-medium">{{ $guruPenda->temepat_lahir ?? '-' }}, {{ $guruPenda->tgl_lahir ? \Carbon\Carbon::parse($guruPenda->tgl_lahir)->format('d M Y') : '-' }}</p>
                    </div>
                    <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Status Pegawai</p>
                            <p class="font-medium">{{ $guruPenda->status_pegawai ?? '-' }}</p>
                        </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Alamat</p>
                        <p class="font-medium">{{ $guruPenda->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Kabupaten/Kota</p>
                        <p class="font-medium">{{ $guruPenda->kabupaten->kabupaten ?? '-' }}</p>
                    </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">No. Telp/HP/WhatsApp</p>
                            <p class="font-medium">{{ $guruPenda->no_hp ?? '-' }}</p>
                        </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Email</p>
                        <p class="font-medium">{{ $guruPenda->email ?? '-' }}</p>
                    </div>

                <!-- Informasi Sekolah -->
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                        Informasi Sekolah
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @php
                                $nama_sekolah_sd = is_array($guruPenda->nama_sekolah_sd) 
                                    ? $guruPenda->nama_sekolah_sd 
                                    : (is_string($guruPenda->nama_sekolah_sd) 
                                        ? json_decode($guruPenda->nama_sekolah_sd, true) ?? [] 
                                        : []);
                                $alamat_sekolah_sd = is_array($guruPenda->alamat_sekolah_sd) 
                                    ? $guruPenda->alamat_sekolah_sd 
                                    : (is_string($guruPenda->alamat_sekolah_sd) 
                                        ? json_decode($guruPenda->alamat_sekolah_sd, true) ?? [] 
                                        : []);
                                $nama_sekolah_smp = is_array($guruPenda->nama_sekolah_smp) 
                                    ? $guruPenda->nama_sekolah_smp 
                                    : (is_string($guruPenda->nama_sekolah_smp) 
                                        ? json_decode($guruPenda->nama_sekolah_smp, true) ?? [] 
                                        : []);
                                $alamat_sekolah_smp = is_array($guruPenda->alamat_sekolah_smp) 
                                    ? $guruPenda->alamat_sekolah_smp 
                                    : (is_string($guruPenda->alamat_sekolah_smp) 
                                        ? json_decode($guruPenda->alamat_sekolah_smp, true) ?? [] 
                                        : []);
                                $nama_sekolah_sma = is_array($guruPenda->nama_sekolah_sma) 
                                    ? $guruPenda->nama_sekolah_sma 
                                    : (is_string($guruPenda->nama_sekolah_sma) 
                                        ? json_decode($guruPenda->nama_sekolah_sma, true) ?? [] 
                                        : []);
                                $alamat_sekolah_sma = is_array($guruPenda->alamat_sekolah_sma) 
                                    ? $guruPenda->alamat_sekolah_sma 
                                    : (is_string($guruPenda->alamat_sekolah_sma) 
                                        ? json_decode($guruPenda->alamat_sekolah_sma, true) ?? [] 
                                        : []);
                            @endphp
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">SD tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($nama_sekolah_sd))
                                        {{ implode(', ', $nama_sekolah_sd) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Alamat SD tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($alamat_sekolah_sd))
                                        {{ implode(', ', $alamat_sekolah_sd) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">SMP tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($nama_sekolah_smp))
                                        {{ implode(', ', $nama_sekolah_smp) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Alamat SMP tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($alamat_sekolah_smp))
                                        {{ implode(', ', $alamat_sekolah_smp) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">SMA/SMK tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($nama_sekolah_sma))
                                        {{ implode(', ', $nama_sekolah_sma) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">SMA tempat Mengajar</p>
                                <p class="font-medium">
                                    @if(!empty($alamat_sekolah_sma))
                                        {{ implode(', ', $alamat_sekolah_sma) }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Sertifikasi</p>
                            <p class="font-medium">{{ $guruPenda->sertifikasi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal Sertifikasi</p>
                            <p class="font-medium">{{ $guruPenda->tgl_sertifikasii ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Mata Pelajaran yang Tersertifikasi</p>
                            <p class="font-medium">{{ $guruPenda->mapel_sertifikasi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Pendidikan Terakhir</p>
                            <p class="font-medium">{{ $guruPenda->pendidikan_terakhir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Link Sertifikat Sertifikasi</p>
                            @if($guruPenda->link_sertifikasi)
                            <div>
                                <a href="{{ $guruPenda->link_sertifikasi }}" target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                    Lihat
                                </a>
                            </div>
                            @else
                            <p class="font-medium">Belum ada</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Link Foto</p>
                            @if($guruPenda->foto)
                            <div>
                                <a href="{{ $guruPenda->foto }}" target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                    Lihat Foto
                                </a>
                            </div>
                            @else
                            <p class="font-medium">Belum ada</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Jumlah Siswa</p>
                            <p class="font-medium">{{ $guruPenda->jml_siswa ? number_format($guruPenda->jml_siswa) . ' orang' : '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                        Informasi Lainnya
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Keterangan</p>
                            <p class="font-medium">{{ $guruPenda->keterangan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Status Verifikasi</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $guruPenda->status_verifikasi == 'TRUE' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 dark:text-gray-800' }}">
                                    {{ $guruPenda->status_verifikasi == 'TRUE' ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal Update</p>
                            <p class="font-medium">{{ $guruPenda->tgl_update ? \Carbon\Carbon::parse($guruPenda->tgl_update)->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>




            </div> <!-- end informasi -->
        </div> <!-- end container informasi --> 
    </div> <!-- end container keseluruhan halaman termasuk tombol kembali & edit -->
</div>

</x-app-layout>

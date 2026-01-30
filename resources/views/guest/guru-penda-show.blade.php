<x-guest-layout>
    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.guru-penda.index', array_merge(request()->only('search','kabupaten_id'), ['page' => request('page', session('guru_penda_page', 1))])) }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Guru
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 shadow-lg rounded-lg overflow-hidden">
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <!-- Header Section -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                        <h3 class="text-2xl font-bold">{{ $guruPenda->nama_guru }}</h3>
                    </div>

                    <div class="p-6"> <!-- informasi -->
                        <div class="flex flex-col xl:flex-row-reverse gap-8">
                            <!-- Unit Foto -->
                            <div class="w-full xl:w-auto flex justify-center xl:block">
                                <div class="relative group">
                        @if($guruPenda->foto)
                            @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $guruPenda->foto;
                            $fileId = null;
                            $isGoogleDrive = false;
                            $isDirectImage = false;
                            
                            // Cek apakah URL dari Google Drive
                            if (strpos($imageUrl, 'drive.google.com') !== false) {
                                $isGoogleDrive = true;
                                // Extract file ID dari berbagai format URL Google Drive
                                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $imageUrl, $matches)) {
                                    $fileId = $matches[1];
                                } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $imageUrl, $matches)) {
                                    $fileId = $matches[1];
                                }
                                
                                if ($fileId) {
                                    // Gunakan format direct image dari lh3.googleusercontent.com
                                    $imageUrl = "https://lh3.googleusercontent.com/d/{$fileId}=w300";
                                }
                            } 
                            // Cek apakah URL langsung ke gambar (jpg, jpeg, png, gif, webp, svg)
                            elseif (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)(\?.*)?$/i', $imageUrl)) {
                                $isDirectImage = true;
                            }
                        @endphp
                         <img
                            src="{{ $imageUrl }}" 
                             alt="{{ $guruPenda->nama_guru }}"
                             class="h-[300px] w-[225px] object-contain rounded-xl shadow-lg border-4 border-white dark:border-gray-700 bg-gray-100 transition-transform duration-300 group-hover:scale-[1.02]"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($guruPenda->nama_guru) }}&size=240&background=random&color=fff&font-size=0.33'; this.nextElementSibling.classList.remove('hidden');">
                        <div class="mt-2 text-center">
                            <a href="{{ $guruPenda->foto }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 flex items-center justify-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Buka Foto Asli
                            </a>
                        </div>
                    @else
                        <div class="h-[300px] w-[225px] flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-xl border-4 border-dashed border-gray-300 dark:border-gray-600 text-gray-400">
                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-xs">Foto tidak tersedia</span>
                        </div>
                    @endif
                </div>
            </div>

                            <!-- Detail Informasi -->
                            <div class="flex-1 space-y-8">
                                <!-- Informasi Umum -->
                                <div class="border-b dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-bold text-blue-700 dark:text-blue-400 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                        </svg>
                                        Informasi Umum
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->nama_guru }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">NIP</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->nip ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">NIK</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->nik ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">NRG</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->nrg ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->jenis_kelamin ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tempat/Tanggal Lahir</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->tempat_lahir ?? '-' }}, {{ $guruPenda->tgl_lahir ? \Carbon\Carbon::parse($guruPenda->tgl_lahir)->format('d M Y') : '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status Pegawai</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->status_pegawai ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kabupaten/Kota</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->kabupaten->kabupaten ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">No. WhatsApp</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->no_hp ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->email ?? '-' }}</p>
                                        </div>
                                        <div class="md:col-span-2">
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Alamat Domisili</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->alamat ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Sekolah -->
                                <div class="border-b dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-bold text-blue-700 dark:text-blue-400 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                                        </svg>
                                        Informasi Sekolah & Sertifikasi
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                        @php
                                            $nama_sekolah_sd = is_array($guruPenda->nama_sekolah_sd) ? $guruPenda->nama_sekolah_sd : json_decode($guruPenda->nama_sekolah_sd, true) ?? [];
                                            $alamat_sekolah_sd = is_array($guruPenda->alamat_sekolah_sd) ? $guruPenda->alamat_sekolah_sd : json_decode($guruPenda->alamat_sekolah_sd, true) ?? [];
                                            
                                            $nama_sekolah_smp = is_array($guruPenda->nama_sekolah_smp) ? $guruPenda->nama_sekolah_smp : json_decode($guruPenda->nama_sekolah_smp, true) ?? [];
                                            $alamat_sekolah_smp = is_array($guruPenda->alamat_sekolah_smp) ? $guruPenda->alamat_sekolah_smp : json_decode($guruPenda->alamat_sekolah_smp, true) ?? [];
                                            
                                            $nama_sekolah_sma = is_array($guruPenda->nama_sekolah_sma) ? $guruPenda->nama_sekolah_sma : json_decode($guruPenda->nama_sekolah_sma, true) ?? [];
                                            $alamat_sekolah_sma = is_array($guruPenda->alamat_sekolah_sma) ? $guruPenda->alamat_sekolah_sma : json_decode($guruPenda->alamat_sekolah_sma, true) ?? [];
                                        @endphp
                                        
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">SD tempat Mengajar</p>
                                            <div class="space-y-1">
                                                @forelse($nama_sekolah_sd as $idx => $nama)
                                                    <p class="text-gray-900 dark:text-gray-100 font-medium">
                                                        {{ $nama }} <span class="text-gray-500 text-xs font-normal">({{ $alamat_sekolah_sd[$idx] ?? '-' }})</span>
                                                    </p>
                                                @empty
                                                    <p class="text-gray-900 dark:text-gray-100 font-medium">-</p>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">SMP tempat Mengajar</p>
                                            <div class="space-y-1">
                                                @forelse($nama_sekolah_smp as $idx => $nama)
                                                    <p class="text-gray-900 dark:text-gray-100 font-medium">
                                                        {{ $nama }} <span class="text-gray-500 text-xs font-normal">({{ $alamat_sekolah_smp[$idx] ?? '-' }})</span>
                                                    </p>
                                                @empty
                                                    <p class="text-gray-900 dark:text-gray-100 font-medium">-</p>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">SMA/SMK tempat Mengajar</p>
                                            <div class="space-y-1">
                                                @forelse($nama_sekolah_sma as $idx => $nama)
                                                    <p class="text-gray-900 dark:text-gray-100 font-medium">
                                                        {{ $nama }} <span class="text-gray-500 text-xs font-normal">({{ $alamat_sekolah_sma[$idx] ?? '-' }})</span>
                                                    </p>
                                                @empty
                                                    <p class="text-gray-900 dark:text-gray-100 font-medium">-</p>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pendidikan Terakhir</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->pendidikan_terakhir ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Sertifikasi</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->sertifikasi ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tgl Sertifikasi</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->tgl_sertifikasi ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Mapel Sertifikasi</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $guruPenda->mapel_sertifikasi ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Sertifikat</p>
                                            @if($guruPenda->link_sertifikasi)
                                                <a href="{{ $guruPenda->link_sertifikasi }}" target="_blank" class="inline-flex items-center text-blue-600 hover:underline">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                                    Lihat Sertifikat
                                                </a>
                                            @else
                                                <p class="text-gray-400 font-medium italic">Belum diunggah</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Lainnya -->
                                <div>
                                    <h4 class="text-lg font-bold text-blue-700 dark:text-blue-400 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                        </svg>
                                        Informasi Tambahan
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Jumlah Siswa</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium font-mono text-lg">{{ $guruPenda->jml_siswa ? number_format($guruPenda->jml_siswa) : '0' }} <span class="text-xs text-gray-500 font-sans">Siswa</span></p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status Verifikasi</p>
                                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $guruPenda->status_verifikasi == 'TRUE' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $guruPenda->status_verifikasi == 'TRUE' ? 'Terverifikasi' : 'Pending' }}
                                            </span>
                                        </div>
                                        <div class="md:col-span-2">
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Keterangan</p>
                                            <p class="text-gray-900 dark:text-gray-100">{{ $guruPenda->keterangan ?? '-' }}</p>
                                        </div>
                                        <div class="md:col-span-2 pt-2 text-[10px] text-gray-400 italic">
                                            Terakhir diperbarui pada: {{ $guruPenda->tgl_update ? \Carbon\Carbon::parse($guruPenda->tgl_update)->format('d/m/Y') : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end informasi -->
                </div> <!-- end border -->
            </div> <!-- end bg-white -->
        </div>
    </div>
</x-guest-layout>
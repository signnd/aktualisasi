<x-guest-layout>
    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('guest.tendik.index', array_merge(request()->only('search','kabupaten_id'), ['page' => request('page', session('guru_penda_page', 1))])) }}" 
                   class="inline-flex items-center text-purple-600 dark:text-purple-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Tendik
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-zinc-800 shadow-lg rounded-lg overflow-hidden">
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <!-- Header Section -->
                    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-6">
                        <h3 class="text-2xl font-bold">{{ $tendik->nama_tendik }}</h3>
                    </div>

                    <div class="p-6"> <!-- informasi -->
                        <div class="flex flex-col xl:flex-row-reverse gap-8">
                            <!-- Unit Foto -->
                            <div class="w-full xl:w-auto flex justify-center xl:block">
                                <div class="relative group">
                        @if($tendik->foto)
                            @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $tendik->foto;
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
                             alt="{{ $tendik->nama_guru }}"
                             class="h-[300px] w-[225px] object-contain rounded-xl shadow-lg border-4 border-white dark:border-gray-700 bg-gray-100 transition-transform duration-300 group-hover:scale-[1.02]"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($tendik->nama_tendik) }}&size=240&background=random&color=fff&font-size=0.33'; this.nextElementSibling.classList.remove('hidden');">
                        <div class="mt-2 text-center">
                            <a href="{{ $tendik->foto }}" target="_blank" class="text-xs text-purple-600 hover:text-purple-800 flex items-center justify-center">
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
                                    <h4 class="text-lg font-bold text-purple-700 dark:text-purple-400 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                        </svg>
                                        Informasi Umum
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">NRG</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->nrg ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->jenis_kelamin ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status Pegawai</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->status_pegawai ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kabupaten/Kota</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->kabupaten->kabupaten ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Sekolah -->
                                <div class="border-b dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-bold text-purple-700 dark:text-purple-400 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                                        </svg>
                                        Informasi Sekolah & Sertifikasi
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                        
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Lembaga</p>
                                @if($tendik->lembaga)
                                    <a href="{{ route('guest.' . strtolower(class_basename($tendik->lembaga_type)) . '.show', $tendik->lembaga_id) }}" class="text-blue-600 hover:underline">
                                        {{ $tendik->nama_lembaga }}
                                    </a>
                                @else
                                    {{ $tendik->nama_lembaga }}
                                @endif
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">TMT Pendidik</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->tmt_pendidik ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Satuan Kerja</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->satker ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pihak yang mengangkat</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->yang_mengangkat ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Jabatan</p>
                                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $tendik->jabatan ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Sertifikasi</p>
                                            @if($tendik->link_sertifikasi)
                                                <a href="{{ $tendik->link_sertifikasi }}" target="_blank" class="inline-flex items-center text-purple-600 hover:underline">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                                    Lihat Sertifikasi
                                                </a>
                                            @else
                                                <p class="text-gray-400 font-medium italic">Belum ada</p>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Surat Keterangan</p>
                                            @if($tendik->link_sk)
                                                <a href="{{ $tendik->link_sk }}" target="_blank" class="inline-flex items-center text-purple-600 hover:underline">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                                    Lihat SK
                                                </a>
                                            @else
                                                <p class="text-gray-400 font-medium italic">Belum ada</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Lainnya -->
                                <div>
                                    <h4 class="text-lg font-bold text-purple-700 dark:text-purple-400 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                        </svg>
                                        Informasi Tambahan
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                        <div class="md:col-span-2">
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Keterangan</p>
                                            <p class="text-gray-900 dark:text-gray-100">{{ $tendik->keterangan ?? '-' }}</p>
                                        </div>
                                        <div class="md:col-span-2 pt-2 text-[10px] text-gray-400 italic">
                                            Terakhir diperbarui pada: {{ $tendik->tgl_update ? \Carbon\Carbon::parse($tendik->tgl_update)->format('d/m/Y') : '-' }}
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
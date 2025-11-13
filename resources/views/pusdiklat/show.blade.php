<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            {{ __('Detail pusdiklat') }}
        </h2>
</x-slot>



    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray- shadow-lg overflow-hidden">
            <!-- Action Buttons -->
            <div class="px-6 py-4 flex justify-between items-center">
                <a href="{{ route('pusdiklat.index', ['page' => session('pusdiklat_page', 1)]) }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    ← Kembali
                </a>
                @if(auth()->user()->kabupaten_id === $pusdiklat->kabupaten_id || auth()->user()->user_role === 'admin')
                <a href="{{ route('pusdiklat.edit', $pusdiklat) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Edit Data
                </a>
                @endif
            </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                <h3 class="text-2xl font-bold">{{ $pusdiklat->nama }}</h3>
                <p class="text-sm mt-1 opacity-90">No. Statistik: {{ $pusdiklat->no_statistik ?? '-' }}</p>
            </div>

            <div class="p-6 space-y-6"> <!-- informasi -->
                <!-- Informasi Lokasi 
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Informasi Umum
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    </div>
                </div> -->

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
                            <p class="font-medium">{{ $pusdiklat->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Kabupaten</p>
                            <p class="font-medium">{{ $pusdiklat->kabupaten->kabupaten ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Didirikan</p>
                            <p class="font-medium">{{ $pusdiklat->Berdiri ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">IZOP 1</p>
                            <p class="font-medium">{{ $pusdiklat->izop_1 ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">PPJG 1</p>
                            <p class="font-medium">{{ $pusdiklat->ppjg_1 ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">PPJG 2</p>
                            <p class="font-medium">{{ $pusdiklat->ppjg_2 ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tahun IZOP</p>
                            <p class="font-medium">{{ $pusdiklat->th_izop ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal IZOP</p>
                            <p class="font-medium">{{ $pusdiklat->tgl_izop ? \Carbon\Carbon::parse($pusdiklat->tgl_izop)->format('d M Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Masa IZOP</p>
                            <p class="font-medium">{{ $pusdiklat->masa_izop ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Bapen</p>
                            <p class="font-medium">{{ $pusdiklat->bapen ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Alamat Bapen</p>
                            <p class="font-medium">{{ $pusdiklat->alamat_bapen ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Jumlah Siswa</p>
                            <p class="font-medium">{{ $pusdiklat->jml_siswa ?? 'Belum ada' }} siswa</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Kondisi Bangunan</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm 
                                    {{ $pusdiklat->kondisi == 'Sangat Baik' ? 'bg-green-100 text-green-800' : 
                                       ($pusdiklat->kondisi == 'Baik' ? 'bg-blue-100 text-blue-800' : 
                                       ($pusdiklat->kondisi == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($pusdiklat->kondisi == 'Rusak Sedang' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800'))) }}">
                                    {{ $pusdiklat->kondisi ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Status Eksisting</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $pusdiklat->eksisting == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $pusdiklat->eksisting ?? '-' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Status Verifikasi</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-sm {{ $pusdiklat->status_verifikasi == 'TRUE' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 dark:text-gray-100' }}">
                                    {{ $pusdiklat->status_verifikasi == 'TRUE' ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal Update</p>
                            <p class="font-medium">{{ $pusdiklat->tgl_update ? \Carbon\Carbon::parse($pusdiklat->tgl_update)->format('d M Y') : '-' }}</p>
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
                            <p class="font-medium">{{ $pusdiklat->nama_pic ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">No. Telp/HP/WhatsApp</p>
                            <p class="font-medium">{{ $pusdiklat->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Link Dokumentasi -->
                @if($pusdiklat->foto || $pusdiklat->link_berita_acara_nonaktif)
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">Dokumentasi</h4>
                    <div class="space-y-2">
                    <!-- Link Foto -->
                    @if($pusdiklat->foto)
                    <div class="border-b pb-4">
                        @php
                            // Deteksi jenis URL dan konversi jika perlu
                            $imageUrl = $pusdiklat->foto;
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
                                    $imageUrl = "https://lh3.googleusercontent.com/d/{$fileId}";
                                }
                            } 
                            // Cek apakah URL langsung ke gambar (jpg, jpeg, png, gif, webp, svg)
                            elseif (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)(\?.*)?$/i', $imageUrl)) {
                                $isDirectImage = true;
                            }
                        @endphp
                        
                        <div class="space-y-3">
                            @if($isGoogleDrive && $fileId)
                                <!-- Google Drive Image dengan fallback ke iframe -->
                                <div class="relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50">
                                    <img id="main-image" 
                                         src="{{ $imageUrl }}" 
                                         alt="Foto {{ $pusdiklat->nama }}"
                                         class="w-full h-auto max-h-96 object-contain mx-auto"
                                         style="display: block;"
                                         onerror="showIframeViewer('main-image', 'iframe-viewer-main', '{{ $fileId }}')">
                                    
                                    <!-- Fallback: Google Drive Viewer (iframe) -->
                                    <iframe id="iframe-viewer-main"
                                            src="https://drive.google.com/file/d/{{ $fileId }}/preview" 
                                            class="w-full h-96"
                                            style="display: none; border: none;"
                                            allow="autoplay"></iframe>
                                </div>
                            @elseif($isDirectImage)
                                <!-- Direct Image URL -->
                                <div class="relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50">
                                    <img src="{{ $imageUrl }}" 
                                         alt="Foto {{ $pusdiklat->name }}"
                                         class="w-full h-auto max-h-96 object-contain mx-auto"
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-96 text-gray-500\'><div class=\'text-center\'><svg class=\'w-16 h-16 mx-auto mb-4 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg><p class=\'text-sm\'>Gambar tidak dapat dimuat</p><p class=\'text-xs text-gray-400 mt-1\'>URL gambar mungkin tidak valid atau tidak dapat diakses</p></div></div>';">
                                </div>
                            @else
                                <!-- URL tidak dikenali atau format tidak didukung -->
                                <div class="relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50 p-10">
                                    <div class="text-center text-gray-500">
                                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                        <p class="font-medium">Format link tidak didukung</p>
                                        <p class="text-sm mt-1">Silakan gunakan link Google Drive atau URL gambar langsung</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Link to original -->
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <a href="{{ $pusdiklat->foto }}" target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
                                    </svg>
                                    @if($isGoogleDrive)
                                        Buka di Google Drive
                                    @else
                                        Buka Gambar Asli
                                    @endif
                                </a>
                                
                               @if($fileId)
                               <!-- 
                                <a href="https://drive.google.com/uc?export=download&id={{ $fileId }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Download
                                </a> -->
                                @elseif($isDirectImage)
                                <!-- <a href="{{ $imageUrl }}" 
                                   download
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Download
                                </a> -->
                                @endif
                            </div>
                        </div>
                    </div>
                        </a>
                    @endif
                        </div>
                        @if($pusdiklat->link_berita_acara_nonaktif)
                        <div>
                            <a href="{{ $pusdiklat->link_berita_acara_nonaktif }}" target="_blank" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                </svg>
                                Lihat Berita Acara Non-Aktif
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
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

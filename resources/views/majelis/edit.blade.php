<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight h4: text-gray-900 dark:text-gray-900 ">
            {{ __('Tambah Majelis') }}
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

            <div class="bg-gray-100 dark:bg-gray-900 border border-gray-800 dark:border-gray-600 dark:border-gray-300 shadow-lg rounded-lg overflow-hidden">                
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-6">
                    <h3 class="text-2xl font-bold">Edit Majelis Agama Buddha</h3>
                </div>

                <form action="{{ route('majelis.update', $majelis->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <!-- Informasi Lokasi -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-900  mb-4 pb-2 border-b-2 border-blue-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Umum
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Nama Majelis Agama Buddha<span class="text-red-500">*</span></label>
                                <input type="text" name="nama_majelis" value="{{ old('nama_majelis', $majelis->nama_majelis) }}" required
                                       class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Sekte</label>
                                <input type="text" name="sekte" value="{{ old('sekte', $majelis->sekte) }}"
                                       class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Binaan</label>
                                <input type="text" name="binaan" value="{{ old('binaan', $majelis->binaan) }}"
                                       class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Ketua</label>
                                <input type="text" name="ketua" value="{{ old('ketua', $majelis->ketua) }}"
                                       class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Keterangan</label>
                                <textarea name="keterangan" rows="4"
                                       class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('keterangan', $majelis->keterangan) }}</textarea>
                            </div>
                                <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Kabupaten/Kota/Provinsi<span class="text-red-500">*</span></label>
                                @if(auth()->user()->user_role === 'admin')
                                    <!-- Admin bisa pilih semua kabupaten -->
                                    <select id="kabupaten_id" name="kabupaten_id" required
                                        class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black bg-gray-300">
                                        <option value="">-- Pilih Kabupaten --</option>
                                        @foreach($kabupaten as $k)
                                            <option value="{{ $k->id }}" {{ old('kabupaten_id', $majelis->kabupaten_id) == $k->id ? 'selected' : '' }}>
                                                {{ $k->kabupaten }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <!-- User non-admin hanya bisa lihat kabupatennya -->
                                    <select id="kabupaten_id" name="kabupaten_id" required disabled
                                        class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg bg-gray-400 text-gray-700 cursor-not-allowed">
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
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal Terdaftar</label>
                                <input type="date" name="tgl_terdaftar" value="{{ old('tgl_terdaftar', $majelis->tgl_terdaftar) }}"
                                       class="w-full px-3 py-2 border border-gray-600 dark:border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        
                    </div>
                </div>

                    <!-- Hidden Field -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('majelis.index') }}" 
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

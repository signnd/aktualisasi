<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-gray-200">
            {{ __('Edit Informasi') }}
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

            <div class="bg-gray-50 dark:bg-zinc-900 border border-gray-300 shadow-lg rounded-lg overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-6">
                    <h3 class="text-2xl font-bold">Edit Informasi</h3>
                </div>

                <form action="{{ route('informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Informasi -->
                    <div class="mb-8">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Judul<span class="text-red-500">*</span></label>
                                <input type="text" name="judul" value="{{ old('judul', $informasi->judul) }}" required
                                       class="w-full dark:bg-zinc-800 px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Ringkasan (Opsional)</label>
                                <input type="text" name="ringkasan" value="{{ old('ringkasan', $informasi->ringkasan) }}"
                                       class="w-full dark:bg-zinc-800 px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                    Kategori
                                </label>
                                <div class="flex items-center space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori" value="Informasi Publik"
                                               class="mr-2 text-blue-600 focus:ring-blue-500" {{ old('kategori', $informasi->kategori) == 'Informasi Publik' ? 'checked' : '' }}>
                                        <span>Informasi Publik</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori" value="Informasi Internal"
                                               class="mr-2 text-blue-600 focus:ring-blue-500" {{ old('kategori', $informasi->kategori) == 'Informasi Internal' ? 'checked' : '' }}>
                                        <span>Informasi Internal</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="kategori" value="Informasi Lainnya"
                                               class="mr-2 text-blue-600 focus:ring-blue-500" {{ old('kategori', $informasi->kategori) == 'Informasi Lainnya' ? 'checked' : '' }}>
                                        <span>Informasi Lainnya</span>
                                    </label>
                                </div>
                            </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Foto</label>

                            @php
                                $existingPhotos = [];

                                foreach (($informasi->fotos ?? []) as $photo) {
                                    $storagePosition = strpos($photo, '/storage/');

                                    if ($storagePosition !== false) {
                                        $existingPhotos[] = substr($photo, $storagePosition);
                                    }
                                }

                                $externalPhotoValue = $informasi->foto;
                                $legacyStoragePosition = $externalPhotoValue ? strpos($externalPhotoValue, '/storage/') : false;

                                if ($legacyStoragePosition !== false) {
                                    $legacyPhoto = substr($externalPhotoValue, $legacyStoragePosition);

                                    if (! in_array($legacyPhoto, $existingPhotos, true)) {
                                        $existingPhotos[] = $legacyPhoto;
                                    }

                                    $externalPhotoValue = null;
                                }

                                $externalPhotoUrl = $externalPhotoValue;

                                if ($externalPhotoUrl && str_contains($externalPhotoUrl, 'drive.google.com')) {
                                    if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $externalPhotoUrl, $driveMatch)) {
                                        $externalPhotoUrl = 'https://lh3.googleusercontent.com/d/' . $driveMatch[1];
                                    } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $externalPhotoUrl, $driveMatch)) {
                                        $externalPhotoUrl = 'https://lh3.googleusercontent.com/d/' . $driveMatch[1];
                                    }
                                }

                                $photoCount = count($existingPhotos);
                                $remainingPhotoSlots = max(0, 5 - $photoCount);
                            @endphp

                            @if($photoCount > 0)
                                <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                    @foreach($existingPhotos as $photo)
                                        <label class="relative block overflow-hidden rounded-md border border-gray-300 dark:border-zinc-600">
                                            <img src="{{ $photo }}" alt="Foto tersimpan {{ $loop->iteration }}"
                                                 class="h-32 w-full object-cover">
                                            <span class="absolute inset-x-0 bottom-0 flex items-center gap-2 bg-black/60 px-2 py-1 text-xs text-white">
                                                <input type="checkbox" name="remove_fotos[]" value="{{ $photo }}"
                                                       class="foto-remove rounded border-gray-300 text-red-600 focus:ring-red-500">
                                                Hapus foto
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-3 rounded-lg border border-dashed border-gray-400 dark:border-zinc-600 bg-white dark:bg-zinc-800 p-4">
                                <input type="file" name="foto_file[]" id="foto_file" accept="image/jpeg,image/png,image/webp" multiple
                                       data-max-total="5" data-existing-count="{{ $photoCount }}"
                                       class="block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:rounded-md file:border-0 file:bg-green-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-green-700">
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">
                                    Maksimal 5 foto
                                    <span id="foto-slot-info" class="font-medium"></span>
                                </p>
                                <p id="foto-status" class="mt-2 hidden text-sm"></p>
                                <div id="foto-new-preview" class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3"></div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Teks<span class="text-red-500">*</span></label></label>
                            <textarea name="teks" required class="w-full h-40 dark:bg-zinc-800 px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('teks', $informasi->teks) }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Dokumentasi</label>
                            <p class="text-sm mb-1 text-gray-600 dark:text-gray-400">Tempelkan (<i>paste</i>) tautan folder dokumentasi lengkap jika ada</p>
                            <input type="string" name="foto" value="{{ old('foto', $informasi->foto) }}"
                                   class="w-full dark:bg-zinc-800 px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                    <!-- Informasi Lainnya -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">Tanggal</label>
                                <input type="date" name="created_at" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                       class="w-full dark:bg-zinc-800 px-3 py-2 border border-gray-400 bg-white hover:shadow-md transition motion-reduce:transition-none rounded-md">
                                </div>
                        </div>
                    </div>
        </div>
            <!-- Hidden Field -->
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t">
                    <a href="{{ route('informasi.index') }}" 
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
    (() => {
        const input = document.getElementById('foto_file');
        if (!input) {
            return;
        }

        const form = input.closest('form');
        const submitButton = form ? form.querySelector('button[type="submit"]') : null;
        const status = document.getElementById('foto-status');
        const previewGrid = document.getElementById('foto-new-preview');
        const slotInfo = document.getElementById('foto-slot-info');
        const removeCheckboxes = Array.from(document.querySelectorAll('.foto-remove'));
        const maxBytes = 500 * 1024;
        const maxTotal = Number(input.dataset.maxTotal || 5);
        let isCompressing = false;
        let previewUrls = [];

        const formatSize = (bytes) => {
            if (bytes >= 1024 * 1024) {
                return `${(bytes / (1024 * 1024)).toFixed(2)} MB`;
            }

            return `${(bytes / 1024).toFixed(0)} KB`;
        };

        const setStatus = (message, tone = 'info') => {
            const tones = {
                info: 'text-gray-600 dark:text-gray-300',
                success: 'text-green-600 dark:text-green-400',
                error: 'text-red-600 dark:text-red-400',
                warning: 'text-amber-600 dark:text-amber-400',
            };

            status.textContent = message;
            status.className = `mt-2 text-sm ${tones[tone] ?? tones.info}`;
        };

        const clearPreviewGrid = () => {
            previewUrls.forEach((url) => URL.revokeObjectURL(url));
            previewUrls = [];
            previewGrid.innerHTML = '';
        };

        const addPreview = (file) => {
            const objectUrl = URL.createObjectURL(file);
            previewUrls.push(objectUrl);

            const wrapper = document.createElement('div');
            wrapper.className = 'relative overflow-hidden rounded-md border border-gray-300 dark:border-zinc-600';

            const image = document.createElement('img');
            image.src = objectUrl;
            image.alt = file.name;
            image.className = 'h-32 w-full object-cover';

            const label = document.createElement('span');
            label.className = 'absolute inset-x-0 bottom-0 bg-black/60 px-2 py-1 text-xs text-white';
            label.textContent = formatSize(file.size);

            wrapper.append(image, label);
            previewGrid.append(wrapper);
        };

        const remainingSlots = () => {
            const existingCount = Number(input.dataset.existingCount || 0);
            const removedCount = removeCheckboxes.filter((checkbox) => checkbox.checked).length;

            return Math.max(0, maxTotal - Math.max(0, existingCount - removedCount));
        };

        const updateSlots = () => {
            const remaining = remainingSlots();

            if (slotInfo) {
                slotInfo.textContent = ``;
            }

            return remaining;
        };

        const loadImage = async (file) => {
            if ('createImageBitmap' in window) {
                try {
                    return await createImageBitmap(file, { imageOrientation: 'from-image' });
                } catch {
                }
            }

            return new Promise((resolve, reject) => {
                const objectUrl = URL.createObjectURL(file);
                const image = new Image();

                image.onload = () => {
                    URL.revokeObjectURL(objectUrl);
                    resolve(image);
                };

                image.onerror = () => {
                    URL.revokeObjectURL(objectUrl);
                    reject(new Error('Gambar tidak dapat dibaca. Gunakan format JPEG, PNG, atau WebP.'));
                };

                image.src = objectUrl;
            });
        };

        const canvasToBlob = (canvas, quality) => new Promise((resolve) => {
            canvas.toBlob(resolve, 'image/jpeg', quality);
        });

        const compressImage = async (file) => {
            if (file.size <= maxBytes) {
                return { file, compressed: false };
            }

            const source = await loadImage(file);
            let width = source.width || source.naturalWidth;
            let height = source.height || source.naturalHeight;
            const maxEdge = 2000;

            if (Math.max(width, height) > maxEdge) {
                const ratio = maxEdge / Math.max(width, height);
                width = Math.round(width * ratio);
                height = Math.round(height * ratio);
            }

            const qualities = [0.85, 0.75, 0.65, 0.55, 0.45];
            let scale = 1;
            let blob = null;

            while (true) {
                const canvas = document.createElement('canvas');
                canvas.width = Math.max(1, Math.round(width * scale));
                canvas.height = Math.max(1, Math.round(height * scale));

                const context = canvas.getContext('2d');
                context.fillStyle = '#ffffff';
                context.fillRect(0, 0, canvas.width, canvas.height);
                context.drawImage(source, 0, 0, canvas.width, canvas.height);

                for (const quality of qualities) {
                    blob = await canvasToBlob(canvas, quality);

                    if (blob && blob.size <= maxBytes) {
                        break;
                    }
                }

                if (blob && blob.size <= maxBytes) {
                    break;
                }

                if (Math.max(canvas.width, canvas.height) <= 640) {
                    break;
                }

                scale *= 0.8;
            }

            if (typeof source.close === 'function') {
                source.close();
            }

            if (!blob) {
                throw new Error('Gambar gagal dikompres.');
            }

            if (blob.size > maxBytes) {
                throw new Error('Gambar tidak dapat dikompres hingga di bawah 500 KB. Coba gunakan foto dengan ukuran lebih kecil.');
            }

            const name = `${file.name.replace(/\.[^.]+$/, '') || 'foto'}.jpg`;

            return {
                file: new File([blob], name, { type: 'image/jpeg', lastModified: Date.now() }),
                compressed: true,
            };
        };

        const resetInput = () => {
            input.value = '';
            clearPreviewGrid();
        };

        input.addEventListener('change', async () => {
            const files = Array.from(input.files || []);

            if (files.length === 0) {
                clearPreviewGrid();
                status.classList.add('hidden');
                return;
            }

            const remaining = updateSlots();

            if (files.length > remaining) {
                resetInput();
                setStatus(`Maksimal ${maxTotal} foto. Sisa slot saat ini: ${remaining}.`, 'error');
                return;
            }

            const invalidFile = files.find((file) => !file.type.startsWith('image/'));

            if (invalidFile) {
                resetInput();
                setStatus('Semua file harus berupa gambar JPEG, PNG, atau WebP.', 'error');
                return;
            }

            isCompressing = true;
            if (submitButton) {
                submitButton.disabled = true;
            }
            clearPreviewGrid();
            setStatus(`Mengompres 0 dari ${files.length} foto...`);

            try {
                const compressedFiles = [];
                let totalOriginal = 0;
                let totalCompressed = 0;

                for (let index = 0; index < files.length; index++) {
                    setStatus(`Mengompres ${index + 1} dari ${files.length} foto...`);

                    const result = await compressImage(files[index]);
                    compressedFiles.push(result.file);
                    totalOriginal += files[index].size;
                    totalCompressed += result.file.size;
                    addPreview(result.file);
                }

                const dataTransfer = new DataTransfer();
                compressedFiles.forEach((file) => dataTransfer.items.add(file));
                input.files = dataTransfer.files;

                setStatus(`${files.length} foto siap diunggah (${formatSize(totalOriginal)} → ${formatSize(totalCompressed)}).`, 'success');
            } catch (error) {
                resetInput();
                setStatus(error.message, 'error');
            } finally {
                isCompressing = false;
                if (submitButton) {
                    submitButton.disabled = false;
                }
                updateSlots();
            }
        });

        removeCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                const remaining = updateSlots();
                const selectedCount = input.files ? input.files.length : 0;

                if (selectedCount > remaining) {
                    resetInput();
                    setStatus(`Maksimal ${maxTotal} foto. Sisa slot saat ini: ${remaining}.`, 'error');
                }
            });
        });

        updateSlots();

        if (form) {
            form.addEventListener('submit', (event) => {
                if (isCompressing) {
                    event.preventDefault();
                    setStatus('Tunggu proses kompresi selesai sebelum menyimpan.', 'warning');
                }
            });
        }
    })();
</script>

</x-app-layout>

<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Informasi::with(['users']);

        $selectedCategoryId = null;

        $informasis = $query->paginate(10)->appends($request->query());

        return view('informasi.index', compact('informasis'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'kategori' => 'nullable|string|in:Informasi Publik,Informasi Internal,Informasi Lainnya',
            'foto' => 'nullable|string',
            'foto_file' => 'nullable|array|max:5',
            'foto_file.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'teks' => 'nullable|string',
            'created_at' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $photos = [];
        $uploadedFiles = $request->file('foto_file', []);
        $uploadedFiles = is_array($uploadedFiles) ? $uploadedFiles : [$uploadedFiles];

        if (array_key_exists('foto', $validated) && $this->normalizeLocalPhoto($validated['foto']) !== null) {
            $validated['foto'] = null;
        }

        foreach ($uploadedFiles as $uploadedFile) {
            $path = $uploadedFile->store('informasi', 'public');
            $publicUrl = Storage::disk('public')->url($path);
            $photos[] = parse_url($publicUrl, PHP_URL_PATH) ?: '/storage/'.$path;
        }

        $validated['fotos'] = array_values(array_unique($photos));

        Informasi::create($validated);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil disimpan');

    }

    private function normalizeLocalPhoto(?string $photo): ?string
    {
        if (! $photo) {
            return null;
        }

        $path = parse_url($photo, PHP_URL_PATH);
        $marker = '/storage/informasi/';
        $position = is_string($path) ? strpos($path, $marker) : false;

        if ($position === false) {
            return null;
        }

        return $marker.substr($path, $position + strlen($marker));
    }

    private function deleteLocalPhoto(?string $photo): void
    {
        $normalizedPhoto = $this->normalizeLocalPhoto($photo);

        if ($normalizedPhoto === null) {
            return;
        }

        Storage::disk('public')->delete(str_replace('/storage/', '', $normalizedPhoto));
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        $informasi->load(['users']);

        return view('informasi.show', compact('informasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        return view('informasi.edit', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'kategori' => 'nullable|string|in:Informasi Publik,Informasi Internal,Informasi Lainnya',
            'foto_file' => 'nullable|array|max:5',
            'foto_file.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_fotos' => 'nullable|array',
            'remove_fotos.*' => 'string',
            'teks' => 'nullable|string',
            'foto' => 'nullable|string',
            'created_at' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $photos = $this->currentPhotos($informasi);
        $removedPhotos = $request->input('remove_fotos', []);
        $removedPhotos = is_array($removedPhotos) ? $removedPhotos : [];
        $photosToDelete = [];

        foreach ($removedPhotos as $removedPhoto) {
            $normalizedPhoto = $this->normalizeLocalPhoto($removedPhoto);

            if ($normalizedPhoto !== null && in_array($normalizedPhoto, $photos, true)) {
                $photos = array_values(array_diff($photos, [$normalizedPhoto]));
                $photosToDelete[] = $normalizedPhoto;
            }
        }

        $uploadedFiles = $request->file('foto_file', []);
        $uploadedFiles = is_array($uploadedFiles) ? $uploadedFiles : [$uploadedFiles];
        $remainingSlots = max(0, 5 - count($photos));

        if (count($uploadedFiles) > $remainingSlots) {
            throw ValidationException::withMessages([
                'foto_file' => 'Maksimal 5 foto. Hapus foto lama terlebih dahulu untuk menambah foto baru.',
            ]);
        }

        if (array_key_exists('foto', $validated) && $this->normalizeLocalPhoto($validated['foto']) !== null) {
            $validated['foto'] = null;
        }

        foreach ($uploadedFiles as $uploadedFile) {
            $path = $uploadedFile->store('informasi', 'public');
            $publicUrl = Storage::disk('public')->url($path);
            $photos[] = parse_url($publicUrl, PHP_URL_PATH) ?: '/storage/'.$path;
        }

        $validated['fotos'] = array_values(array_unique($photos));

        $informasi->update($validated);

        foreach ($photosToDelete as $deletedPhoto) {
            $this->deleteLocalPhoto($deletedPhoto);
        }

        $page = session('informasi_page', 1);

        return redirect()->route('informasi.index', ['page' => $page])->with('success', 'Informasi berhasil diperbarui');

    }

    private function currentPhotos(Informasi $informasi): array
    {
        $photos = [];

        foreach (($informasi->fotos ?? []) as $photo) {
            $normalizedPhoto = $this->normalizeLocalPhoto($photo);

            if ($normalizedPhoto !== null) {
                $photos[] = $normalizedPhoto;
            }
        }

        $legacyPhoto = $this->normalizeLocalPhoto($informasi->foto);

        if ($legacyPhoto !== null) {
            $photos[] = $legacyPhoto;
        }

        return array_values(array_unique($photos));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        foreach ($this->currentPhotos($informasi) as $photo) {
            $this->deleteLocalPhoto($photo);
        }

        $informasi->delete();

        $page = session('informasi_page', 1);

        return redirect()->route('informasi.index', ['page' => $page])->with('success', 'Informasi berhasil dihapus');

    }
}

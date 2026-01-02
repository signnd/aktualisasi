<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

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
        $informasi = Informasi::all();

        return view('informasi.create', compact('informasi'));

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
            'teks' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Informasi::create($validated);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil disimpan');

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
            'foto' => 'nullable|string',
            'teks' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $informasi->update($validated);

        $page = session('informasi_page', 1);

        return redirect()->route('informasi.index', ['page' => $page])->with('success', 'Informasi berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();

        $page = session('informasi_page', 1);

        return redirect()->route('informasi.index', ['page' => $page])->with('success', 'Informasi berhasil dihapus');

    }
}

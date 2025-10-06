<?php

namespace App\Http\Controllers;

use App\Models\Riab;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\RiabDetail;
use Illuminate\Http\Request;

class RiabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riabs = Riab::with(['user','kabupaten','kecamatan'])->paginate(10);
        return view('riab.index', compact('riabs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('riab.create', compact('kabupaten', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_registrasi' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'kabupaten_id' => 'exists:kabupaten,id',
            'kecamatan_id' => 'exists:kecamatan,id',
            'kelurahan' => 'string|max:255',
            'kategori_3t' => 'enum|max:500',
            'ketua' => 'string|max:255',
            'thn_berdiri' => 'year',
            'alamat' => 'string|max:1500',
            'tgl_tanda_daftar' => 'date',
            'jenis_riab' => 'string|max:255',
            'status' => 'string|max:255',
            'kondisi' => 'string|max:255',
            'email' => 'email|max:255',
            'no_telp' => 'string|max:20',
            'media_sosial' => 'string|max:255',
            'latitude' => 'string|max:50',
            'longitude' => 'string|max:50',
            'link_foto' => 'string|max:500',
            'deskripsi' => 'string|max:2000',
            'jumlah_umat' => 'integer',
            'eksisting' => 'string|max:500',
            'tgl_update' => 'date',
            'status_verifikasi' => 'string|max:100',
            'user_id' => 'required|exists:users,id',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        Riab::create($validated);

        return redirect()->route('riab.index')->with('success', 'Data RIAB berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Riab $riab)
    {
        $riab->load(['user','kabupaten','kecamatan']);
        return view('riab.show', compact('riab'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riab $riab)
    {
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('riab.edit', compact('riab', 'kabupaten', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riab $riab)
    {
        $validated = $request->validate([
            'no_registrasi' => 'string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
                        'kelurahan' => 'string|max:255',
            'kategori_3t' => 'enum|max:500',
            'ketua' => 'string|max:255',
            'thn_berdiri' => 'year',
            'alamat' => 'string|max:1500',
            'tgl_tanda_daftar' => 'date',
            'jenis_riab' => 'string|max:255',
            'status' => 'string|max:255',
            'kondisi' => 'string|max:255',
            'email' => 'email|max:255',
            'no_telp' => 'string|max:20',
            'media_sosial' => 'string|max:255',
            'latitude' => 'string|max:50',
            'longitude' => 'string|max:50',
            'link_foto' => 'string|max:500',
            'deskripsi' => 'string|max:2000',
            'jumlah_umat' => 'integer',
            'eksisting' => 'string|max:500',
            'tgl_update' => 'date',
            'status_verifikasi' => 'string|max:100',
            'user_id' => 'required|exists:users,id', 
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $riab->update($validated);

        return redirect()->route('riab.index')->with('success', 'Data RIAB berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riab $riab)
    {
        $riab->delete();
        return redirect()->route('riab.index')->with('success', 'Data RIAB berhasil dihapus.');
    }
}

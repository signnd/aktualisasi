<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kecamatan = Kecamatan::with('kabupaten')->paginate(20);
        $kabupaten = Kabupaten::all();
        return view('kecamatan.index', compact('kecamatan', 'kabupaten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupaten = Kabupaten::all();
        return view('kecamatan.create', compact('kabupaten'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupaten,id'
        ]);

        Kecamatan::create($request->only(['kecamatan','kabupaten_id']));

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecamatan $kecamatan)
    {
        $kabupaten = Kabupaten::all();
        return view('kecamatan.edit', compact('kecamatan','kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'kecamatan' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupaten,id'
        ]);

        $kecamatan->update($request->only(['kecamatan','kabupaten_id']));

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil dihapus.');
    }
}

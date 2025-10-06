<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kabupaten = Kabupaten::paginate(20);
        return view('kabupaten.index', compact('kabupaten'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kabupaten.create', compact('kabupaten'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kabupaten' => 'required|string|max:255',
            'kode_kab' => 'string|max:10'
        ]);

        Kabupaten::create($request->only(['kabupaten', 'kode_kab']));

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kabupaten $kabupaten)
    {
        return view('kabupaten.edit', compact('kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $request->validate([
            'kabupaten' => 'required|string|max:255',
            'kode_kab' => 'string|max:10'
        ]);

        $kabupaten->update($request->only(['kabupaten', 'kode_kab']));

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();
        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Majelis;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MajelisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majelis = Majelis::paginate(30);
        return view('majelis.index', compact('majelis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majelis = Majelis::all();
        return view('majelis.create', compact('majelis'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_majelis' => 'required|string|max:255',
            'sekte' => 'nullable|string', 
            'binaan' => 'nullable|string|max:1000',
            'ketua' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:2000',
            'tgl_terdaftar' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Majelis::create($validated);

        return redirect()->route('majelis.index')->with('success','Data Majelis berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Majelis $majelis)
    {
        $majelis->load(['user']);
        return view('majelis.show',compact('majelis'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Majelis $majelis)
    {
        return view('majelis.edit', compact('majelis'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Majelis $majelis)
    {
        $validated = $request->validate([
            'nama_majelis' => 'required|string|max:255',
            //'kabupaten_id' => 'required|exists:kabupaten,id',
            'sekte' => 'nullable|string', 
            'binaan' => 'nullable|string|max:1000',
            'ketua' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:2000',
            'tgl_terdaftar' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Majelis::update($validated);

        return redirect()->route('majelis.index')->with('success','Data Majelis berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Majelis $majelis)
    {
        $majelis->delete();
        return redirect()->route('majelis.index')->with('success', 'Data Majelis berhasil dihapus');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\YayasanBuddha;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;

class YayasanBuddhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yayasans = YayasanBuddha::with(['user', 'kabupaten', 'kecamatan'])->paginate(10);
        return view('yayasan.index', compact('yayasans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $yayasan = YayasanBuddha::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('yayasan.create', compact('kabupaten','kecamatan','yayasan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'exists:kabupaten,id',
            'kecamatan_id' => 'exists:kecamatan,id',
            'nama_yayasan' => 'required|string|max:255',
            'ketua' => 'nullable|string', 
            'alamat' => 'nullable|string|max:1000',
            'tgl_terdaftar' => 'nullable|date',
            'keterangan' => 'nullable|string|max:2000',
            'user_id' => 'required|exists:users,id',
        ]);

        YayasanBuddha::create($validated);

        return redirect()->route('yayasan.index')->with('success','Data Yayasan Agama Buddha berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(YayasanBuddha $yayasan)
    {
        $yayasan->load(['user']);
        return view('yayasan.show',compact('yayasan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(YayasanBuddha $yayasan)
    {
        //$yayasan = YayasanBuddha::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('yayasan.edit', compact('yayasan','kabupaten','kecamatan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, YayasanBuddha $yayasan)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'exists:kabupaten,id',
            'kecamatan_id' => 'exists:kecamatan,id',
            'nama_yayasan' => 'required|string|max:255',
            'ketua' => 'nullable|string', 
            'alamat' => 'nullable|string|max:1000',
            'tgl_terdaftar' => 'nullable|date',
            'keterangan' => 'nullable|string|max:2000',
            'user_id' => 'required|exists:users,id',
        ]);

        $yayasan->update($validated);

        return redirect()->route('yayasan.index')->with('success','Data Yayasan Agama Buddha berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YayasanBuddha $yayasan)
    {
        $yayasan->delete();
        return redirect()->route('yayasan.index')->with('success', 'Data Yayasan berhasil dihapus');
    }
}

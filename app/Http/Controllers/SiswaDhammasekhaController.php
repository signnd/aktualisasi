<?php

namespace App\Http\Controllers;

use App\Models\Dhammasekha;
use App\Models\SiswaDhammasekha;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaDhammasekhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Dhammasekha $dhammasekha)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'dhammasekha_id' => 'required|exists:dhammasekha,id',
            'nama_siswa' => 'required|string|max:400',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:100',
            'nik' => 'nullable|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'nisn' => 'nullable|string|max:50',
            'tahun_ajaran' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:400',
            'nama_ibu' => 'nullable|string|max:100',
            'nama_ayah' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'pendidikan' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:100',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id', 
        ]);


        $dataToCreate = array_merge($validated, [
        // Ambil kabupaten_id dari relasi Smb jika siswa tidak mengisinya (opsional)
            'kabupaten_id' => $dhammasekha->kabupaten_id, 
            //'user_id' => auth()->id(), // Asumsi Anda menggunakan Auth::id()
        ]);

        // Cukup satu kali penyimpanan menggunakan relasi
        $dhammasekha->siswadhammasekha()->create($dataToCreate);        

        return redirect()->route('dhammasekha.show', $dhammasekha->id)
                         ->with('success', 'Siswa berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(SiswaDhammasekha $siswaDhammasekha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dhammasekha $dhammasekha, SiswaDhammasekha $siswaDhammasekha)
    {
        $kabupaten = Kabupaten::all();
        return view('dhammasekha.siswa.edit', compact('dhammasekha', 'siswa', 'kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dhammasekha $dhammasekha, $siswaDhammasekha)
    {
        $siswaDhammasekha = SiswaDhammasekha::findOrFail($siswaDhammasekha);

        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $siswaDhammasekha->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'dhammasekha_id' => 'required|exists:dhammasekha,id',
            'nama_siswa' => 'required|string|max:400',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:100',
            'nik' => 'nullable|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'nisn' => 'nullable|string|max:50',
            'tahun_ajaran' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:400',
            'nama_ibu' => 'nullable|string|max:100',
            'nama_ayah' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'pendidikan' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:100',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id', 
        ]);

        //$dataToCreate = array_merge($validated, [
        //// Ambil kabupaten_id dari relasi Smb jika siswa tidak mengisinya (opsional)
        //    'kabupaten_id' => $smb->kabupaten_id, 
        //    'user_id' => auth()->id(), // Asumsi Anda menggunakan Auth::id()
        //]);
        
        $siswaDhammasekha->update($validated);

        return redirect()->route('dhammasekha.show', $dhammasekha->id)
                         ->with('success', 'Data siswa berhasil diedit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dhammasekha $dhammasekha, SiswaDhammasekha $siswaDhammasekha)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $siswaDhammasekha->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

       try {
            $siswaDhammasekha->delete(); 

            return redirect()->route('dhammasekha.show', $dhammasekha->id)
                             ->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('dhammasekha.show', $dhammasekha->id)
                             ->with('error', 'Gagal menghapus data siswa: ' . $siswaDhammasekha->getMessage());
        }

    }
}

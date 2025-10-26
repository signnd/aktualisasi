<?php

namespace App\Http\Controllers;

use App\Models\Smb;
use App\Models\SiswaSmb;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaSmbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Smb $smb)
    {
        //$siswa = $smb->siswasmb()->with('kabupaten')->paginate(20);
        //$kabupaten = Kabupaten::all();
//
        //return view('smb.siswa.index', compact('smb', 'siswa', 'kabupaten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    //public function create()
    //{
    //    //
    //}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Smb $smb) {
    
        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'smb_id' => 'required|exists:smb,id',
            'nama_siswa' => 'required|string|max:400',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nik' => 'nullable|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:400',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:100',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id', 
        ]);


        $dataToCreate = array_merge($validated, [
        // Ambil kabupaten_id dari relasi Smb jika siswa tidak mengisinya (opsional)
            'kabupaten_id' => $smb->kabupaten_id, 
            //'user_id' => auth()->id(), // Asumsi Anda menggunakan Auth::id()
        ]);
//
        // Cukup satu kali penyimpanan menggunakan relasi
        $smb->siswasmb()->create($dataToCreate);        

        return redirect()->route('smb.show', $smb->id)
                         ->with('success', 'Siswa berhasil ditambahkan');
    }
    

    /**
     * Display the specified resource.
     */
    //public function show(SiswaSmb $siswaSmb)
    //{
    //    //
    //}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Smb $smb, SiswaSmb $siswaSmb)
    {
        $kabupaten = Kabupaten::all();
        return view('smb.siswa.edit', compact('smb', 'siswa', 'kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Smb $smb, $siswaSmb)
    {
        $siswaSmb = SiswaSmb::findOrFail($siswaSmb);

        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $siswaSmb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'smb_id' => 'required|exists:smb,id',
            'nama_siswa' => 'required|string|max:400',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nik' => 'nullable|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:400',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
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
        
        //$smb->siswaSmb()->update($validated, $dataToCreate);
        $siswaSmb->update($validated);

        return redirect()->route('smb.show', $smb->id)
                         ->with('success', 'Data siswa berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Smb $smb, SiswaSmb $siswa)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $siswa->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

       try {
            $siswa->delete(); 

            return redirect()->route('smb.show', $smb->id)
                             ->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('smb.show', $smb->id)
                             ->with('error', 'Gagal menghapus data siswa: ' . $e->getMessage());
        }
}
}
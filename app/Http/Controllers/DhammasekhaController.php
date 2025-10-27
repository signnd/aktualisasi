<?php

namespace App\Http\Controllers;

use App\Models\Dhammasekha;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DhammasekhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dhammasekha::with(['kabupaten']);
        
        $selectedKabupatenId = null;

        // Tentukan kabupaten_id yang akan digunakan
        if ($request->has('kabupaten_id')) {
            // Jika ada parameter kabupaten_id di URL (user sudah memilih dari dropdown)
            $selectedKabupatenId = $request->input('kabupaten_id');

            // Filter hanya jika bukan "Semua Kabupaten" (value bukan empty string)
            if (!empty($selectedKabupatenId)) {
                $query->where('kabupaten_id', $selectedKabupatenId);
            }
            // Jika empty string, tidak ada filter = tampil semua
        } else {
            // Pertama kali buka halaman (belum ada parameter)
            // Set default ke kabupaten user (kecuali admin)
            if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
                $selectedKabupatenId = auth()->user()->kabupaten_id;
                $query->where('kabupaten_id', $selectedKabupatenId);
            }
        }

        $dhammasekhas = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::all();
    
        return view('dhammasekha.index', compact('dhammasekhas', 'kabupatens', 'selectedKabupatenId'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupaten = Kabupaten::all();
        return view('dhammasekha.create', compact('kabupaten'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'jenis' => 'string|in:Dhammasekha Non Formal,Nava Dhammasekha,Mula Dhammasekha,Uttama Dhammasekha',
            'nama' => 'required|string|max:400',
            'alamat' => 'nullable|string|max:800',
            'tgl_berdiri' => 'nullable|date',
            'no_izop' => 'nullable|string|max:100',            
            'izop_ppjg' => 'nullable|string|max:100',            
            'tgl_izop' => 'nullable|date',            
            'masa_izop' => 'nullable|date',            
            'no_statistik' => 'nullable|string|max:100',            
            'nama_yayasan' => 'nullable|string|max:100',            
            'alamat_yayasan' => 'nullable|string|max:1000',            
            'npyp' => 'nullable|string|max:100',            
            'npsn' => 'nullable|string|max:100',            
            'akreditasi' => 'nullable|string|max:10',            
            'nama_pic' => 'nullable|string|max:100',            
            'no_hp' => 'nullable|string|max:100',            
            'email' => 'nullable|string|max:100',            
            'naungan_kemenag' => 'nullable|in:Ya,Tidak',            
            'naungan_disdik' => 'nullable|in:Ya,Tidak',            
            'tk_disdik_kb_kemenag' => 'nullable|in:Ya,Tidak',            
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',       
            'link_nonaktif' => 'nullable|string|max:100',            
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',            
            'foto' => 'nullable|string|max:300',            
            'keterangan' => 'nullable|string|max:2000',            
            'tgl_update' => 'nullable|date',            
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',            
            'user_id' => 'required|exists:users,id',          
        ]);

        Dhammasekha::create($validated);

        return redirect()->route('dhammasekha.index')
                         ->with('success', 'Dhammasekha berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Dhammasekha $dhammasekha)
    {
        $dhammasekha->load([
            'kabupaten:id,kabupaten',          // hanya ambil kolom yang dibutuhkan
            'siswadhammasekha' => function ($query) {
                $query->with('kabupaten:id,kabupaten')
                      ->orderBy('nama_siswa', 'asc')
                      ->paginate(20);
            }
        ]);

        $kabupatens = Kabupaten::orderBy('kabupaten')->get();

        return view('dhammasekha.show', compact('dhammasekha','kabupatens'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dhammasekha $dhammasekha)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $dhammasekha->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        // Filter kecamatan berdasarkan kabupaten user jika bukan admin
        // if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
        //     $kecamatan = Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)->get();
        // } else {
        //     $kecamatan = Kecamatan::all();
        // }

        $kabupaten = Kabupaten::all();
        return view('dhammasekha.edit', compact('dhammasekha', 'kabupaten'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dhammasekha $dhammasekha)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $dhammasekha->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'jenis' => 'string|in:Dhammasekha Non Formal,Nava Dhammasekha, Mula Dhammasekha,Uttama Dhammasekha',
            'nama' => 'required|string|max:400',
            'alamat' => 'nullable|string|max:800',
            'tgl_berdiri' => 'nullable|date',
            'no_izop' => 'nullable|string|max:100',            
            'izop_ppjg' => 'nullable|string|max:100',            
            'tgl_izop' => 'nullable|date',            
            'masa_izop' => 'nullable|date',            
            'no_statistik' => 'nullable|string|max:100',            
            'nama_yayasan' => 'nullable|string|max:100',            
            'alamat_yayasan' => 'nullable|string|max:1000',            
            'npyp' => 'nullable|string|max:100',            
            'npsn' => 'nullable|string|max:100',            
            'akreditasi' => 'nullable|string|max:10',            
            'nama_pic' => 'nullable|string|max:100',            
            'no_hp' => 'nullable|string|max:100',            
            'email' => 'nullable|string|max:100',            
            'naungan_kemenag' => 'nullable|in:Ya,Tidak',            
            'naungan_disdik' => 'nullable|in:Ya,Tidak',            
            'tk_disdik_kb_kemenag' => 'nullable|in:Ya,Tidak',            
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',       
            'link_nonaktif' => 'nullable|string|max:100',            
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',            
            'foto' => 'nullable|string|max:300',            
            'keterangan' => 'nullable|string|max:2000',            
            'tgl_update' => 'nullable|date',            
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',            
            'user_id' => 'required|exists:users,id',          
        ]);

        $dhammasekha->update($validated);

        return redirect()->route('dhammasekha.index')
                         ->with('success', 'Dhammasekha berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dhammasekha $dhammasekha)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $dhammasekha->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data kabupaten ini.');
        }

        $dhammasekha->delete();

        return redirect()->route('dhammasekha.index')
                         ->with('success', 'Data Dhammasekha berhasil dihapus.');

    }
}

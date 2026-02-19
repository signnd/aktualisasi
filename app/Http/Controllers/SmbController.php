<?php

namespace App\Http\Controllers;

use App\Models\Smb;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Smb::with(['kabupaten','kecamatan']);
        
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

        $smbs = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
    
        return view('smb.index', compact('smbs', 'kabupatens', 'selectedKabupatenId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupaten = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        return view('smb.create', compact('kabupaten'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_smb' => 'required|string|max:400',
            'alamat' => 'nullable|string|max:800',
            'didirikan' => 'nullable|string|max:50',
            'izop_1' => 'nullable|string|max:100',            
            'ppjg_1' => 'nullable|string|max:100',            
            'ppjg_2' => 'nullable|string|max:100',            
            'nssmb' => 'nullable|string|max:100',            
            'tgl_izop' => 'nullable|date',            
            'masa_izop' => 'nullable|string|max:100',            
            'bapen' => 'nullable|string|max:100',            
            'alamat_bapen' => 'nullable|string|max:1000',            
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nama_pic' => 'nullable|string|max:100',            
            'no_telp' => 'nullable|string|max:100',            
            'status' => 'nullable|string|in:Disetujui,Ditolak,Pending',     
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',       
            'link_berita_acara_nonaktif' => 'nullable|string|max:100',            
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',            
            'link_foto' => 'nullable|string|max:100',            
            'tgl_update' => 'nullable|date',            
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',            
            'deskripsi' => 'nullable|string|max:2000',            
            'email' => 'nullable|string|max:100',            
            'media_sosial' => 'nullable|string|max:100',   
            'user_id' => 'required|exists:users,id',          
        ]);

        Smb::create($validated);

        return redirect()->route('smb.index')
                         ->with('success', 'Sekolah Minggu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Smb $smb)
    {
        //$smb->load(['kabupaten', 'siswa.kabupaten']);
        // Preload semua relasi yang dibutuhkan sekaligus
        //$smb->load([
        //    'kabupaten:id,kabupaten']);
        $smb->load('kabupaten');
                      // hanya ambil kolom yang dibutuhkan
        $siswas = $smb->siswasmb()
        ->with('kabupaten')
              ->orderBy('nama_siswa', 'asc')
              ->paginate(20);

        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        
        return view('smb.show', compact(['smb', 'kabupatens', 'siswas']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Smb $smb)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $smb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        // Filter kecamatan berdasarkan kabupaten user jika bukan admin
        if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
            $kecamatan = Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)->get();
        } else {
            $kecamatan = Kecamatan::all();
        }


        $kabupaten = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        return view('smb.edit', compact('smb', 'kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Smb $smb)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $smb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $validated = $request->validate([
            'nama_smb' => 'required|string|max:400',
            'alamat' => 'nullable|string|max:800',
            'didirikan' => 'nullable|string|max:50',
            'izop_1' => 'nullable|string|max:100',            
            'ppjg_1' => 'nullable|string|max:100',            
            'ppjg_2' => 'nullable|string|max:100',            
            'nssmb' => 'nullable|string|max:100',            
            'tgl_izop' => 'nullable|date',            
            'masa_izop' => 'nullable|string|max:100',            
            'bapen' => 'nullable|string|max:100',            
            'alamat_bapen' => 'nullable|string|max:1000',            
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nama_pic' => 'nullable|string|max:100',            
            'no_telp' => 'nullable|string|max:100',            
            'status' => 'nullable|string|in:Disetujui,Ditolak,Pending',           
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',           
            'link_berita_acara_nonaktif' => 'nullable|string|max:100',            
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',            
            'link_foto' => 'nullable|string|max:100',            
            'tgl_update' => 'nullable|date',            
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',            
            'deskripsi' => 'nullable|string|max:2000',            
            'email' => 'nullable|string|max:100',            
            'media_sosial' => 'nullable|string|max:100',   
            'user_id' => 'required|exists:users,id',          
        ]);

        $smb->update($validated);

        $page = session('smb_page', 1);

        return redirect()->route('smb.index', ['page' => $page])
                         ->with('success', 'Sekolah Minggu berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Smb $smb)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $smb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data kabupaten ini.');
        }

        $smb->delete();

        $page = session('smb_page', 1);

        return redirect()->route('smb.index', ['page' => $page])
                         ->with('success', 'Data Sekolah Minggu berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pusdiklat;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;

class PusdiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pusdiklat::with(['kabupaten']);

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

        $pusdiklats = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
    
        return view('pusdiklat.index', compact('pusdiklats', 'kabupatens', 'selectedKabupatenId'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        return view('pusdiklat.create', compact('kabupaten'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nama' => 'required|string|max:400',
            'alamat' => 'nullable|string|max:800',
            'berdiri' => 'nullable|string|max:50',
            'izop_1' => 'nullable|string|max:100',
            'ppjg_1' => 'nullable|string|max:100',
            'ppjg_2' => 'nullable|string|max:100',
            'no_statistik' => 'nullable|string|max:100',
            'th_izop' => 'nullable|integer|min:1900|max:' . date('Y'),
            'tgl_izop' => 'nullable|date',
            'masa_izop' => 'nullable|string|max:100',
            'bapen' => 'nullable|string|max:100',
            'alamat_bapen' => 'nullable|string|max:800',
            'nama_pic' => 'nullable|string|max:400',
            'no_hp' => 'nullable|string|max:100',
            'jml_siswa' => 'nullable|string|max:100',
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',
            'link_nonaktif' => 'nullable|string|max:100',
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'foto' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:800',
            'tgl_update' => 'nullable|date',
            'status_verifikasi', 'nullable|string|in:TRUE,FALSE',
            'user_id'=> 'required|exists:users,id',
        ]);

        Pusdiklat::create($validated);

        return redirect()->route('pusdiklat.index')
                         ->with('success', 'Pusdiklat berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pusdiklat $pusdiklat)
    {
        $pusdiklat->load([
            'kabupaten:id,kabupaten',          // hanya ambil kolom yang dibutuhkan
            // 'siswasmb' => function ($query) {
            //     $query->with('kabupaten:id,kabupaten')
            //           ->orderBy('nama_siswa', 'asc')
            //           ->paginate(20);
            // }
        ]);

        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        
        return view('pusdiklat.show', compact(['pusdiklat', 'kabupatens']));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pusdiklat $pusdiklat)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $smb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        // Filter kecamatan berdasarkan kabupaten user jika bukan admin
        // if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
        //     $kecamatan = Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)->get();
        // } else {
        //     $kecamatan = Kecamatan::all();
        // }


        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        return view('pusdiklat.edit', compact('pusdiklat', 'kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pusdiklat $pusdiklat)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $smb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

                $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nama' => 'required|string|max:400',
            'alamat' => 'nullable|string|max:800',
            'berdiri' => 'nullable|string|max:50',
            'izop_1' => 'nullable|string|max:100',
            'ppjg_1' => 'nullable|string|max:100',
            'ppjg_2' => 'nullable|string|max:100',
            'no_statistik' => 'nullable|string|max:100',
            'th_izop' => 'nullable|integer|min:1900|max:' . date('Y'),
            'tgl_izop' => 'nullable|date',
            'masa_izop' => 'nullable|string|max:100',
            'bapen' => 'nullable|string|max:100',
            'alamat_bapen' => 'nullable|string|max:800',
            'nama_pic' => 'nullable|string|max:400',
            'no_hp' => 'nullable|string|max:100',
            'jml_siswa' => 'nullable|string|max:100',
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',
            'link_nonaktif' => 'nullable|string|max:100',
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'foto' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:800',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id'=> 'required|exists:users,id',
        ]);

        $pusdiklat->update($validated);

        //$page = session('pusdiklat_page',1);

        return redirect()->route('pusdiklat.index')
                 ->with('success', 'Pusdiklat berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pusdiklat $pusdiklat)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $smb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data kabupaten ini.');
        }

        $pusdiklat->delete();

        //$page = session('smb_page', 1);

        return redirect()->route('pusdiklat.index')
                         ->with('success', 'Data Pusdiklat berhasil dihapus.');

    }
}

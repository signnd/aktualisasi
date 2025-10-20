<?php

namespace App\Http\Controllers;

use App\Models\Okb;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OkbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Okb::with(['kabupaten', 'kecamatan']);

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

        $okbs = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::all();
        
        return view('okb.index', compact('okbs', 'kabupatens', 'selectedKabupatenId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Okb $okb)
    {
        // Filter kecamatan berdasarkan kabupaten user jika bukan admin
        if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
            $kecamatan = Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)->get();
        } else {
            $kecamatan = Kecamatan::all();
        }

        $okb = Okb::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('okb.create', compact('kabupaten', 'kecamatan', 'okb'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kelurahan' => 'nullable|string|max:255',
            'kategori_3t' => 'nullable|in:3T,Non 3T',
            'no_registrasi' => 'nullable|string|max:255',
            'nama_okb' => 'required|string|max:255',
            'ketua' => 'nullable|string|max:255',
            'thn_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'alamat' => 'nullable|string|max:1000',
            'tgl_tanda_daftar' => 'nullable|date',
            'jenis_kelembagaan' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Disetujui,Ditolak,Pending',
            'update_sisfo' => 'nullable|string|max:255',
            'logo_okb' => 'nullable|string|max:500',
            'media_sosial' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_telp' => 'nullable|string|max:100',
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id',
        ]);

        Okb::create($validated);

        return redirect()->route('okb.index')->with('success','Data OKB berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Okb $okb)
    {
        $okb->load(['user','kabupaten','kecamatan']);
        return view('okb.show',compact('okb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Okb $okb)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $okb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        // Filter kecamatan berdasarkan kabupaten user jika bukan admin
        if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
            $kecamatan = Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)->get();
        } else {
            $kecamatan = Kecamatan::all();
        }

        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('okb.edit', compact('okb', 'kabupaten','kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Okb $okb)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $okb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kabupaten,id',
            'kelurahan' => 'nullable|string|max:255',
            'kategori_3t' => 'nullable|in:3T,Non 3T',
            'no_registrasi' => 'nullable|string|max:255',
            'nama_okb' => 'required|string|max:255',
            'ketua' => 'nullable|string|max:255',
            'thn_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'alamat' => 'nullable|string|max:500',
            'tgl_tanda_daftar' => 'nullable|date',
            'jenis_kelembagaan' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Disetujui,Ditolak,Pending',
            'update_sisfo' => 'nullable|string|max:255',
            'logo_okb' => 'nullable|string|max:500',
            'media_sosial' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_telp' => 'nullable|string|max:100',
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id',
        ]);

        $okb->update($validated);

        return redirect()->route('okb.index')->with('success','Data OKB berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Okb $okb)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $okb->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data kabupaten ini.');
        }

        $okb->delete();
        return redirect()->route('okb.index')->with('success', 'Data OKB berhasil dihapus');
    }
}

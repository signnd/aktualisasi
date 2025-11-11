<?php

namespace App\Http\Controllers;

use App\Models\YayasanBuddha;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class YayasanBuddhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = YayasanBuddha::with(['kabupaten','kecamatan']);
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

        // Simpan current page ke session
        if ($request->has('page')) {
            session(['yayasan_page' => $request->input('page')]);
        }

        $yayasans = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::all();
        
        return view('yayasan.index', compact('yayasans', 'kabupatens','selectedKabupatenId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $yayasan = YayasanBuddha::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $user = User::all();
        return view('yayasan.create', compact('kabupaten','kecamatan','yayasan','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'exists:kabupaten,id',
            'kecamatan_id' => 'nullable|exists:kecamatan,id',
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
    public function show(Request $request, YayasanBuddha $yayasan)
    {
        $yayasan->load(['users']);

        //$kabupatens = Kabupaten::orderBy('kabupaten')->get();
        $page = $request->query('page', 1);

        return view('yayasan.show',compact('yayasan', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, YayasanBuddha $yayasan)
    {
        //$yayasan = YayasanBuddha::all();
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $yayasan->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        // Filter kecamatan berdasarkan kabupaten user jika bukan admin
        if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
            $kecamatan = Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)->get();
        } else {
            $kecamatan = Kecamatan::all();
        }

        // Ambil page dari request atau session
        // $page = $request->query('page', 1);

        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('yayasan.edit', compact('yayasan','kabupaten','kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, YayasanBuddha $yayasan)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $yayasan->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

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

        // Ambil page dari request atau session
        $page = session('yayasan_page', 1);

        return redirect()->route('yayasan.index', ['page' => $page])->with('success','Data Yayasan Agama Buddha berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YayasanBuddha $yayasan)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $yayasan->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data kabupaten ini.');
        }

        // Ambil page dari request atau session
        $page = session('yayasan_page', 1);

        $yayasan->delete();
        return redirect()->route('yayasan.index', ['page' => $page])->with('success', 'Data Yayasan berhasil dihapus');
    }
}

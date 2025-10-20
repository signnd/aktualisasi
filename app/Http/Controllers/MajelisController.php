<?php

namespace App\Http\Controllers;

use App\Models\Majelis;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MajelisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Majelis::with(['kabupaten']);

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

        $majelis = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::all();
        
        return view('majelis.index', compact('majelis', 'kabupatens', 'selectedKabupatenId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majelis = Majelis::all();
        $kabupaten = Kabupaten::all();
        return view('majelis.create', compact('majelis', 'kabupaten'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_majelis' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupaten,id',
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
        $majelis->load(['user','kabupaten']);
        return view('majelis.show',compact('majelis'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Majelis $majelis)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $majelis->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $kabupaten = Kabupaten::all();
        return view('majelis.edit', compact('majelis','kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Majelis $majelis)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $majelis->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $validated = $request->validate([
            'nama_majelis' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'sekte' => 'nullable|string', 
            'binaan' => 'nullable|string|max:1000',
            'ketua' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:2000',
            'tgl_terdaftar' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $majelis->update($validated);

        return redirect()->route('majelis.index')->with('success','Data Majelis berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Majelis $majelis)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $majelis->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data kabupaten ini.');
        }

        $majelis->delete();
        return redirect()->route('majelis.index')->with('success', 'Data Majelis berhasil dihapus');

    }
}

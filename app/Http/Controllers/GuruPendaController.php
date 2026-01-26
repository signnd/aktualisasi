<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\GuruPenda;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class GuruPendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GuruPenda::with('kabupaten');
    
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

        $guruPenda = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();

        return view('guru-penda.index', compact('guruPenda', 'kabupatens', 'selectedKabupatenId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupaten = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        return view('guru-penda.create', compact('kabupaten'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nama_guru' => 'required|string|max:400',
            'nip' => 'nullable|string|max:100',            
            'nik' => 'nullable|string|max:100',            
            'nrg' => 'nullable|string|max:100',            
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:800',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'nama_sekolah_sd.*' => 'nullable|string|max:800',            
            'alamat_sekolah_sd.*' => 'nullable|string|max:2000',            
            'nama_sekolah_smp.*' => 'nullable|string|max:800',            
            'alamat_sekolah_smp.*' => 'nullable|string|max:2000',            
            'nama_sekolah_sma.*' => 'nullable|string|max:800',            
            'alamat_sekolah_sma.*' => 'nullable|string|max:2000',            
            'status_pegawai' => 'nullable|string|in:PNS,PPPK,Non ASN,Nonaktif',     
            'sertifikasi' => 'nullable|string|max:100',
            'tgl_sertifikasi' => 'nullable|date',
            'mapel_sertifikasi' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'link_sertifikasi' => 'nullable|string|max:100',
            'foto' => 'nullable|string|max:100',            
            'jml_siswa' => 'nullable|string|max:100',            
            'keterangan' => 'nullable|string|max:800',            
            'tgl_update' => 'nullable|date',            
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',            
            'deksripsi' => 'nullable|string|max:2000',            
            'email' => 'nullable|string|max:100',            
            'media_sosial' => 'nullable|string|max:100',   
            'user_id' => 'required|exists:users,id',          
        ]);

        // Konversi array ke JSON, buang yang kosong
        $namaSD = array_filter($request->nama_sekolah_sd ?? []);
        $alamatSD = array_filter($request->alamat_sekolah_sd ?? []);
        $namaSMP = array_filter($request->nama_sekolah_smp ?? []);
        $alamatSMP = array_filter($request->alamat_sekolah_smp ?? []);
        $namaSMA = array_filter($request->nama_sekolah_sma ?? []);
        $alamatSMA = array_filter($request->alamat_sekolah_sma ?? []);

        $validated['nama_sekolah_sd'] = !empty($namaSD) ? json_encode(array_values($namaSD)) : null;
        $validated['alamat_sekolah_sd'] = !empty($alamatSD) ? json_encode(array_values($alamatSD)) : null;
        $validated['nama_sekolah_smp'] = !empty($namaSMP) ? json_encode(array_values($namaSMP)) : null;
        $validated['alamat_sekolah_smp'] = !empty($alamatSMP) ? json_encode(array_values($alamatSMP)) : null;
        $validated['nama_sekolah_sma'] = !empty($namaSMA) ? json_encode(array_values($namaSMA)) : null;
        $validated['alamat_sekolah_sma'] = !empty($alamatSMA) ? json_encode(array_values($alamatSMA)) : null;

        GuruPenda::create($validated);

        return redirect()->route('guru-penda.index')
                         ->with('success', 'Guru Pendidikan Agama berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(GuruPenda $guruPenda)
    {
        $guruPenda->load(['kabupaten']);
        return view('guru-penda.show', compact('guruPenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuruPenda $guruPenda)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $guruPenda->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $kabupaten = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        return view('guru-penda.edit', compact('guruPenda','kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuruPenda $guruPenda)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $guruPenda->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $validated = $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nama_guru' => 'required|string|max:400',
            'nip' => 'nullable|string|max:100',            
            'nik' => 'nullable|string|max:100',            
            'nrg' => 'nullable|string|max:100',            
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:800',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'nama_sekolah_sd.*' => 'nullable|string|max:800',            
            'alamat_sekolah_sd.*' => 'nullable|string|max:2000',            
            'nama_sekolah_smp.*' => 'nullable|string|max:800',            
            'alamat_sekolah_smp.*' => 'nullable|string|max:2000',            
            'nama_sekolah_sma.*' => 'nullable|string|max:800',            
            'alamat_sekolah_sma.*' => 'nullable|string|max:2000',            
            'status_pegawai' => 'nullable|string|in:PNS,PPPK,Non ASN,Nonaktif',     
            'sertifikasi' => 'nullable|string|max:100',
            'tgl_sertifikasi' => 'nullable|date',
            'mapel_sertifikasi' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'link_sertifikasi' => 'nullable|string|max:100',
            'foto' => 'nullable|string|max:100',            
            'jml_siswa' => 'nullable|string|max:100',            
            'keterangan' => 'nullable|string|max:800',            
            'tgl_update' => 'nullable|date',            
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',            
            'deskripsi' => 'nullable|string|max:2000',            
            'email' => 'nullable|string|max:100',            
            'media_sosial' => 'nullable|string|max:100',   
            'user_id' => 'required|exists:users,id',          
        ]);

        // Konversi array ke JSON, buang yang kosong
        $namaSD = array_filter($request->nama_sekolah_sd ?? []);
        $alamatSD = array_filter($request->alamat_sekolah_sd ?? []);
        $namaSMP = array_filter($request->nama_sekolah_smp ?? []);
        $alamatSMP = array_filter($request->alamat_sekolah_smp ?? []);
        $namaSMA = array_filter($request->nama_sekolah_sma ?? []);
        $alamatSMA = array_filter($request->alamat_sekolah_sma ?? []);

        $validated['nama_sekolah_sd'] = !empty($namaSD) ? json_encode(array_values($namaSD)) : null;
        $validated['alamat_sekolah_sd'] = !empty($alamatSD) ? json_encode(array_values($alamatSD)) : null;
        $validated['nama_sekolah_smp'] = !empty($namaSMP) ? json_encode(array_values($namaSMP)) : null;
        $validated['alamat_sekolah_smp'] = !empty($alamatSMP) ? json_encode(array_values($alamatSMP)) : null;
        $validated['nama_sekolah_sma'] = !empty($namaSMA) ? json_encode(array_values($namaSMA)) : null;
        $validated['alamat_sekolah_sma'] = !empty($alamatSMA) ? json_encode(array_values($alamatSMA)) : null;

        $guruPenda->update($validated);

        return redirect()->route('guru-penda.index')
                         ->with('success', 'Guru Pendidikan Agama berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuruPenda $guruPenda)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $guruPenda->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $guruPenda->delete();
        return redirect()->route('guru-penda.index')->with('success', 'Guru Pendidikan Agama berhasil dihapus');
    }
}

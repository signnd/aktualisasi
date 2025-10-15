<?php

namespace App\Http\Controllers;

use App\Models\GuruPenda;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class GuruPendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guruPenda = GuruPenda::with('kabupaten')->paginate(20);
        return view('guru-penda.index', compact('guruPenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupaten = Kabupaten::all();
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
        $kabupaten = Kabupaten::all();
        return view('guru-penda.edit', compact('guruPenda','kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuruPenda $guruPenda)
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

        $guruPenda->update($validated);

        return redirect()->route('guru-penda.index')
                         ->with('success', 'Guru Pendidikan Agama berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuruPenda $guruPenda)
    {
        $guruPenda->delete();
        return redirect()->route('guru-penda.index')->with('success', 'Guru Pendidikan Agama berhasil dihapus');
    }
}

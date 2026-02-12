<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tendik;
use App\Models\Kabupaten;
use App\Models\Smb;
use App\Models\Dhammasekha;
use App\Models\Pusdiklat;
use Illuminate\Http\Request;

class TendikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tendik::with(['kabupaten', 'lembaga']);
    
        $selectedKabupatenId = null;

        // Tentukan kabupaten_id yang akan digunakan
        if ($request->has('kabupaten_id')) {
            $selectedKabupatenId = $request->input('kabupaten_id');
            if (!empty($selectedKabupatenId)) {
                $query->where('kabupaten_id', $selectedKabupatenId);
            }
        } else {
            if (auth()->user()->user_role !== 'admin' && auth()->user()->kabupaten_id) {
                $selectedKabupatenId = auth()->user()->kabupaten_id;
                $query->where('kabupaten_id', $selectedKabupatenId);
            }
        }

        if ($request->has('page')) {
            session(['tendik_page' => $request->input('page')]);
        }
        
        $tendik = $query->paginate(10)->appends($request->query());
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();

        return view('tendik.index', compact('tendik', 'kabupatens', 'selectedKabupatenId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupaten = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        $smbs = Smb::orderBy('nama_smb')->get();
        $dhammasekha = Dhammasekha::orderBy('nama')->get();
        $pusdiklat = Pusdiklat::orderBy('nama')->get();

        return view('tendik.create', compact('kabupaten', 'smbs', 'dhammasekha', 'pusdiklat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tendik' => 'required|string|max:400',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nik' => 'nullable|string|max:100',
            'nama_lembaga' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:800',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'tmt_pendidik' => 'nullable|date',
            'satker' => 'nullable|string|max:255',
            'yang_mengangkat' => 'nullable|string|max:255',
            'status_pegawai' => 'nullable|string|in:PNS,PPPK,PPPK Paruh Waktu,Non ASN,Nonaktif',
            'jabatan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'program_studi' => 'nullable|string|max:255',
            'menerima_insentif' => 'nullable|in:Ya,Tidak',
            'menerima_tpg' => 'nullable|in:Ya,Tidak',
            'link_sk' => 'nullable|string|max:255',
            'link_sertifikat' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'jml_siswa' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:800',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'deksripsi' => 'nullable|string|max:2000',
            'email' => 'nullable|string|max:100',
            'user_id' => 'required|exists:users,id',
        ]);

        $tendik = new Tendik($request->all());
        $tendik->user_id = auth()->id();
        $tendik->save();

        return redirect()->route('tendik.index')->with('success', 'Data Tendik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Tendik $tendik)
    {
        $page = $request->input('page', session('tendik_page', 1));
        return view('tendik.show', compact('tendik', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tendik $tendik)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $tendik->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $kabupaten = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        $smbs = Smb::orderBy('nama_smb')->get();
        $dhammasekha = Dhammasekha::orderBy('nama')->get();
        $pusdiklat = Pusdiklat::orderBy('nama')->get();

        $page = $request->input('page', session('tendik_page', 1));

        return view('tendik.edit', compact('tendik', 'kabupaten', 'smbs', 'dhammasekha', 'pusdiklat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tendik $tendik)
    {
        $validated = $request->validate([
            'nama_tendik' => 'required|string|max:400',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'nik' => 'nullable|string|max:100',
            'nama_lembaga' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:800',
            'no_hp' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'tmt_pendidik' => 'nullable|date',
            'satker' => 'nullable|string|max:255',
            'yang_mengangkat' => 'nullable|string|max:255',
            'status_pegawai' => 'nullable|string|in:PNS,PPPK,PPPK Paruh Waktu,Non ASN,Nonaktif',
            'jabatan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'program_studi' => 'nullable|string|max:255',
            'menerima_insentif' => 'nullable|in:Ya,Tidak',
            'menerima_tpg' => 'nullable|in:Ya,Tidak',
            'link_sk' => 'nullable|string|max:255',
            'link_sertifikat' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'jml_siswa' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:800',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id',
        ]);

        $tendik->update($request->all());

        $page = $request->input('page', session('tendik_page', 1));

        return redirect()->route('tendik.index', ['page' => $page])->with('success', 'Data Tendik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tendik $tendik)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $tendik->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $tendik->delete();
        return redirect()->route('tendik.index')->with('success', 'Tenaga Kependidikan berhasil dihapus');

    }
}

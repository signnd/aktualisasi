<?php

namespace App\Http\Controllers;

use App\Models\Riab;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\RiabDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riabs = Riab::with(['user','kabupaten','kecamatan'])->paginate(10);
        return view('riab.index', compact('riabs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Riab $riab)
    {
        $riab->load('riabdetail');
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('riab.create', compact('kabupaten', 'kecamatan', 'riab'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Informasi umum
            'no_registrasi' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:1000',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kelurahan' => 'nullable|string|max:255',
            'kategori_3t' => 'nullable|in:3T,Non 3T',
            'ketua' => 'nullable|string|max:255',
            'thn_berdiri' => 'nullable|integer|min:1000|max:' . date('Y'),
            'tgl_tanda_daftar' => 'nullable|date',
            'jenis_riab' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Disetujui,Ditolak,Pending',
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'email' => 'nullable|email|max:255',
            'no_telp' => 'nullable|string|max:100',
            'media_sosial' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'link_foto' => 'nullable|string|max:500',
            'deskripsi' => 'nullable|string|max:2000',
            'jumlah_umat' => 'nullable|integer',
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id', 

            // Informasi detail
            'update_sisfo' => 'nullable|string|max:255',
            'terdaftar_siori' => 'nullable|in:Sudah,Belum',
            'status_tanah' => 'nullable|string|max:255',
            'th_menerima_sertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_rehabilitasi' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_bersih_sehat' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_kek' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_bantuan_bangun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_bpriab_perpus' => 'nullable|integer|min:1900|max:' . date('Y'),
            'luas_tanah' => 'nullable|numeric',
            'luas_bangunan' => 'nullable|numeric',
            'kondisi_geografis' => 'nullable|array',
            'peta_rawan_bencana' => 'nullable|array',
            //'sertifikasi_tanah' => 'nullable|in:Sudah,Belum',
            //'lahan_parkir' => 'nullable|in:Ada,Tidak ada',
            'lpj_bantuan' => 'nullable|string|max:255',
            //'toilet_disable' => 'nullable|in:Ada,Tidak ada',
            //'kursi_roda' => 'nullable|in:Ada,Tidak ada',
            //'jalur_kursi_roda' => 'nullable|in:Ada,Tidak ada',
            //'fasilitas_jalur_kursi_roda' => 'nullable|in:Ada,Tidak ada',
            //'tempat_bermain' => 'nullable|in:Ada,Tidak ada',
            //'toilet_anak' => 'nullable|in:Ada,Tidak ada',
            //'wastafel_anak' => 'nullable|in:Ada,Tidak ada',
            //'ruang_ac' => 'nullable|in:Ada,Tidak ada',
            //'ruang_belajar_anak' => 'nullable|in:Ada,Tidak ada',
            //'perpustakaan' => 'nullable|in:Ada,Tidak ada',
            //'pengelola_perpustakaan' => 'nullable|string|max:255',
            //'alas_duduk' => 'nullable|in:Ada,Tidak ada',
            //'sound_system' => 'nullable|in:Ada,Tidak ada',
            //'lcd_proyektor' => 'nullable|in:Ada,Tidak ada',
            //'ruang_laktasi' => 'nullable|in:Ada,Tidak ada',
            'jumlah_pengelola_perpustakaan' => 'nullable|integer',
            'jumlah_pengelola_riab' => 'nullable|integer',
            'jumlah_kitab_suci' => 'nullable|integer',
            'jumlah_buku_keagamaan' => 'nullable|integer',
            'lpj_bantuan' => 'nullable|string|max:255',
            'listrik' => 'nullable|string|max:255',
            'foto_sebelum_bantuan' => 'nullable|string|max:1500',
            'foto_setelah_bantuan' => 'nullable|string|max:1500',
        ]);

            $detailData = [
            'update_sisfo' => $request->update_sisfo,
            'terdaftar_siori' => $request->terdaftar_siori,
            'status_tanah' => $request->status_tanah,
            'th_menerima_sertifikasi' => $request->th_menerima_sertifikasi,
            'th_menerima_rehabilitasi' => $request->th_menerima_sertifikasi,
            'th_menerima_bersih_sehat' => $request->th_menerima_sertifikasi,
            'th_menerima_kek' => $request->th_menerima_sertifikasi,
            'th_menerima_bantuan_bangun' => $request->th_menerima_sertifikasi,
            'th_menerima_bpriab_perpus' => $request->th_menerima_sertifikasi,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' =>  $request->luas_bangunan,
            'kondisi_geografis' => json_encode($request->kondisi_geografis ?? []),
            'peta_rawan_bencana' => json_encode($request->peta_rawan_bencana ?? []),
            'sertifikasi_tanah' => $request->has('sertifikasi_tanah') ? 'Sudah' : 'Belum',
            'lahan_parkir' => $request->has('lahan_parkir') ? 'Ada' : 'Tidak ada',
            'lpj_bantuan' => $request->lpj_bantuan,
            'toilet_disable' => $request->has('toilet_disable') ? 'Ada' : 'Tidak ada',
            'kursi_roda' => $request->has('kursi_roda') ? 'Ada' : 'Tidak ada',
            'jalur_kursi_roda' => $request->has('jalur_kursi_roda') ? 'Ada' : 'Tidak ada',
            'fasilitas_jalur_kursi_roda' => $request->has('fasilitas_jalur_kursi_roda') ? 'Ada' : 'Tidak ada',
            'lift' => $request->has('lift') ? 'Ada' : 'Tidak ada',
            'tempat_bermain' => $request->has('tempat_bermain') ? 'Ada' : 'Tidak ada',
            'toilet_anak' => $request->has('toilet_anak') ? 'Ada' : 'Tidak ada',
            'wastafel_anak' => $request->has('wastafel_anak') ? 'Ada' : 'Tidak ada',
            'ruang_ac' => $request->has('ruang_ac') ? 'Ada' : 'Tidak ada',
            'ruang_belajar_anak' => $request->has('ruang_belajar_anak') ? 'Ada' : 'Tidak ada',
            'perpustakaan' => $request->has('perpustakaan') ? 'Ada' : 'Tidak ada',
            'pengelola_perpustakaan' => $request->has('pengelola_perpustakaan') ? 'Ada' : 'Tidak ada',
            'alas_duduk' => $request->has('alas_duduk') ? 'Ada' : 'Tidak ada',
            'sound_system' => $request->has('sound_system') ? 'Ada' : 'Tidak ada',
            'lcd_proyektor' => $request->has('lcd_proyektor') ? 'Ada' : 'Tidak ada',
            'tempat_duduk_lansia' => $request->has('tempat_duduk_lansia') ? 'Ada' : 'Tidak ada',
            'ruang_laktasi' => $request->has('ruang_laktasi') ? 'Ada' : 'Tidak ada',
            'jenis_kitab_suci' => json_encode($request->jenis_kitab_suci ?? []),
            'jumlah_pengelola_perpustakaan' => $request->jumlah_pengelola_perpustakaan,
            'jumlah_pengelola_riab' => $request->jumlah_pengelola_riab,
            'jumlah_kitab_suci' => $request->jumlah_kitab_suci,
            'jumlah_buku_keagamaan' => $request->jumlah_buku_keagamaan,
            'lpj_bantuan' => $request->lpj_bantuan,
            'listrik' => $request->listrik,
            'foto_sebelum_bantuan' => $request->foto_sebelum_bantuan,
            'foto_setelah_bantuan' => $request->foto_setelah_bantuan,
            'link_berita_acara_nonaktif' => $request->link_berita_acara_nonaktif,
        ];

        $riab = Riab::create($validated);

        $riab->riabdetail()->updateOrCreate(
            ['riab_id' => $riab->id],
            $detailData
        );    

        return redirect()->route('riab.index')->with('success', 'Data RIAB berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Riab $riab)
    {
        $riab->load(['user','kabupaten','kecamatan', 'riabdetail']);
        return view('riab.show', compact('riab'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riab $riab)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $riab->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }

        $riab->load('riabdetail');
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('riab.edit', compact('riab', 'kabupaten', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riab $riab)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $riab->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data kabupaten ini.');
        }
    
        // Informasi umum
        $validated = $request->validate([
            'no_registrasi' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kelurahan' => 'nullable|string|max:255',
            'kategori_3t' => 'nullable|in:3T,Non 3T',
            'ketua' => 'nullable|string|max:255',
            'thn_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'tgl_tanda_daftar' => 'nullable|date',
            'jenis_riab' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Disetujui,Ditolak,Pending',
            'kondisi' => 'nullable|string|in:Sangat Baik,Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'email' => 'nullable|email|max:255',
            'no_telp' => 'nullable|string|max:100',
            'media_sosial' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'link_foto' => 'nullable|string|max:500',
            'deskripsi' => 'nullable|string|max:2000',
            'jumlah_umat' => 'nullable|integer',
            'eksisting' => 'nullable|string|in:Aktif,Tidak Aktif',
            'tgl_update' => 'nullable|date',
            'status_verifikasi' => 'nullable|string|in:TRUE,FALSE',
            'user_id' => 'required|exists:users,id', 

            // Informasi detail
            'update_sisfo' => 'nullable|string|max:255',
            'terdaftar_siori' => 'nullable|in:Sudah,Belum',
            'status_tanah' => 'nullable|string|max:255',
            'th_menerima_sertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_rehabilitasi' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_bersih_sehat' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_kek' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_bantuan_bangun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'th_menerima_bpriab_perpus' => 'nullable|integer|min:1900|max:' . date('Y'),
            'luas_tanah' => 'nullable|numeric',
            'luas_bangunan' => 'nullable|numeric',
            'kondisi_geografis' => 'nullable|array',
            'peta_rawan_bencana' => 'nullable|array',
            //'sertifikasi_tanah' => 'nullable|in:Sudah,Belum',
            //'lahan_parkir' => 'nullable|in:Ada,Tidak ada',
            'lpj_bantuan' => 'nullable|string|max:255',
            //'toilet_disable' => 'nullable|in:Ada,Tidak ada',
            //'kursi_roda' => 'nullable|in:Ada,Tidak ada',
            //'jalur_kursi_roda' => 'nullable|in:Ada,Tidak ada',
            //'fasilitas_jalur_kursi_roda' => 'nullable|in:Ada,Tidak ada',
            //'tempat_bermain' => 'nullable|in:Ada,Tidak ada',
            //'toilet_anak' => 'nullable|in:Ada,Tidak ada',
            //'wastafel_anak' => 'nullable|in:Ada,Tidak ada',
            //'ruang_ac' => 'nullable|in:Ada,Tidak ada',
            //'ruang_belajar_anak' => 'nullable|in:Ada,Tidak ada',
            //'perpustakaan' => 'nullable|in:Ada,Tidak ada',
            //'pengelola_perpustakaan' => 'nullable|string|max:255',
            //'alas_duduk' => 'nullable|in:Ada,Tidak ada',
            //'sound_system' => 'nullable|in:Ada,Tidak ada',
            //'lcd_proyektor' => 'nullable|in:Ada,Tidak ada',
            //'ruang_laktasi' => 'nullable|in:Ada,Tidak ada',
            'jumlah_pengelola_perpustakaan' => 'nullable|integer',
            'jumlah_pengelola_riab' => 'nullable|integer',
            'jumlah_kitab_suci' => 'nullable|integer',
            'jumlah_buku_keagamaan' => 'nullable|integer',
            'lpj_bantuan' => 'nullable|string|max:255',
            'listrik' => 'nullable|string|max:255',
            'foto_sebelum_bantuan' => 'nullable|string|max:1500',
            'foto_setelah_bantuan' => 'nullable|string|max:1500',
        ]);

        $detailData = [
            'riab_id' => $riab->id,
            'update_sisfo' => $request->update_sisfo,
            'terdaftar_siori' => $request->terdaftar_siori,
            'status_tanah' => $request->status_tanah,
            'th_menerima_sertifikasi' => $request->th_menerima_sertifikasi,
            'th_menerima_rehabilitasi' => $request->th_menerima_sertifikasi,
            'th_menerima_bersih_sehat' => $request->th_menerima_sertifikasi,
            'th_menerima_kek' => $request->th_menerima_sertifikasi,
            'th_menerima_bantuan_bangun' => $request->th_menerima_sertifikasi,
            'th_menerima_bpriab_perpus' => $request->th_menerima_sertifikasi,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' =>  $request->luas_bangunan,
            'kondisi_geografis' => json_encode($request->kondisi_geografis ?? []),
            'peta_rawan_bencana' => json_encode($request->peta_rawan_bencana ?? []),
            'sertifikasi_tanah' => $request->has('sertifikasi_tanah') ? 'Sudah' : 'Belum',
            'lahan_parkir' => $request->has('lahan_parkir') ? 'Ada' : 'Tidak ada',
            'lpj_bantuan' => $request->lpj_bantuan,
            'toilet_disable' => $request->has('toilet_disable') ? 'Ada' : 'Tidak ada',
            'kursi_roda' => $request->has('kursi_roda') ? 'Ada' : 'Tidak ada',
            'jalur_kursi_roda' => $request->has('jalur_kursi_roda') ? 'Ada' : 'Tidak ada',
            'fasilitas_jalur_kursi_roda' => $request->has('fasilitas_jalur_kursi_roda') ? 'Ada' : 'Tidak ada',
            'lift' => $request->has('lift') ? 'Ada' : 'Tidak ada',
            'tempat_bermain' => $request->has('tempat_bermain') ? 'Ada' : 'Tidak ada',
            'toilet_anak' => $request->has('toilet_anak') ? 'Ada' : 'Tidak ada',
            'wastafel_anak' => $request->has('wastafel_anak') ? 'Ada' : 'Tidak ada',
            'ruang_ac' => $request->has('ruang_ac') ? 'Ada' : 'Tidak ada',
            'ruang_belajar_anak' => $request->has('ruang_belajar_anak') ? 'Ada' : 'Tidak ada',
            'perpustakaan' => $request->has('perpustakaan') ? 'Ada' : 'Tidak ada',
            'pengelola_perpustakaan' => $request->has('pengelola_perpustakaan') ? 'Ada' : 'Tidak ada',
            'alas_duduk' => $request->has('alas_duduk') ? 'Ada' : 'Tidak ada',
            'sound_system' => $request->has('sound_system') ? 'Ada' : 'Tidak ada',
            'lcd_proyektor' => $request->has('lcd_proyektor') ? 'Ada' : 'Tidak ada',
            'tempat_duduk_lansia' => $request->has('tempat_duduk_lansia') ? 'Ada' : 'Tidak ada',
            'ruang_laktasi' => $request->has('ruang_laktasi') ? 'Ada' : 'Tidak ada',
            'jenis_kitab_suci' => json_encode($request->jenis_kitab_suci ?? []),
            'jumlah_pengelola_perpustakaan' => $request->jumlah_pengelola_perpustakaan,
            'jumlah_pengelola_riab' => $request->jumlah_pengelola_riab,
            'jumlah_kitab_suci' => $request->jumlah_kitab_suci,
            'jumlah_buku_keagamaan' => $request->jumlah_buku_keagamaan,
            'lpj_bantuan' => $request->lpj_bantuan,
            'listrik' => $request->listrik,
            'foto_sebelum_bantuan' => $request->foto_sebelum_bantuan,
            'foto_setelah_bantuan' => $request->foto_setelah_bantuan,
            'link_berita_acara_nonaktif' => $request->link_berita_acara_nonaktif,
        ];

        $riab->update($request->all());
        //$riab->update($validated);
        $riab->riabdetail()->updateOrCreate(
            ['riab_id' => $riab->id],
            $detailData
        );

        return redirect()->route('riab.index')->with('success', 'Data RIAB berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riab $riab)
    {
        if (Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id !== $riab->kabupaten_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data kabupaten ini.');
        }

        $riab->delete();
        return redirect()->route('riab.index')->with('success', 'Data RIAB berhasil dihapus.');
    }
}

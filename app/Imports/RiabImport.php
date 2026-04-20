<?php

namespace App\Imports;

use App\Models\Riab;
use App\Models\RiabDetail;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RiabImport implements ToCollection, WithHeadingRow
{
    private $kabupatens;
    private $kecamatans;

    public function __construct()
    {
        $this->kabupatens = Kabupaten::all()->pluck('id', 'kabupaten');
        $this->kecamatans = Kecamatan::all()->pluck('id', 'kecamatan');
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Bypass empty rows
            if (!isset($row['nama_riab']) && !isset($row['nama'])) {
                continue;
            }

            $nama = $row['nama_riab'] ?? $row['nama'] ?? '';

            $kabupaten_id = null;
            if (Auth::user()->user_role !== 'admin') {
                $kabupaten_id = Auth::user()->kabupaten_id;
            } else {
                // Find by name
                $kabName = $row['kabupaten'] ?? null;
                if ($kabName && isset($this->kabupatens[$kabName])) {
                    $kabupaten_id = $this->kabupatens[$kabName];
                }
            }
            
            // If kabupaten_id is still unknown, we must skip or assign default
            if (!$kabupaten_id) {
                continue;
            }

            $kecamatan_id = null;
            $kecName = $row['kecamatan'] ?? null;
            if ($kecName && isset($this->kecamatans[$kecName])) {
                $kecamatan_id = $this->kecamatans[$kecName];
            }

            // Map status verifikasi, kalau upload/edit lewat file default tetep mengikuti rule sama
            $status_verifikasi = $row['status_verifikasi'] ?? 'pending';
            if (Auth::user()->user_role !== 'admin') {
                $status_verifikasi = 'pending';
            }

            $data = [
                'no_registrasi' => $row['no_registrasi'] ?? null,
                'nama' => $nama,
                'kabupaten_id' => $kabupaten_id,
                'kecamatan_id' => $kecamatan_id,
                'kelurahan' => $row['kelurahan'] ?? null,
                'kategori_3t' => $row['kategori_3t'] ?? null,
                'ketua' => $row['ketua'] ?? null,
                'thn_berdiri' => $row['tahun_berdiri'] ?? $row['thn_berdiri'] ?? null,
                'alamat' => $row['alamat'] ?? null,
                'tgl_tanda_daftar' => $row['tanggal_tanda_daftar'] ?? $row['tgl_tanda_daftar'] ?? null,
                'jenis_riab' => $row['jenis_riab'] ?? null,
                'status' => $row['status'] ?? null,
                'kondisi' => $row['kondisi'] ?? null,
                'email' => $row['email'] ?? null,
                'no_telp' => $row['no_telp'] ?? null,
                'media_sosial' => $row['media_sosial'] ?? null,
                'latitude' => $row['latitude'] ?? null,
                'longitude' => $row['longitude'] ?? null,
                'link_foto' => $row['link_foto'] ?? null,
                'deskripsi' => $row['deskripsi'] ?? null,
                'jumlah_umat' => $row['jumlah_umat'] ?? null,
                'eksisting' => $row['status_eksisting'] ?? $row['eksisting'] ?? null,
                'tgl_update' => $row['tanggal_update'] ?? $row['tgl_update'] ?? null,
                'status_verifikasi' => $status_verifikasi,
                'user_id' => Auth::id(),
            ];

            $riabInstance = null;

            if (isset($row['id']) && $row['id']) {
                $riabInstance = Riab::find($row['id']);
                if ($riabInstance) {
                    // If user is not admin, ensure they own the RIAB
                    if (Auth::user()->user_role !== 'admin' && $riabInstance->kabupaten_id !== Auth::user()->kabupaten_id) {
                        continue; // Skip updating others' data
                    }
                    $riabInstance->update($data);
                }
            }

            if (!$riabInstance) {
                // Creates new record
                $riabInstance = Riab::create($data);
            }

            // --- Bagian update ke RiabDetail khusus fields tertentu ---
            if ($riabInstance) {
                // Parse kondisi_geografis & peta_rawan_bencana yang berbentuk string koma dari Excel
                $kondisiGeografis = isset($row['kondisi_geografis']) && !empty(trim($row['kondisi_geografis'])) ? array_map('trim', explode(',', $row['kondisi_geografis'])) : null;
                $rawanBencana = isset($row['peta_rawan_bencana']) && !empty(trim($row['peta_rawan_bencana'])) ? array_map('trim', explode(',', $row['peta_rawan_bencana'])) : null;
                
                RiabDetail::updateOrCreate(
                    ['riab_id' => $riabInstance->id],
                    [
                        'status_tanah' => $row['status_tanah'] ?? null,
                        'luas_tanah' => $row['luas_tanah'] ?? null,
                        'luas_bangunan' => $row['luas_bangunan'] ?? null,
                        'kondisi_geografis' => $kondisiGeografis,
                        'peta_rawan_bencana' => $rawanBencana,
                    ]
                );
            }
        }
    }
}

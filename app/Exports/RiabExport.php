<?php

namespace App\Exports;

use App\Models\Riab;
use App\Models\RiabDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class RiabExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = Riab::with(['kabupaten', 'kecamatan', 'riabdetail']);

        if (Auth::user()->user_role !== 'admin') {
            $query->where('kabupaten_id', Auth::user()->kabupaten_id);
        }

        return $query->orderBy('id', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'No Registrasi',
            'Nama RIAB',
            'Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'Kategori 3T',
            'Ketua',
            'Tahun Berdiri',
            'Alamat',
            'Tanggal Tanda Daftar',
            'Jenis RIAB',
            'Status',
            'Kondisi',
            'Email',
            'No Telp',
            'Media Sosial',
            'Latitude',
            'Longitude',
            'Link Foto',
            'Deskripsi',
            'Jumlah Umat',
            'Status Eksisting',
            'Tanggal Update',
            'Status Verifikasi',
            'Status Tanah',
            'Luas Tanah',
            'Luas Bangunan',
            'Kondisi Geografis',
            'Peta Rawan Bencana',
        ];
    }

    public function map($riab): array
    {
        return [
            $riab->id,
            $riab->no_registrasi,
            $riab->nama,
            $riab->kabupaten->kabupaten ?? '',
            $riab->kecamatan->kecamatan ?? '',
            $riab->kelurahan,
            $riab->kategori_3t,
            $riab->ketua,
            $riab->thn_berdiri,
            $riab->alamat,
            $riab->tgl_tanda_daftar,
            $riab->jenis_riab,
            $riab->status,
            $riab->kondisi,
            $riab->email,
            $riab->no_telp,
            $riab->media_sosial,
            $riab->latitude,
            $riab->longitude,
            $riab->link_foto,
            $riab->deskripsi,
            $riab->jumlah_umat,
            $riab->eksisting,
            $riab->tgl_update,
            $riab->status_verifikasi,
            $riab->riabdetail->status_tanah ?? '',
            $riab->riabdetail->luas_tanah ?? '',
            $riab->riabdetail->luas_bangunan ?? '',
            // Handle array/json fields
            is_array($riab->riabdetail?->kondisi_geografis) ? implode(', ', $riab->riabdetail->kondisi_geografis) : ($riab->riabdetail?->kondisi_geografis ?? ''),
            is_array($riab->riabdetail?->peta_rawan_bencana) ? implode(', ', $riab->riabdetail->peta_rawan_bencana) : ($riab->riabdetail?->peta_rawan_bencana ?? ''),
        ];
    }
}

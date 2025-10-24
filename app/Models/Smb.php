<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Smb extends Model
{
    use HasFactory;

    protected $table = 'smb';

    protected $fillable = [
            'nama','alamat','didirikan','izop_1','ppjg_1','ppjg_2','nssmb',
            'tgl_izop','masa_izop','bapen','alamat_bapen','kabupaten_id','nama_pic',
            'no_telp','jumlah_siswa','status','eksisting','link_berita_acara_nonaktif','kondisi',
            'tgl_update','status_verifikasi','deskripsi','email','media_sosial','user_id',
    ];

    public function kabupaten() {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }
    
    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function siswasmb() {
        return $this->hasMany(SiswaSmb::class, 'smb_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

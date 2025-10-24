<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dhammasekha extends Model
{
    use HasFactory;

    protected $table = 'dhammasekha';

    protected $fillable = [
            'kabupaten_id','jenis','nama','tgl_berdiri','no_izop','izop_ppjg','tgl_izop',
            'masa_izop','no_statistik','nama_yayasan','alamat_yayasan','npyp','npsn',
            'akreditasi','nama_pic','no_hp','email','naungan_kemenag','naungan_disdik', 
            'tk_disdik_kb_kemenag', 'jml_siswa', 'eksisting', 'link_nonaktif','kondisi',
            'foto','keterangan','tgl_update','status_verifikasi','user_id',
    ];

    public function kabupaten() {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }
    
    // public function kecamatan() {
    //     return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    // }

    public function siswaDhammasekha() {
        return $this->hasMany(SiswaDhammasekha::class, 'dhammasekha_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pusdiklat extends Model 
{

    use HasFactory;

    protected $table = 'pusdiklat';
    
    protected $fillable = ['kabupaten_id','nama','alamat','berdiri',
        'izop_1','ppjg_1','ppjg_2','no_statistik','th_izop','tgl_izop',
        'masa_izop','bapen','alamat_bapen','nama_pic','no_hp',
        'jml_siswa','eksisting','link_nonaktif','kondisi',
        'foto','keterangan','tgl_update','status_verifikasi','user_id',
    ];


    public function tendiks()
    {
        return $this->morphMany(Tendik::class, 'lembaga');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }


    public function getDirectFotoUrlAttribute()
    {
        // jika tidak ada link_foto, kembalikan null
        if (empty($this->foto)) {
            return null;
        }

        // coba ambil ID dari pola Google Drive
        if (preg_match('/\/d\/(.*?)\//', $this->foto, $matches)) {
            $fileId = $matches[1];
            return "https://drive.google.com/uc?export=view&id={$fileId}";
        }

        // kalau bukan link drive, bisa langsung kembalikan url aslinya (opsional)
        return $this->foto;
    }


}
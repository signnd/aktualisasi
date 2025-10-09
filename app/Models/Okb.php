<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Okb extends Model 
{

    use HasFactory;

    protected $table = 'okb';
    
    protected $fillable = ['kabupaten_id','kecamatan_id','kelurahan',
        'kategori_3t','no_registrasi','nama_okb','ketua','thn_berdiri',
        'alamat','tgl_tanda_daftar','jenis_kelembagaan','status', 
        'update_sisfo','logo_okb','media_sosial','email','no_telp','eksisting',
        'tgl_update','status_verifikasi','user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function getDirectFotoUrlAttribute()
    {
        // jika tidak ada link_foto, kembalikan null
        if (empty($this->logo_okb)) {
            return null;
        }

        // coba ambil ID dari pola Google Drive
        if (preg_match('/\/d\/(.*?)\//', $this->logo_okb, $matches)) {
            $fileId = $matches[1];
            return "https://drive.google.com/uc?export=view&id={$fileId}";
        }

        // kalau bukan link drive, bisa langsung kembalikan url aslinya (opsional)
        return $this->logo_okb;
    }


}
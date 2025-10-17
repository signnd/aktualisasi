<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Riab extends Model
{
    use HasFactory;

    protected $table = 'riab';
    
    protected $fillable = [
        'no_registrasi','nama', 'kabupaten_id','kecamatan_id',
        'kelurahan', 'kategori_3t','ketua','thn_berdiri','alamat','tgl_tanda_daftar',
        'jenis_riab','status','kondisi','email','no_telp','media_sosial',
        'latitude','longitude','link_foto','deskripsi','jumlah_umat',
        'eksisting','tgl_update','status_verifikasi','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function riabdetail(){
        return $this->hasOne(RiabDetail::class, 'riab_id', 'id');
    }
}

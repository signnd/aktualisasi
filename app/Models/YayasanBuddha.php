<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class YayasanBuddha extends Model
{
    use HasFactory;

    protected $table = 'yayasan_buddha';
    
    protected $fillable = ['kabupaten_id', 'kecamatan_id', 'nama_yayasan', 'ketua', 'alamat',
        'tgl_terdaftar', 'keterangan'
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

}

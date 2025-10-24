<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupaten';
    protected $fillable = ['kabupaten', 'kode_kab'];

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function riabs()
    {
        return $this->hasMany(Riab::class);
    }

    public function okbs()
    {
        return $this->hasMany(Okb::class);
    }

    //public function yayasans()
    //{
    //    return $this->hasMany(YayasanBuddha::class);
    //}

    public function smb() {
        return $this->hasMany(Smb::class);
    }

    public function siswaSmb () {
        return $this->hasMany(SiswaSmb::class);
    }

    public function dhammasekha() {
        return $this->hasMany(Dhammasekha::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }

}

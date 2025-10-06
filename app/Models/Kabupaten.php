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

}

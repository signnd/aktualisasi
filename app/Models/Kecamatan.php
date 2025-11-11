<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan'; 
    protected $fillable = ['kecamatan', 'kabupaten_id'];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
    
    public function riabs() 
    {
        return $this->hasMany(Riab::class);
    }

    public function users() 
    {
        return $this->hasMany(User::class,'kabupaten_id');
    }
}

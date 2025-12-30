<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Majelis extends Model
{
    use HasFactory;

    protected $table = 'majelis';
    
    protected $fillable = ['kabupaten_id', 'kecamatan_id', 'nama_majelis', 
        'sekte', 'binaan', 'ketua', 'keterangan'
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

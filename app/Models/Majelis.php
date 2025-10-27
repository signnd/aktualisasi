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

    // Event Listeners
    // protected static function boot()
    // {
    //     parent::boot();

    //     // Saat data dibuat
    //     static::creating(function ($majelis) {
    //         $majelis->tgl_update = Carbon::now()->format('Y-m-d');
    //     });

    //     // Saat data diupdate
    //     static::updating(function ($majelis) {
    //         $majelis->tgl_update = Carbon::now()->format('Y-m-d');
    //     });
    // }


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

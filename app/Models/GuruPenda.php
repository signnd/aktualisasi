<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class GuruPenda extends Model
{
    use HasFactory;

    protected $table = 'guru_penda';
    protected $fillable = ['kabupaten_id','nama_guru','nip','nik','nrg','jenis_kelamin',
        'tempat_lahir','tgl_lahir','alamat','nama_sekolah_sd','alamat_sekolah_sd','nama_sekolah_smp','alamat_sekolah_smp',
        'nama_sekolah_sma','alamat_sekolah_sma','no_hp','email','status_pegawai','sertifikasi',
        'tgl_sertifikasi','mapel_sertifikasi','pendidikan_terakhir','link_sertifikasi','foto','jml_siswa','tgl_update',
        'status_verifikasi','user_id'
    ];

    // Event Listeners
    protected static function boot()
    {
        parent::boot();

        // Saat data dibuat
        static::creating(function ($guruPenda) {
            $guruPenda->tgl_update = Carbon::now()->format('Y-m-d');
        });

        // Saat data diupdate
        static::updating(function ($guruPenda) {
            $guruPenda->tgl_update = Carbon::now()->format('Y-m-d');
        });
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

}

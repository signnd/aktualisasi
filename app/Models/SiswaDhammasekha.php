<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaDhammasekha extends Model
{
    use HasFactory;

    protected $table = 'siswa_dhammasekha';

    protected $fillable = [
        'dhammasekha_id',
        'kabupaten_id',
        'nama_siswa',
        'jenis_kelamin',
        'agama',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
        'nisn',
        'tahun_ajaran',
        'alamat',
        'nama_ibu',
        'nama_ayah',
        'no_hp',
        'email',
        'pendidikan',
        'kelas',
        'keterangan',
        'tgl_update',
        'status_verifikasi',
        'user_id',
    ];

    public function dhammasekha() {
        return $this->belongsTo(Dhammasekha::class, 'dhammasekha_id');
    }

    public function kabupaten() {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

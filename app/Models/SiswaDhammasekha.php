<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

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

    // Event Listeners
    protected static function boot()
    {
        parent::boot();
        // Saat siswa dibuat
        static::creating(function ($siswa) {
            $siswa->tgl_update = Carbon::now()->format('Y-m-d');
        });

        // Saat siswa diupdate
        static::updating(function ($siswa) {
            $siswa->tgl_update = Carbon::now()->format('Y-m-d');
        });

        // Saat siswa dibuat (created)
        static::created(function ($siswa) {
            $siswa->updateJumlahSiswa();
        });

        // Saat siswa dihapus (deleted)
        static::deleted(function ($siswa) {
            $siswa->updateJumlahSiswa();
        });
    }

    // Method untuk update jumlah siswa di tabel dhammasekha
    protected function updateJumlahSiswa()
    {
        if ($this->dhammasekha) {
            $jumlah = SiswaDhammasekha::where('dhammasekha_id', $this->dhammasekha_id)->count();
            $this->dhammasekha->update(['jml_siswa' => $jumlah]);
        }
    }

}

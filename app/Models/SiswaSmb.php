<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaSmb extends Model
{
    use HasFactory;

    protected $table = 'siswa_smb';

    protected $fillable = [
            'nama',
            'kabupaten_id',
            'smb_id',
            'nama_siswa',
            'jenis_kelamin',
            'nik',
            'tempat_lahir',
            'tgl_lahir',
            'alamat',
            'no_hp',
            'email',
            'kelas',
            'keterangan',
            'tgl_update',
            'status_verifikasi',
            'user_id',
    ];


    // Event Listeners
    protected static function boot()
    {
        parent::boot();

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

    public function smb() {
        return $this->belongsTo(Smb::class, 'smb_id');
    }

    public function kabupaten() {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

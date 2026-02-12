<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Tendik extends Model
{
    use HasFactory;
    protected $table = 'tendik';

    protected $fillable = ['kabupaten_id','nama_tendik','jenis_kelamin','nik',
        'tempat_lahir','tgl_lahir','alamat','no_hp','email','nama_lembaga',
        'tmt_pendidik','satker','yang_mengangkat','status_pegawai','jabatan','pendidikan_terakhir','program_studi',
        'menerima_insentif','menerima_tpg','link_sk','link_sertifikat','foto','keterangan','tgl_update',
        'status_verifikasi','user_id', 'lembaga_id', 'lembaga_type'
    ];

    public function lembaga()
    {
        return $this->morphTo();
    }

    // Event Listeners
    protected static function boot()
    {
        parent::boot();

        // Saat data dibuat
        static::creating(function ($tendik) {
            $tendik->tgl_update = Carbon::now()->format('Y-m-d');
            $tendik->mapLembaga();
        });

        // Saat data diupdate
        static::updating(function ($tendik) {
            $tendik->tgl_update = Carbon::now()->format('Y-m-d');
            $tendik->mapLembaga();
        });
    }

    public function mapLembaga()
    {
        if (empty($this->nama_lembaga)) {
            $this->lembaga_id = null;
            $this->lembaga_type = null;
            return;
        }

        // Cari di Smb
        $smb = Smb::where('nama_smb', $this->nama_lembaga)->first();
        if ($smb) {
            $this->lembaga_id = $smb->id;
            $this->lembaga_type = Smb::class;
            return;
        }

        // Cari di Dhammasekha
        $ds = Dhammasekha::where('nama', $this->nama_lembaga)->first();
        if ($ds) {
            $this->lembaga_id = $ds->id;
            $this->lembaga_type = Dhammasekha::class;
            return;
        }

        // Cari di Pusdiklat
        $pk = Pusdiklat::where('nama', $this->nama_lembaga)->first();
        if ($pk) {
            $this->lembaga_id = $pk->id;
            $this->lembaga_type = Pusdiklat::class;
            return;
        }

        // Jika tidak ditemukan, biarkan null (relasi link tidak muncul, tapi teks ada)
        $this->lembaga_id = null;
        $this->lembaga_type = null;
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function getDirectFotoUrlAttribute()
    {
        if (empty($this->foto)) {
            return null;
        }

        // Handle Google Drive links
        if (preg_match('/\/d\/(.*?)\//', $this->foto, $matches)) {
            $fileId = $matches[1];
            return "https://drive.google.com/uc?export=view&id={$fileId}";
        }

        // Handle direct view links or other patterns if necessary
        if (str_contains($this->foto, 'drive.google.com/file/d/')) {
            $parts = explode('/d/', $this->foto);
            $idPart = explode('/', $parts[1])[0];
            return "https://drive.google.com/uc?export=view&id={$idPart}";
        }

        return $this->foto;
    }

}

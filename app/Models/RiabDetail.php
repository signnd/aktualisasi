<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiabDetail extends Model
{
    use HasFactory;

    protected $table = 'riab_details';
    public $incrementing = false; // karena primary key bukan auto increment
    protected $keyType = 'int';

    protected $fillable = [
        'riab_id','update_sisfo','terdaftar_siori','status_tanah',
        'th_menerima_sertifikasi','th_menerima_rehabilitasi','th_menerima_bersih_sehat',
        'th_menerima_kek','th_menerima_bantuan_bangun','th_menerima_bpriab_perpus',
        'luas_tanah','luas_bangunan','kondisi_geografis','peta_rawan_bencana',
        'sertifikasi_tanah','lahan_parkir','toilet_disable','kursi_roda','jalur_kursi_roda',
        'fasilitas_jalur_kursi_roda','tempat_bermain','toilet_anak','wastafel_anak',
        'ruang_ac','ruang_belajar_anak','perpustakaan','pengelola_perpustakaan',
        'alas_duduk','sound_system','lcd_proyektor','ruang_laktasi',
        'jumlah_pengelola_perpustakaan','jumlah_pengelola_riab','jumlah_kitab_suci',
        'jumlah_buku_keagamaan','lpj_bantuan','listrik','foto_sebelum_bantuan','foto_setelah_bantuan'
    ];
    
    public function riab()
    {
        return $this->belongsTo(Riab::class);
    }
        
}

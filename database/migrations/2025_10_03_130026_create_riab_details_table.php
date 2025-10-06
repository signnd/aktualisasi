<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riab_details', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('riab_id')->primary();
            $table->boolean('update_sisfo')->nullable();
            $table->enum('terdaftar_siori', ['sudah','belum'])->nullable();
            $table->string('status_tanah')->nullable();
            $table->year('th_menerima_sertifikasi')->nullable();
            $table->year('th_menerima_rehabilitasi')->nullable();
            $table->year('th_menerima_bersih_sehat')->nullable();
            $table->year('th_menerima_kek')->nullable();
            $table->year('th_menerima_bantuan_bangun')->nullable();
            $table->year('th_menerima_bpriab_perpus')->nullable();
            $table->decimal('luas_tanah', 10, 2)->nullable();
            $table->decimal('luas_bangunan', 10, 2)->nullable();
            $table->string('kondisi_geografis')->nullable();
            $table->string('peta_rawan_bencana')->nullable();
            $table->boolean('sertifikasi_tanah')->nullable();
            $table->boolean('lahan_parkir')->nullable();
            $table->boolean('toilet_disable')->nullable();
            $table->boolean('kursi_roda')->nullable();
            $table->boolean('jalur_kursi_roda')->nullable();
            $table->boolean('fasilitas_jalur_kursi_roda')->nullable();
            $table->boolean('tempat_bermain')->nullable();
            $table->boolean('toilet_anak')->nullable();
            $table->boolean('wastafel_anak')->nullable();
            $table->boolean('ruang_ac')->nullable();
            $table->boolean('ruang_belajar_anak')->nullable();
            $table->boolean('perpustakaan')->nullable();
            $table->string('pengelola_perpustakaan')->nullable();
            $table->boolean('alas_duduk')->nullable();
            $table->boolean('sound_system')->nullable();
            $table->boolean('lcd_proyektor')->nullable();
            $table->boolean('ruang_laktasi')->nullable();
            $table->integer('jumlah_pengelola_perpustakaan')->nullable();
            $table->integer('jumlah_pengelola_riab')->nullable();
            $table->integer('jumlah_kitab_suci')->nullable();
            $table->integer('jumlah_buku_keagamaan')->nullable();
            $table->boolean('lpj_bantuan')->nullable();
            $table->boolean('listrik')->nullable();
            $table->string('foto_sebelum_bantuan')->nullable();
            $table->string('foto_setelah_bantuan')->nullable();
            $table->foreign('riab_id')->references('id')->on('riab')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riab_details');
    }
};

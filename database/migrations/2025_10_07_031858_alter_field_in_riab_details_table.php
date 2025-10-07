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
        Schema::table('riab_details', function (Blueprint $table) {
            $table->string('update_sisfo')->nullable()->change();
            $table->string('lpj_bantuan')->nullable()->change();
            $table->string('listrik')->nullable()->change();
            $table->enum('sertifikasi_tanah', ['Sudah', 'Belum'])->nullable()->change();
            $table->enum('lahan_parkir', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('toilet_disable', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('kursi_roda', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('jalur_kursi_roda', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('fasilitas_jalur_kursi_roda', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('tempat_bermain', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('toilet_anak', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('wastafel_anak', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('ruang_ac', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('ruang_belajar_anak', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('perpustakaan', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('alas_duduk', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('sound_system', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('lcd_proyektor', ['Ada', 'Tidak ada'])->nullable()->change();
            $table->enum('ruang_laktasi', ['Ada', 'Tidak ada'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riab_details', function (Blueprint $table) {
            $table->boolean('update_sisfo')->nullable()->change();
            $table->enum('terdaftar_siori', ['sudah','belum'])->nullable()->change();
            $table->string('status_tanah')->nullable()->change();
            $table->year('th_menerima_sertifikasi')->nullable()->change();
            $table->year('th_menerima_rehabilitasi')->nullable()->change();
            $table->year('th_menerima_bersih_sehat')->nullable()->change();
            $table->year('th_menerima_kek')->nullable()->change();
            $table->year('th_menerima_bantuan_bangun')->nullable()->change();
            $table->year('th_menerima_bpriab_perpus')->nullable()->change();
            $table->decimal('luas_tanah', 10, 2)->nullable()->change();
            $table->decimal('luas_bangunan', 10, 2)->nullable()->change();
            $table->boolean('sertifikasi_tanah')->nullable()->change();
            $table->boolean('lahan_parkir')->nullable()->change();
            $table->boolean('toilet_disable')->nullable()->change();
            $table->boolean('kursi_roda')->nullable()->change();
            $table->boolean('jalur_kursi_roda')->nullable()->change();
            $table->boolean('fasilitas_jalur_kursi_roda')->nullable()->change();
            $table->boolean('tempat_bermain')->nullable()->change();
            $table->boolean('toilet_anak')->nullable()->change();
            $table->boolean('wastafel_anak')->nullable()->change();
            $table->boolean('ruang_ac')->nullable()->change();
            $table->boolean('ruang_belajar_anak')->nullable()->change();
            $table->boolean('perpustakaan')->nullable()->change();
            $table->boolean('alas_duduk')->nullable()->change();
            $table->boolean('sound_system')->nullable()->change();
            $table->boolean('lcd_proyektor')->nullable()->change();
            $table->boolean('ruang_laktasi')->nullable()->change();
            $table->boolean('lpj_bantuan')->nullable()->change();
            $table->boolean('listrik')->nullable()->change();
        });
    }
};

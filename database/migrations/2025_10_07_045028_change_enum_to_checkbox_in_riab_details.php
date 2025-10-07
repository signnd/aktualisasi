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
            $table->string('sertifikasi_tanah')->nullable()->change();
            $table->string('lahan_parkir')->nullable()->change();
            $table->string('toilet_disable')->nullable()->change();
            $table->string('kursi_roda')->nullable()->change();
            $table->string('jalur_kursi_roda')->nullable()->change();
            $table->string('fasilitas_jalur_kursi_roda')->nullable()->change();
            $table->string('tempat_bermain')->nullable()->change();
            $table->string('toilet_anak')->nullable()->change();
            $table->string('wastafel_anak')->nullable()->change();
            $table->string('ruang_ac')->nullable()->change();
            $table->string('ruang_belajar_anak')->nullable()->change();
            $table->string('perpustakaan')->nullable()->change();
            $table->string('pengelola_perpustakaan')->nullable()->change();
            $table->string('alas_duduk')->nullable()->change();
            $table->string('sound_system')->nullable()->change();
            $table->string('lcd_proyektor')->nullable()->change();
            $table->string('ruang_laktasi')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riab_details', function (Blueprint $table) {
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
};

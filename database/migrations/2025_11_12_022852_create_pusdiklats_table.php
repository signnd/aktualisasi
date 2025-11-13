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
        Schema::create('pusdiklat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupaten')->nullOnDelete();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('berdiri')->nullable();
            $table->string('izop_1')->nullable();
            $table->string('ppjg_1')->nullable();
            $table->string('ppjg_2')->nullable();
            $table->string('no_statistik')->nullable();
            $table->date('th_izop')->nullable();
            $table->date('tgl_izop')->nullable();
            $table->date('masa_izop')->nullable();
            $table->string('bapen')->nullable();
            $table->string('alamat_bapen')->nullable();
            $table->string('nama_pic')->nullable();
            $table->string('no_hp', 100)->nullable();
            $table->string('jml_siswa')->nullable();
            $table->enum('eksisting', ['Aktif','Tidak Aktif'])->nullable();
            $table->string('link_nonaktif')->nullable();
            $table->enum('kondisi', ['Sangat Baik','Baik','Rusak Ringan','Rusak Sedang','Rusak Berat'])->nullable();
            $table->string('foto')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tgl_update')->nullable();
            $table->enum('status_verifikasi', ['TRUE','FALSE'])->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pusdiklat');
    }
};
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
        Schema::create('guru_penda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupaten')->nullOnDelete();
            $table->string('nama_guru');
            $table->string('nip')->nullable();
            $table->string('nik')->nullable();
            $table->string('nrg')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('nama_sekolah_sd')->nullable();
            $table->string('alamat_sekolah_sd')->nullable();
            $table->string('nama_sekolah_smp')->nullable();
            $table->string('alamat_sekolah_smp')->nullable();
            $table->string('nama_sekolah_sma')->nullable();
            $table->string('alamat_sekolah_sma')->nullable();
            $table->string('nama_sekolah_4')->nullable();
            $table->string('alamat_sekolah_4')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('sertifikasi')->nullable();
            $table->date('tgl_sertifikasi')->nullable();
            $table->string('mapel_sertifikasi')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('link_sertifikasi')->nullable();
            $table->string('foto')->nullable();
            $table->string('jml_siswa')->nullable();
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
        Schema::dropIfExists('guru_penda');
    }
};

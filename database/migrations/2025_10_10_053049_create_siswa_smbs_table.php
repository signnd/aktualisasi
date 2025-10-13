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
        Schema::create('siswa_smb', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupaten')->nullOnDelete();
            $table->foreignId('smb_id')->constrained('smb')->cascadeOnDelete();
            $table->string('nama_siswa')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan'])->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('kelas')->nullable();
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
        Schema::dropIfExists('siswa_smb');
    }
};

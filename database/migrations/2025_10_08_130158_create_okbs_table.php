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
        Schema::create('okb', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabupaten_id')->constrained('kabupaten');
            $table->foreignId('kecamatan_id')->constrained('kecamatan');
            $table->string('kelurahan');
            $table->enum('kategori_3t', ['3T', 'Non 3T'])->nullable();
            $table->string('no_registrasi')->nullable()->unique();
            $table->string('nama_okb');
            $table->string('ketua')->nullable();
            $table->year('thn_berdiri')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tgl_tanda_daftar')->nullable();
            $table->string('jenis_kelembagaan')->nullable();
            $table->enum('status', ['Disetujui','Ditolak','Pending'])->nullable();
            $table->string('update_sisfo')->nullable();
            $table->string('logo_okb')->nullable();
            $table->string('media_sosial')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp', 50)->nullable();
            $table->string('eksisting')->nullable();
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
        Schema::dropIfExists('okb');
    }
};

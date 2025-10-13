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
        Schema::create('smb', function (Blueprint $table) {
            $table->id();
            $table->string('nama_smb');
            $table->string('alamat')->nullable();
            $table->string('didirikan')->nullable();
            $table->string('izop_1')->nullable();
            $table->string('ppjg_1')->nullable();
            $table->string('ppjg_2')->nullable();
            $table->string('nssmb')->nullable();
            $table->date('tgl_izop')->nullable();
            $table->string('masa_izop')->nullable();
            $table->string('bapen')->nullable();
            $table->string('alamat_bapen')->nullable();
            $table->foreignId('kabupaten_id')->constrained('kabupaten');
            $table->string('nama_pic')->nullable();
            $table->string('no_telp', 100)->nullable();
            $table->integer('jumlah_siswa')->nullable();
            $table->enum('status', ['Disetujui','Ditolak', 'Pending'])->nullable();
            $table->string('link_berita_acara_nonaktif')->nullable();
            $table->enum('kondisi', ['Sangat Baik','Baik','Rusak Ringan','Rusak Sedang','Rusak Berat'])->nullable();
            $table->string('link_foto')->nullable();
            $table->date('tgl_update')->nullable();
            $table->enum('status_verifikasi', ['TRUE','FALSE'])->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('email')->nullable();
            $table->string('media_sosial')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smb');
    }
};

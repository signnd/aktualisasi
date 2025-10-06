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
        Schema::create('riab', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi')->nullable()->unique();
            $table->string('nama');
            $table->foreignId('kabupaten_id')->constrained('kabupaten');
            $table->foreignId('kecamatan_id')->constrained('kecamatan');
            $table->string('kelurahan');
            $table->enum('kategori_3t', ['ya', 'tidak'])->nullable();
            $table->string('ketua')->nullable();
            $table->year('thn_berdiri')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tgl_tanda_daftar')->nullable();
            $table->string('jenis_riab')->nullable();
            $table->enum('status', ['disetujui','tidak_disetujui'])->nullable();
            $table->enum('kondisi', ['sangat_baik','baik','rusak_ringan','rusak_sedang','rusak_berat'])->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp', 50)->nullable();
            $table->string('media_sosial')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('link_foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_umat')->nullable();
            $table->string('eksisting')->nullable();
            $table->date('tgl_update')->nullable();
            $table->enum('status_verifikasi', ['sudah','belum'])->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riab');
    }
};

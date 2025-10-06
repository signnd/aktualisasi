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
        Schema::table('riab', function (Blueprint $table) {
            $table->string('no_registrasi')->nullable()->change();
            $table->string('nama')->nullable()->change();
            $table->foreignId('kabupaten_id')->nullable()->change();
            $table->foreignId('kecamatan_id')->nullable()->change();
            $table->string('kelurahan')->nullable()->change();
            $table->enum('kategori_3t', ['ya', 'tidak'])->nullable()->change();
            $table->string('ketua')->nullable()->change();
            $table->year('thn_berdiri')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->date('tgl_tanda_daftar')->nullable()->change();
            $table->string('jenis_riab')->nullable()->change();
            $table->enum('status', ['disetujui','tidak_disetujui'])->nullable()->change();
            $table->enum('kondisi', ['sangat_baik','baik','rusak_ringan','rusak_sedang','rusak_berat'])->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('no_telp', 50)->nullable()->change();
            $table->string('media_sosial')->nullable()->change();
            $table->decimal('latitude', 10, 8)->nullable()->change();
            $table->decimal('longitude', 11, 8)->nullable()->change();
            $table->string('link_foto')->nullable()->change();
            $table->text('deskripsi')->nullable()->change();
            $table->integer('jumlah_umat')->nullable()->change();
            $table->string('eksisting')->nullable()->change();
            $table->date('tgl_update')->nullable()->change();
            $table->enum('status_verifikasi', ['sudah','belum'])->nullable()->change();
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // You may want to revert columns to NOT NULL as needed, but be careful with existing data.
    }
};
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
        Schema::table('siswa_smb', function (Blueprint $table) {
            // Hapus kolom 'nama'
            $table->dropColumn('nama');

            // Ubah kolom 'nama_siswa' dari nullable ke required (NOT NULL)
            $table->string('nama_siswa')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa_smb', function (Blueprint $table) {
            // Tambahkan kembali kolom 'nama' jika di-rollback
            $table->string('nama');

            // Kembalikan kolom 'nama_siswa' menjadi nullable
            $table->string('nama_siswa')->nullable()->change();
        });
    }
};

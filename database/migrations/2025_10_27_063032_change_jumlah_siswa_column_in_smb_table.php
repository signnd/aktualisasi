<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1) Tambah kolom sementara integer
        Schema::table('smb', function (Blueprint $table) {
            $table->integer('jumlah_siswa_tmp')->default(0)->after('jumlah_siswa');
        });

        // 2) Isi kolom sementara dengan konversi yang aman:
        //    hanya ambil string yang sepenuhnya numeric, sisanya jadi 0
        DB::statement(<<<'SQL'
            UPDATE smb
            SET jumlah_siswa_tmp = CASE
                WHEN jumlah_siswa REGEXP '^[0-9]+$' THEN CAST(jumlah_siswa AS UNSIGNED)
                WHEN jumlah_siswa IS NULL OR TRIM(jumlah_siswa) = '' THEN 0
                ELSE 0
            END
        SQL
        );

        // 3) Hapus kolom lama (string, bermasalah)
        Schema::table('smb', function (Blueprint $table) {
            $table->dropColumn('jumlah_siswa');
        });

        // 4) Ganti nama kolom sementara menjadi nama final
        Schema::table('smb', function (Blueprint $table) {
            $table->renameColumn('jumlah_siswa_tmp', 'jumlah_siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke bentuk string: buat kolom sementara string, isi dari integer, lalu drop integer dan rename
        Schema::table('smb', function (Blueprint $table) {
            $table->string('jumlah_siswa_old', 100)->nullable()->after('jumlah_siswa');
        });

        DB::statement("UPDATE smb SET jumlah_siswa_old = CAST(jumlah_siswa AS CHAR)");

        Schema::table('smb', function (Blueprint $table) {
            $table->dropColumn('jumlah_siswa');
        });

        Schema::table('smb', function (Blueprint $table) {
            $table->renameColumn('jumlah_siswa_old', 'jumlah_siswa');
        });
    }
};
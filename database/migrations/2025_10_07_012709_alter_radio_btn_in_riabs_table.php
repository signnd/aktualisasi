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
            DB::statement("ALTER TABLE riab MODIFY status ENUM('Disetujui', 'Ditolak', 'Pending') NULL");
            DB::statement("ALTER TABLE riab MODIFY kondisi ENUM('Sangat Baik', 'Baik', 'Rusak Ringan', 'Rusak Sedang', 'Rusak Berat') NULL");
            DB::statement("ALTER TABLE riab MODIFY eksisting ENUM('Aktif', 'Tidak Aktif') NULL");
            DB::statement("ALTER TABLE riab MODIFY status_verifikasi ENUM('TRUE', 'FALSE') NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riab', function (Blueprint $table) {
            DB::statement("ALTER TABLE riab MODIFY status ENUM('disetujui', 'tidak_disetujui') NULL");
            DB::statement("ALTER TABLE riab MODIFY kondisi ENUM('sangat_baik','baik','rusak_ringan','rusak_sedang','rusak_berat') NULL");
            DB::statement("ALTER TABLE riab MODIFY eksisting VARCHAR NULL");
            DB::statement("ALTER TABLE riab MODIFY status_verifikasi ENUM('sudah', 'belum') NULL");
        });
    }
};

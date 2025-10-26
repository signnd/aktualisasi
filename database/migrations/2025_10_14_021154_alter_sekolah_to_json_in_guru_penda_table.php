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
        Schema::table('guru_penda', function (Blueprint $table) {
            // Hapus kolom lama jika sudah ada (tipe string)
            // $table->dropColumn('nama_sekolah_1','nama_sekolah_2','nama_sekolah_3','nama_sekolah_4',
            //     'alamat_sekolah_1','alamat_sekolah_2','alamat_sekolah_3','alamat_sekolah_4');
        });

        Schema::table('guru_penda', function (Blueprint $table) {
            $table->json('nama_sekolah_sd')->nullable()->after('email')->change();
            $table->json('nama_sekolah_smp')->nullable()->change();
            $table->json('nama_sekolah_sma')->nullable()->change();
            $table->json('alamat_sekolah_sd')->nullable()->change();
            $table->json('alamat_sekolah_smp')->nullable()->change();
            $table->json('alamat_sekolah_sma')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru_penda', function (Blueprint $table) {
            $table->dropColumn('nama_sekolah_sd','nama_sekolah_smp','nama_sekolah_sma',
            'alamat_sekolah_sd','alamat_sekolah_smp','alamat_sekolah_sma');
        });

        Schema::table('guru_penda', function (Blueprint $table) {
            // Kembalikan menjadi string jika rollback
            $table->string('nama_sekolah_1')->nullable()->after('email');
            $table->string('nama_sekolah_2')->nullable();
            $table->string('nama_sekolah_3')->nullable();
            $table->string('nama_sekolah_4')->nullable();
            $table->string('alamat_sekolah_1')->nullable();
            $table->string('alamat_sekolah_2')->nullable();
            $table->string('alamat_sekolah_3')->nullable();
            $table->string('alamat_sekolah_4')->nullable();
        });
    }
};

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
        Schema::table('riab_details', function (Blueprint $table) {
            $table->string('lift')->nullable()->after('fasilitas_jalur_kursi_roda');
            $table->string('tempat_duduk_lansia')->nullable()->after('lcd_proyektor');
            $table->json('jenis_kitab_suci')->nullable()->after('ruang_laktasi');
            $table->string('link_berita_acara_nonaktif')->nullable()->after('foto_setelah_bantuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riab_details', function (Blueprint $table) {
            $table->dropColumn([
                'lift',
                'tempat_duduk_lansia',
                'jenis_kitab_suci',
                'link_berita_acara_nonaktif',
            ]);

        });
    }
};

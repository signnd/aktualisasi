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
            $table->string('th_menerima_sertifikasi')->nullable()->change();
            $table->string('th_menerima_rehabilitasi')->nullable()->change();
            $table->string('th_menerima_bersih_sehat')->nullable()->change();
            $table->string('th_menerima_kek')->nullable()->change();
            $table->string('th_menerima_bantuan_bangun')->nullable()->change();
            $table->string('th_menerima_bpriab_perpus')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riab_details', function (Blueprint $table) {
            //
        });
    }
};

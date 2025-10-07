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
            $table->json('kondisi_geografis')->nullable()->change();
            $table->json('peta_rawan_bencana')->nullable()->change();
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

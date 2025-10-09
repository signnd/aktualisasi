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
        Schema::table('majelis', function (Blueprint $table) {
            $table->foreignId('kabupaten_id')->nullable()->change();
            $table->foreignId('kecamatan_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            $table->foreignId('kabupaten_id')->nullable(false)->change();
            $table->foreignId('kecamatan_id')->nullable(false)->change();
    }
};

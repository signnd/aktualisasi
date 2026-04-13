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
        // For 'riab'
        Schema::table('riab', function (Blueprint $table) {
            $table->string('status_verifikasi')->default('pending')->change();
        });

        // For 'okb'
        Schema::table('okb', function (Blueprint $table) {
            $table->string('status_verifikasi')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riab', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['sudah','belum'])->nullable()->change();
        });

        Schema::table('okb', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['TRUE','FALSE'])->nullable()->change();
        });
    }
};

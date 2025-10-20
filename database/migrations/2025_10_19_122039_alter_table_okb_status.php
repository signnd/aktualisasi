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
        Schema::table('okb', function (Blueprint $table) {
            $table->enum('status', ['Disetujui','Ditolak','Pending'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('okb', function (Blueprint $table) {
            $table->enum('status', ['disetujui','tidak_disetujui','pending'])->nullable()->change();
        });
    }
};

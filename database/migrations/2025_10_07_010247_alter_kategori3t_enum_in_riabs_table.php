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
            DB::statement("ALTER TABLE riab MODIFY kategori_3t ENUM('3T', 'Non 3T') NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riab', function (Blueprint $table) {
            DB::statement("ALTER TABLE riab MODIFY kategori_3t ENUM('ya', 'tidak') NULL");
        });
    }
};

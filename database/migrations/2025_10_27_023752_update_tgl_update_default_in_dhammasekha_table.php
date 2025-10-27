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
    // Untuk MySQL
        DB::statement('ALTER TABLE dhammasekha MODIFY tgl_update DATE DEFAULT (CURRENT_DATE)');
        DB::statement('ALTER TABLE siswa_dhammasekha MODIFY tgl_update DATE DEFAULT (CURRENT_DATE)');
    }

    public function down()
    {
        Schema::table('dhammasekha', function (Blueprint $table) {
            $table->date('tgl_update')->nullable()->change();
        });
        
        Schema::table('siswa_dhammasekha', function (Blueprint $table) {
            $table->date('tgl_update')->nullable()->change();
        });
    }
};

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
        Schema::table('pusdiklat', function (Blueprint $table) {
            $table->year('th_izop')->nullable()->change();
            $table->string('masa_izop')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pusdiklat', function (Blueprint $table) {
            //
        });
    }
};

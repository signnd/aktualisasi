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
        Schema::table('smb', function (Blueprint $table) {
            $table->decimal('latitude',30,15)->nullable()->after('alamat_bapen');
            $table->decimal('longitude',30,15)->nullable()->after('latitude');
        });

        Schema::table('dhammasekha', function (Blueprint $table) {
            $table->decimal('latitude',30,15)->nullable()->after('alamat');
            $table->decimal('longitude',30,15)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('smb', function (Blueprint $table) {
            $table->dropColumn(['latitude','longitude']);
        });
        
        Schema::table('dhammasekha', function (Blueprint $table) {
            $table->dropColumn(['latitude','longitude']);
        });
    }
};

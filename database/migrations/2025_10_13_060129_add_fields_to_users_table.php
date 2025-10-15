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
        Schema::table('users', function (Blueprint $table) {
            $table->string('satuan_kerja')->nullable()->after('email');

            // relasi ke tabel kabupaten
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupaten')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('user_role', ['admin', 'user'])
                ->default('user')
                ->after('kabupaten_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kabupaten_id']);
            $table->dropColumn(['satuan_kerja', 'kabupaten_id', 'user_role']);
        });
    }
};

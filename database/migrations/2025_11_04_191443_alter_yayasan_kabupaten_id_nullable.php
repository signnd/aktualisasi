<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // drop existing foreign key first
        Schema::table('yayasan_buddha', function (Blueprint $table) {
            // drop by column name (will fail if not exists)
            $table->dropForeign(['kecamatan_id']);
        });

        // change column type to match referenced id and make it nullable
        DB::statement('ALTER TABLE `yayasan_buddha` MODIFY `kecamatan_id` BIGINT UNSIGNED NULL;');

        // re-create foreign key with ON DELETE SET NULL
        Schema::table('yayasan_buddha', function (Blueprint $table) {
            $table->foreign('kecamatan_id')
                  ->references('id')->on('kecamatan')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('yayasan_buddha', function (Blueprint $table) {
            $table->dropForeign(['kecamatan_id']);
        });

        // revert to NOT NULL (adjust if original behavior different)
        DB::statement('ALTER TABLE `yayasan_buddha` MODIFY `kecamatan_id` BIGINT UNSIGNED NOT NULL;');

        Schema::table('yayasan_buddha', function (Blueprint $table) {
            $table->foreign('kecamatan_id')
                  ->references('id')->on('kecamatan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }
};
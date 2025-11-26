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
        // Drop unique index on no_registrasi if it exists, then make the column nullable.
        // We use raw statements to avoid requiring doctrine/dbal for ->change().
        // This approach is safe and preserves other column attributes (VARCHAR(255)).
        $index = DB::selectOne(
            "SELECT INDEX_NAME
             FROM information_schema.statistics
             WHERE table_schema = DATABASE()
               AND table_name = 'riab'
               AND column_name = 'no_registrasi'
               AND NON_UNIQUE = 0
             LIMIT 1"
        );

        if ($index && isset($index->INDEX_NAME)) {
            DB::statement('ALTER TABLE `riab` DROP INDEX `' . $index->INDEX_NAME . '`');
        }

        DB::statement('ALTER TABLE `riab` MODIFY `no_registrasi` VARCHAR(255) NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-create previous NOT NULL + UNIQUE state.
        DB::statement('ALTER TABLE `riab` MODIFY `no_registrasi` VARCHAR(255) NOT NULL;');

        // Re-create unique index (use conventional Laravel name if none found previously)
        // If an index with the conventional name already exists, creation will fail — adjust if needed.
        Schema::table('riab', function (Blueprint $table) {
            $table->unique('no_registrasi');
        });
    }
};

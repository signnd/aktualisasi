<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Step 1: Update data yang null atau kosong menjadi 0
        DB::table('smb')
            ->whereNull('jumlah_siswa')
            ->orWhere('jumlah_siswa', '')
            ->update(['jumlah_siswa' => 0]);

        // Step 2: Update data yang berisi string non-numeric menjadi 0
        DB::statement("UPDATE smb SET jml_siswa = 0 WHERE jumlah_siswa REGEXP '[^0-9]'");

        // Step 3: Ubah tipe kolom menjadi integer
        Schema::table('smb', function (Blueprint $table) {
            $table->integer('jml_siswa')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('smb', function (Blueprint $table) {
            $table->string('jml_siswa', 100)->nullable()->change();
        });
    }
};
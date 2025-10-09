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
        Schema::create('yayasan_buddha', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabupaten_id')->constrained('kabupaten');
            $table->foreignId('kecamatan_id')->constrained('kecamatan');
            $table->string('nama_yayasan');
            $table->string('ketua')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tgl_terdaftar')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yayasan_buddha');
    }
};

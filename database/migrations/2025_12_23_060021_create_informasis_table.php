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
        Schema::create('informasi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul')->nullable();
            $table->string('ringkasan')->nullable();
            $table->enum('kategori', ['Informasi Publik', 'Informasi Internal', 'Informasi Lainnya'])->nullable();
            $table->string('foto')->nullable();
            $table->text('teks')->nullable();
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi');
    }
};

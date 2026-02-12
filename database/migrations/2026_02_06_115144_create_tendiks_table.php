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
        Schema::create('tendik', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupaten')->nullOnDelete();
            $table->string('nama_tendik');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan'])->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('nama_lembaga')->nullable();
            $table->nullableMorphs('lembaga');
            $table->string('tmt_pendidik')->nullable();
            $table->string('satker')->nullable();
            $table->string('yang_mengangkat')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('program_studi')->nullable();
            $table->enum('menerima_insentif', ['Ya','Tidak'])->nullable();
            $table->enum('menerima_tpg', ['Ya','Tidak'])->nullable();
            $table->string('link_sk')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->string('foto')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tgl_update')->nullable();
            $table->enum('status_verifikasi', ['TRUE','FALSE'])->nullable();
            $table->foreignId('user_id')->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tendik');
    }
};

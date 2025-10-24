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
        Schema::table('siswa_dhammasekha', function (Blueprint $table) {
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupaten')->nullOnDelete()->after('id');
            $table->foreignId('dhammasekha_id')->constrained('smb')->cascadeOnDelete()->after('kabupaten_id');
            $table->string('nama_siswa')->nullable()->after('dhammasekha_id');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan'])->nullable()->after('nama_siswa');
            $table->string('agama')->nullable()->after('jenis_kelamin');
            $table->string('nik')->nullable()->after('agama');
            $table->string('tempat_lahir')->nullable()->after('nik');
            $table->date('tgl_lahir')->nullable()->after('tempat_lahir');
            $table->string('nisn')->nullable()->after('tgl_lahir');
            $table->string('tahun_ajaran')->nullable()->after('nisn');
            $table->string('alamat')->nullable()->after('tahun_ajaran');
            $table->string('nama_ibu')->nullable()->after('alamat');
            $table->string('nama_ayah')->nullable()->after('nama_ibu');
            $table->string('no_hp', 100)->nullable()->after('nama_ayah');
            $table->string('email')->nullable()->after('no_hp');
            $table->string('pendidikan')->nullable()->after('email');
            $table->string('kelas')->nullable()->after('pendidikan');
            $table->string('keterangan')->nullable()->after('kelas');
            $table->date('tgl_update')->nullable()->after('keterangan');
            $table->enum('status_verifikasi', ['TRUE','FALSE'])->nullable()->after('tgl_update');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa_dhammasekha', function (Blueprint $table) {
            $table->dropColumn(['kabupaten_id','dhammasekha_id','nama_siswa','jenis_kelamin','agama','nik',
                                'tempat_lahir','tgl_lahir', 'nisn','tahun_ajaran','alamat','nama_ibu','nama_ayah',
                                'no_hp','email','pendidikan','kelas','keterangan','tgl_update','status_verifikasi']);
        });
    }
};

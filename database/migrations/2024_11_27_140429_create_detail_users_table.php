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
        Schema::create('detail_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->string('nama')->nullable(); // Menambahkan kolom nama
            $table->string('nik')->unique()->nullable(); // NIK (Nomor Induk Kependudukan)
            $table->string('alamat')->nullable(); // Alamat Lengkap
            $table->string('instagram')->nullable(); // Alamat Lengkap
            $table->string('twiter')->nullable(); // Alamat Lengkap
            $table->string('linkedin')->nullable(); // Alamat Lengkap
            $table->string('no_telepon')->nullable(); // Nomor Telepon
            $table->date('tanggal_lahir')->nullable(); // Tanggal Lahir
            $table->string('tempat_lahir')->nullable(); // Tanggal Lahir
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable(); // Jenis Kelamin
            $table->enum('status', ['belum menikah', 'menikah','bercerai'])->nullable(); // Jenis Kelamin
            $table->enum('pendidikan_terakhir', ['SMA/SMK', 'Mahasiswa','S1','S2','S3'])->nullable(); // Jenis Kelamin
            $table->string('nama_institusi')->nullable(); // Posisi yang Dilamar
            $table->string('jabatan')->nullable(); // Posisi yang Dilamar
            $table->string('jurusan')->nullable(); // Posisi yang Dilamar
            $table->date('tahun_lulus')->nullable(); // Posisi yang Dilamar
            $table->string('divisi')->nullable(); // Posisi yang Dilamar

            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_users');
    }
};

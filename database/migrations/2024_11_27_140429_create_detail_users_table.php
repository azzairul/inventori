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
            $table->string('nik')->unique()->nullable(); // NIK (Nomor Induk Kependudukan)
            $table->string('alamat')->nullable(); // Alamat Lengkap
            $table->string('no_telepon')->nullable(); // Nomor Telepon
            $table->date('tanggal_lahir')->nullable(); // Tanggal Lahir
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable(); // Jenis Kelamin
            $table->text('riwayat_pendidikan')->nullable(); // Riwayat Pendidikan
            $table->string('posisi_dilamar')->nullable(); // Posisi yang Dilamar
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

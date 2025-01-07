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
        Schema::create('riwayat_pengembalian', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->time('jam_peminjaman');
            $table->string('nama_peminjam');
            $table->text('alasan_peminjaman')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_peminjaman_admin'); 
    }
};

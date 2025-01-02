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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('stok');
            $table->string('lokasi');
            $table->enum('status', ['tersedia', 'tidak tersedia'])->nullable(); // Jenis Kelamin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

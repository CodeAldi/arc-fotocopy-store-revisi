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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_barang_id')->constrained('kategori_barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('namaBarang');
            $table->string('gambar');
            $table->string('deskripsi')->nullable();
            $table->integer('jumlah');
            $table->float('hargaBarang',13,3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

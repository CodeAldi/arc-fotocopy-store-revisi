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
        Schema::table('keranjang', function (Blueprint $table) {
            // tambah kolom
            $table->unsignedBigInteger('barang_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('jasa_id')->nullable()->after('barang_id');
            // tambah foreign key
            $table->foreign('barang_id')->references('id')->on('barang')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jasa_id')->references('id')->on('jasa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keranjang', function (Blueprint $table) {
            // foreign key barang
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['barang_id']);
            // Kemudian hapus kolomnya
            $table->dropColumn('barang_id');
            //foreign key jasa
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['jasa_id']);
            // Kemudian hapus kolomnya
            $table->dropColumn('jasa_id');
        });
    }
};

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
        Schema::create('order_jasa_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('order')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('jasa_id')->constrained('jasa')->onUpdate('cascade')->onDelete('cascade');
            $table->string('file');
            $table->string('catatan')->nullable();
            $table->integer('jumlah_halaman');
            $table->integer('jumlah_rangkap');
            $table->boolean('jilid_plastik')->default(false);
            $table->boolean('jepit_besi')->default(false);
            $table->boolean('hekter')->default(false);
            $table->boolean('none')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_jasa_details');
    }
};

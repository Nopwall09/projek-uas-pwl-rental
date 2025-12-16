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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id('mobil_id');

            // columns foreign keys
            $table->unsignedBigInteger('merk_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('seat_id');
            
            // other columns
            $table->string('nama_mobil');
            $table->string('fasilitas');
            $table->string('feedback')->nullable();
            $table->string('mobil_image')->nullable();
            $table->enum('Transmisi', ['Manual', 'Matic']);
            $table->string('mobil_warna', 50);
            $table->enum('mobil_status',['Tersedia','Disewa'])->default('Tersedia');
            $table->string('mobil_plat', 30);
            $table->string('mobil_tahun', 4);
            $table->decimal('harga_rental', 10, 2);

            // relation
            $table->foreign('seat_id')->references('seat_id')->on('seat')->onDelete('cascade');
            $table->foreign('merk_id')->references('merk_id')->on('merk')->onDelete('cascade');
            $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};

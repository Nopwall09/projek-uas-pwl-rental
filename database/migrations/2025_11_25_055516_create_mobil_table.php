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
            $table->string('mobil_id', 3)->primary();
            
            // columns foreign keys
            $table->string('merk_id', 3);
            $table->string('status_id', 2);
            $table->string('class_id', 3);
            $table->string('tipe_id', 3);
            $table->string('transmisi_id', 2);
            
            //relation
            $table->foreign('merk_id')->references('merk_id')->on('merk')->onDelete('cascade');
            $table->foreign('status_id')->references('status_id')->on('status')->onDelete('cascade');
            $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
            $table->foreign('tipe_id')->references('tipe_id')->on('tipe')->onDelete('cascade');
            $table->foreign('transmisi_id')->references('transmisi_id')->on('transmisi')->onDelete('cascade');
            
            
            $table->string('mobil_warna', 50);
            $table->string('mobil_plat', 30);
            $table->string('mobil_tahun', 4);
            $table->decimal('harga_rental', 10, 2);
            $table->timestamps();
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

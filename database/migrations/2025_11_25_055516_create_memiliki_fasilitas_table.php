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
        Schema::create('memiliki_fasilitas', function (Blueprint $table) {
            $table->string('fasilitas_id', 3);
            $table->string('mobil_id', 3);

            //relasi
            $table->foreign('fasilitas_id')->references('fasilitas_id')->on('fasilitas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mobil_id')->references('mobil_id')->on('mobil')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memiliki_fasilitas');
    }
};

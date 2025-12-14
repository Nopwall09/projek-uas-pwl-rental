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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('merk_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('tipe_id');
            $table->unsignedBigInteger('feedback_id')->nullable();
            
            // other columns
            $table->string('mobil_image')->nullable();
            $table->enum('Transmisi', ['Manual', 'Matic']);
            $table->string('mobil_warna', 50);
<<<<<<< HEAD
            $table->enum('mobil_status', ['Tersedia', 'Disewa']);
=======
            $table->enum('mobil_status',['Tersedia','Disewa']);
>>>>>>> eb8564657eb4ce192c312e592ce06102f9e66a14
            $table->string('mobil_plat', 30);
            $table->string('mobil_tahun', 4);
            $table->decimal('harga_rental', 10, 2);

            // relation
            $table->foreign('merk_id')->references('merk_id')->on('merk')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('feedback_id')->references('feedback_id')->on('feedback')->onDelete('cascade');
            $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
            $table->foreign('tipe_id')->references('tipe_id')->on('tipe')->onDelete('cascade');
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

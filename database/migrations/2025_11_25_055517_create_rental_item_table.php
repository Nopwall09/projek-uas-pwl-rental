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
        Schema::create('rental_item', function (Blueprint $table) {
            // Primary Key
            $table->id('rental_id');

            // Foreign Keys
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('mobil_id');
            $table->unsignedBigInteger('driver_id')->nullable();

            // base columns
            $table->string('nama_Pelanggan', 100)->nullable();
            $table->string('lama_rental', 25);
            $table->string('pilihan', 30);
            $table->date('tgl_sewa');
            $table->date('tgl_kembali');
            $table->decimal('total_sewa', 10, 2);
            $table->enum('booking_source', ['online', 'offline'])->default('offline');
            $table->string('jaminan', 30);

            //relasi
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('mobil_id')->references('mobil_id')->on('mobil')->onDelete('cascade');
            $table->foreign('driver_id')->references('driver_id')->on('driver')->onDelete('cascade');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_item');
    }
};

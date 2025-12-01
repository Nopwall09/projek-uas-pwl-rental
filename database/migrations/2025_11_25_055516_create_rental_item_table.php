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
            $table->string('rental_item_id', 5)->primary();

            // Foreign Keys
            $table->string('users_id', 5);
            $table->string('mobil_id', 4);
            $table->string('driver_id', 5);

            // base columns
            $table->string('lama_rental', 25);
            $table->string('pilihan', 30);
            $table->date('tgl');
            $table->decimal('total_sewa', 10, 2);
            $table->string('booking_source', 20);
            $table->string('jaminan', 30);

            //relasi
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
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

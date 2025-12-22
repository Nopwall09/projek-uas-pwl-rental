<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_item', function (Blueprint $table) {

            // Primary Key
            $table->id('rental_id');

            // Relasi
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('mobil_id');
            $table->unsignedBigInteger('driver_id')->nullable();

            // Data pelanggan
            $table->string('nama_pelanggan', 100)->nullable();

            // Data sewa
            $table->integer('lama_rental');
            $table->enum('pilihan', ['dengan driver', 'tanpa driver']);
            $table->date('tgl_sewa');
            $table->date('tgl_kembali');
            $table->decimal('total_sewa', 12, 2);

            // Booking & pembayaran
            $table->enum('booking_source', ['online', 'offline'])->default('offline');
            $table->enum('status', [
                'pending',     // transfer belum dikonfirmasi
                'aktif',       // sedang disewa
                'selesai',     // sudah selesai
                'dibatalkan'   // dibatalkan
            ])->default('pending');

            // Jaminan
            $table->string('jaminan', 30)->nullable();

            // Foreign key
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->nullOnDelete();

            $table->foreign('mobil_id')
                ->references('mobil_id')->on('mobil')
                ->cascadeOnDelete();

            $table->foreign('driver_id')
                ->references('driver_id')->on('driver')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_item');
    }
};


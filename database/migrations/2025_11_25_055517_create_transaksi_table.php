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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');

            // Foreign Keys
            $table->unsignedBigInteger('method_id');
            $table->unsignedBigInteger('rental_id');

            // base table
            $table->date ('tanggal_transaksi');
            $table->string('status_id', 15);
            $table->integer('total_bayar');

            // relasi
            $table->foreign('method_id')->references('method_id')->on('method_pembayaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rental_id')->references('rental_id')->on('rental_item')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

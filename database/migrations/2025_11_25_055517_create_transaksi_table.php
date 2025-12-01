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
            $table->string('transaksi_id', 5)->primary();
            $table->string('method_id', 2);
            $table->string('rental_item', 5);

            // base table
            $table->date ('tanggal_transaksi');
            $table->string('status_id', 15);
            $table->integer('total_bayar');

            // relasi
            $table->foreign('method_id')->references('method_id')->on('method_pembayaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rental_item')->references('rental_item')->on('rental_item')->onDelete('cascade')->onUpdate('cascade');

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

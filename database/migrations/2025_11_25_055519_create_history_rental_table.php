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
        Schema::create('history_rental', function (Blueprint $table) {

        // Primary Key
        $table->string('history_id', 8)->primary();

        // Foreign Keys
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('rental_id');

        // Other Columns
        $table->string('aksi', 150);
        $table->string('status_book', 45);
        $table->timestamp('waktu');

        // Relations
        $table->foreign('user_id')
            ->references('user_id')->on('users')
            ->onDelete('cascade');

        $table->foreign('rental_id')
            ->references('rental_id')->on('rental_item')
            ->onDelete('cascade');

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_rental');
    }
};

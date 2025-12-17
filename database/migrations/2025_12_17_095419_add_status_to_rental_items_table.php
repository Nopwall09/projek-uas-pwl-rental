<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rental_item', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'selesai'])
                  ->default('aktif')
                  ->after('booking_source');

            $table->dateTime('selesai_at')
                  ->nullable()
                  ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('rental_item', function (Blueprint $table) {
            $table->dropColumn(['status', 'selesai_at']);
        });
    }
};

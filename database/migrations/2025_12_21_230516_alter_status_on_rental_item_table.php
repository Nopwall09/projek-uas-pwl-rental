<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL tidak bisa alter enum pakai Blueprint → pakai raw SQL
        DB::statement("
            ALTER TABLE rental_item
            MODIFY status 
            ENUM('aktif','pending','selesai','dibatalkan')
            NOT NULL
            DEFAULT 'aktif'
        ");
    }

    public function down(): void
    {
        // rollback ke kondisi awal
        DB::statement("
            ALTER TABLE rental_item
            MODIFY status 
            ENUM('aktif','selesai')
            NOT NULL
            DEFAULT 'aktif'
        ");
    }
};

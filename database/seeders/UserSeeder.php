<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
    ['username' => 'admin'],
    [
        'name' => 'Administrator',
        'role' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('admin123'),
        'updated_at' => now(),
        'created_at' => now(),
    ]
    );

    DB::table('users')->updateOrInsert(
        ['username' => 'user'],
        [
            'name' => 'User Biasa',
            'role' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );

    DB::table('users')->updateOrInsert(
        ['username' => 'kasir'],
        [
            'name' => 'Kasir',
            'role' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir123'),
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );

    DB::table('users')->updateOrInsert(
        ['username' => 'user2'],
        [
            'name' => 'User Biasa2',
            'role' => 'user',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('user123'),
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );


    }
}

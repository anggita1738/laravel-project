<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@magang.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create guest user
        DB::table('users')->insert([
            'name' => 'Guest User',
            'email' => 'guest@magang.com',
            'role' => 'guest',
            'password' => Hash::make('guest123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}


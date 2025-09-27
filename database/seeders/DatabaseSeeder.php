<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Jangan lupa tambahkan ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Langsung buat user admin di sini
        User::create([
            'name' => 'Ibu Kos',
            'email' => 'admin@kos.com',
            'password' => Hash::make('password'), // Ganti password sesuai kebutuhan
            'role' => 'admin',
        ]);
    }
}
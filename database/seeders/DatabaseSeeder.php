<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin (hanya jika belum ada)
        if (!User::where('email', 'admin@alumni.ac.id')->exists()) {
            User::create([
                'name'     => 'Admin',
                'email'    => 'admin@alumni.ac.id',
                'password' => Hash::make('password123'),
            ]);
        }
    }
}

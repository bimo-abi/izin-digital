<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@esurat.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'nim' => null,
            'nip' => 'ADM001',
        ]);

        // Dosen
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'dosen@esurat.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'nim' => null,
            'nip' => 'NIP001',
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'mahasiswa@esurat.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '2024001',
            'nip' => null,
        ]);
    }
}

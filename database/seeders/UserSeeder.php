<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@surat.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'nim_nip' => 'ADM001',
        ]);

        // Create Dosen
        User::create([
            'name' => 'Dr. John Doe',
            'email' => 'dosen@surat.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'nim_nip' => 'DSN001',
        ]);

        // Create Mahasiswa
        User::create([
            'name' => 'Mahasiswa Test',
            'email' => 'mhs@surat.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim_nip' => 'MHS2024001',
        ]);
    }
}

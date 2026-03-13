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
            'program_studi' => null,
            'golongan' => 'III/d',
        ]);

        // Dosen
        User::create([
            'name' => 'Budi Santoso, M.Kom',
            'email' => 'dosen@esurat.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'nim' => null,
            'nip' => 'NIP001',
            'program_studi' => 'Teknik Informatika',
            'golongan' => 'Lektor Kepala',
        ]);

        // Mahasiswa 1
        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'mahasiswa@esurat.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => 'E41250904',
            'nip' => null,
            'program_studi' => 'Teknik Informatika',
            'golongan' => null,
        ]);

        // Mahasiswa 2
        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'mahasiswa2@esurat.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => 'E41250905',  
            'nip' => null,
            'program_studi' => 'Sistem Informasi',
            'golongan' => null,
        ]);
    }
}

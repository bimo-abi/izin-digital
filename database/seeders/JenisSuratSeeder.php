<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_surat' => 'Surat Izin Sakit',
                'kode_surat' => 'SIS-001',
                'template_path' => 'templates/izin_sakit.blade.php',
            ],
            [
                'nama_surat' => 'Surat Izin Kegiatan Kampus',
                'kode_surat' => 'SIKK-002',
                'template_path' => 'templates/izin_kampus.blade.php',
            ],
            [
                'nama_surat' => 'Surat Izin Kegiatan',
                'kode_surat' => 'SIK-003',
                'template_path' => 'templates/izin_umum.blade.php',
            ],
        ];

        foreach ($data as $item) {
            JenisSurat::create($item);
        }
    }
}

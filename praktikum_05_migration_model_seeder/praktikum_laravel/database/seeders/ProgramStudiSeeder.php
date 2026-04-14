<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programStudis = [
            [
                'kode_prodi' => 'SI',
                'nama_prodi' => 'Sistem Informasi',
            ],
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Informatika',
            ],
            [
                'kode_prodi' => 'MNJ',
                'nama_prodi' => 'Manajemen',
            ],
            [
                'kode_prodi' => 'AKT',
                'nama_prodi' => 'Akuntansi',
            ],
            [
                'kode_prodi' => 'PSI',
                'nama_prodi' => 'Psikologi',
            ],
            [
                'kode_prodi' => 'IKOM',
                'nama_prodi' => 'Ilmu Komunikasi',
            ],
        ];

        foreach ($programStudis as $prodi) {
            ProgramStudi::create($prodi);
        }
    }
}

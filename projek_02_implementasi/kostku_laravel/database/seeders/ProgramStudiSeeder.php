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
                'fakultas' => 'fakultas teknologi informasi dan komunikasi',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Informatika',
                'fakultas' => 'fakultas teknologi informasi dan komunikasi',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'MNJ',
                'nama_prodi' => 'Manajemen',
                'fakultas' => 'fakultas ekonomi dan bisnis',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'AKT',
                'nama_prodi' => 'Akuntansi',
                'fakultas' => 'fakultas ekonomi dan bisnis',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'PSI',
                'nama_prodi' => 'Psikologi',
                'fakultas' => 'fakultas psikologi',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'IKOM',
                'nama_prodi' => 'Ilmu Komunikasi',
                'fakultas' => 'fakultas teknologi informasi dan komunikasi',
                'jenjang' => 'S1',
            ],
        ];

        foreach ($programStudis as $prodi) {
            ProgramStudi::create($prodi);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID program studi
        $si = ProgramStudi::where('kode_prodi', 'SI')->first()->id;
        $ti = ProgramStudi::where('kode_prodi', 'TI')->first()->id;
        $mnj = ProgramStudi::where('kode_prodi', 'MNJ')->first()->id;
        $akt = ProgramStudi::where('kode_prodi', 'AKT')->first()->id;
        $psi = ProgramStudi::where('kode_prodi', 'PSI')->first()->id;
        $ikom = ProgramStudi::where('kode_prodi', 'IKOM')->first()->id;

        $mahasiswas = [
            [
                'nim' => '20240001',
                'nama' => 'Fajar Santoso',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2003-08-02',
                'jenis_kelamin' => 'P',
                'prodi_id' => $mnj,
            ],
            [
                'nim' => '20240002',
                'nama' => 'Lani Utami',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2003-03-11',
                'jenis_kelamin' => 'L',
                'prodi_id' => $mnj,
            ],
            [
                'nim' => '20240003',
                'nama' => 'Agus Wijaya',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2001-01-28',
                'jenis_kelamin' => 'L',
                'prodi_id' => $ikom,
            ],
            [
                'nim' => '20240004',
                'nama' => 'Rian Utami',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2000-04-10',
                'jenis_kelamin' => 'L',
                'prodi_id' => $psi,
            ],
            [
                'nim' => '20240005',
                'nama' => 'Budi Wulandari',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '2002-11-21',
                'jenis_kelamin' => 'L',
                'prodi_id' => $akt,
            ],
            [
                'nim' => 'G.131.24.0001',
                'nama' => 'KURNIAWAN',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '2005-01-15',
                'jenis_kelamin' => 'L',
                'prodi_id' => $si,
            ],
            [
                'nim' => 'G.131.24.0002',
                'nama' => 'SITI NURHALIZA',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '2004-05-20',
                'jenis_kelamin' => 'P',
                'prodi_id' => $si,
            ],
            [
                'nim' => 'G.131.24.0003',
                'nama' => 'AHMAD FAUZI',
                'tempat_lahir' => 'Solo',
                'tanggal_lahir' => '2003-11-10',
                'jenis_kelamin' => 'L',
                'prodi_id' => $ti,
            ],
            [
                'nim' => 'G.131.24.0004',
                'nama' => 'DEWI LESTARI',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2004-08-15',
                'jenis_kelamin' => 'P',
                'prodi_id' => $ti,
            ],
            [
                'nim' => 'G.131.24.0005',
                'nama' => 'RIZKI RAMADHAN',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2003-12-25',
                'jenis_kelamin' => 'L',
                'prodi_id' => $si,
            ],
        ];

        foreach ($mahasiswas as $mhs) {
            Mahasiswa::create($mhs);
        }
    }
}

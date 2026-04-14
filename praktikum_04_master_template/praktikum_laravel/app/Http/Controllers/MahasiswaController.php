<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data mahasiswa dummy (minimal 5 data)
        $mahasiswa = [
            [
                'nim' => '20240001',
                'nama' => 'Fajar Santoso',
                'tempat_lahir' => 'Yogyakarta',
                'tgl_lahir' => '2003-08-02',
                'jenis_kelamin' => 'Perempuan',
                'prodi' => 'Manajemen'
            ],
            [
                'nim' => '20240002',
                'nama' => 'Lani Utami',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '2003-03-11',
                'jenis_kelamin' => 'Laki-laki',
                'prodi' => 'Manajemen'
            ],
            [
                'nim' => '20240003',
                'nama' => 'Agus Wijaya',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '2001-01-28',
                'jenis_kelamin' => 'Laki-laki',
                'prodi' => 'Ilmu Komunikasi'
            ],
            [
                'nim' => '20240004',
                'nama' => 'Rian Utami',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2000-04-10',
                'jenis_kelamin' => 'Laki-laki',
                'prodi' => 'Psikologi'
            ],
            [
                'nim' => '20240005',
                'nama' => 'Budi Wulandari',
                'tempat_lahir' => 'Medan',
                'tgl_lahir' => '2002-11-21',
                'jenis_kelamin' => 'Laki-laki',
                'prodi' => 'Akuntansi'
            ]
        ];

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Menampilkan mahasiswa dengan ID: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

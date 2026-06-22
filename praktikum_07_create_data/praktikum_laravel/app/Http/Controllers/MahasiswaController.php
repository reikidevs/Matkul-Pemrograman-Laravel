<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa
     */
    public function index()
    {
        // Memanggil view mahasiswa dan mengirim data mahasiswa ke view tersebut
        $data['master'] = array('title' => 'Daftar Mahasiswa');
        $data['mahasiswa'] = Mahasiswa::with('prodi')->latest()->get();

        return view('mahasiswa.index', $data);
    }

    /**
     * Menampilkan form untuk menambah mahasiswa baru
     */
    public function create()
    {
        // Ambil semua data program studi untuk dropdown
        $data['master'] = array('title' => 'Tambah Mahasiswa');
        $data['prodi'] = ProgramStudi::orderBy('nama_prodi')->get();

        return view('mahasiswa.create', $data);
    }

    /**
     * Menyimpan data mahasiswa baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nim'           => 'required|string|max:20|unique:mahasiswas,nim',
            'nama'          => 'required|string|max:100',
            'tempat_lahir'  => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'prodi_id'      => 'required|exists:program_studis,id',
        ], [
            'nim.required'           => 'NIM wajib diisi',
            'nim.unique'             => 'NIM sudah terdaftar',
            'nama.required'          => 'Nama wajib diisi',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid',
            'prodi_id.required'      => 'Program studi wajib dipilih',
            'prodi_id.exists'        => 'Program studi tidak ditemukan',
        ]);

        // Coba simpan data ke database
        try {
            Mahasiswa::create($validated);

            // Redirect dengan notifikasi sukses
            return redirect()
                ->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            // Redirect kembali dengan notifikasi gagal
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data mahasiswa gagal ditambahkan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail mahasiswa
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

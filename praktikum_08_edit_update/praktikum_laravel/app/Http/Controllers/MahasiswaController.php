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
        $data['master'] = array('title' => 'Daftar Mahasiswa');
        $data['mahasiswa'] = Mahasiswa::with('prodi')->latest()->get();

        return view('mahasiswa.index', $data);
    }

    /**
     * Menampilkan form untuk menambah mahasiswa baru
     */
    public function create()
    {
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

        try {
            Mahasiswa::create($validated);

            return redirect()
                ->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
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
     * Menampilkan form untuk mengedit data mahasiswa
     * Menggunakan Route Model Binding (Mahasiswa $mahasiswa)
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        // Ambil semua data program studi untuk dropdown
        $data['master'] = array('title' => 'Edit Mahasiswa');
        $data['mahasiswa'] = $mahasiswa;
        $data['prodi'] = ProgramStudi::orderBy('nama_prodi')->get();

        return view('mahasiswa.edit', $data);
    }

    /**
     * Mengupdate data mahasiswa di database
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validasi input dari form
        // NIM unique kecuali untuk record yang sedang diupdate
        $validated = $request->validate([
            'nim'           => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
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

        try {
            $mahasiswa->update($validated);

            return redirect()
                ->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data mahasiswa gagal diupdate: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

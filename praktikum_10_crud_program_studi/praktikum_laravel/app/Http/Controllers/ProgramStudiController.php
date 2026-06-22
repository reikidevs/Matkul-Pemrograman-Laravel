<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;

class ProgramStudiController extends Controller
{
    /**
     * Menampilkan daftar program studi
     */
    public function index()
    {
        $data['master'] = array('title' => 'Daftar Program Studi');
        $data['prodi'] = ProgramStudi::withCount('mahasiswas')->latest()->get();

        return view('prodi.index', $data);
    }

    /**
     * Menampilkan form untuk menambah program studi baru
     */
    public function create()
    {
        $data['master'] = array('title' => 'Tambah Program Studi');

        return view('prodi.create', $data);
    }

    /**
     * Menyimpan data program studi baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studis,kode_prodi',
            'nama_prodi' => 'required|string|max:100',
            'fakultas'   => 'required|string|max:200',
            'jenjang'    => 'required|in:D3,S1,S2,S3',
        ], [
            'kode_prodi.required' => 'Kode program studi wajib diisi',
            'kode_prodi.max'      => 'Kode program studi maksimal 10 karakter',
            'kode_prodi.unique'   => 'Kode program studi sudah terdaftar',
            'nama_prodi.required' => 'Nama program studi wajib diisi',
            'nama_prodi.max'      => 'Nama program studi maksimal 100 karakter',
            'fakultas.required'   => 'Fakultas wajib diisi',
            'fakultas.max'        => 'Fakultas maksimal 200 karakter',
            'jenjang.required'    => 'Jenjang wajib dipilih',
            'jenjang.in'          => 'Jenjang tidak valid',
        ]);

        try {
            ProgramStudi::create($validated);

            return redirect()
                ->route('prodi.index')
                ->with('success', 'Data program studi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data program studi gagal ditambahkan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk mengedit data program studi
     * Menggunakan Route Model Binding (ProgramStudi $prodi)
     */
    public function edit(ProgramStudi $prodi)
    {
        $data['master'] = array('title' => 'Edit Program Studi');
        $data['prodi'] = $prodi;

        return view('prodi.edit', $data);
    }

    /**
     * Mengupdate data program studi di database
     */
    public function update(Request $request, ProgramStudi $prodi)
    {
        // Validasi input dari form
        // Kode prodi unique kecuali untuk record yang sedang diupdate
        $validated = $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studis,kode_prodi,' . $prodi->id,
            'nama_prodi' => 'required|string|max:100',
            'fakultas'   => 'required|string|max:200',
            'jenjang'    => 'required|in:D3,S1,S2,S3',
        ], [
            'kode_prodi.required' => 'Kode program studi wajib diisi',
            'kode_prodi.max'      => 'Kode program studi maksimal 10 karakter',
            'kode_prodi.unique'   => 'Kode program studi sudah terdaftar',
            'nama_prodi.required' => 'Nama program studi wajib diisi',
            'nama_prodi.max'      => 'Nama program studi maksimal 100 karakter',
            'fakultas.required'   => 'Fakultas wajib diisi',
            'fakultas.max'        => 'Fakultas maksimal 200 karakter',
            'jenjang.required'    => 'Jenjang wajib dipilih',
            'jenjang.in'          => 'Jenjang tidak valid',
        ]);

        try {
            $prodi->update($validated);

            return redirect()
                ->route('prodi.index')
                ->with('success', 'Data program studi berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data program studi gagal diupdate: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data program studi dari database
     * Menggunakan Route Model Binding (ProgramStudi $prodi)
     */
    public function destroy(ProgramStudi $prodi)
    {
        try {
            // Cek apakah masih ada mahasiswa yang terkait
            if ($prodi->mahasiswas()->count() > 0) {
                return redirect()
                    ->route('prodi.index')
                    ->with('error', 'Program studi "' . $prodi->nama_prodi . '" tidak dapat dihapus karena masih memiliki ' . $prodi->mahasiswas()->count() . ' mahasiswa terkait');
            }

            // Simpan nama prodi sebelum dihapus untuk notifikasi
            $namaProdi = $prodi->nama_prodi;

            // Hapus data program studi dari database
            $prodi->delete();

            return redirect()
                ->route('prodi.index')
                ->with('success', 'Data program studi "' . $namaProdi . '" berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('prodi.index')
                ->with('error', 'Data program studi gagal dihapus: ' . $e->getMessage());
        }
    }
}

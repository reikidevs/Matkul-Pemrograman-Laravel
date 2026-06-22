<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $data['master'] = array('title' => 'Kelola Kamar');
        $data['kamars'] = Kamar::latest()->get();
        
        return view('kamar.index', $data);
    }

    public function create()
    {
        $data['master'] = array('title' => 'Tambah Kamar');
        return view('kamar.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:10|unique:kamars,nomor_kamar',
            'tipe' => 'required|in:standar,deluxe,vip',
            'luas' => 'required|numeric|min:1',
            'harga_sewa' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,maintenance',
        ]);

        try {
            Kamar::create($validated);
            return redirect()->route('kamar.index')
                ->with('success', 'Kamar berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menambahkan kamar: ' . $e->getMessage());
        }
    }

    public function edit(Kamar $kamar)
    {
        $data['master'] = array('title' => 'Edit Kamar');
        $data['kamar'] = $kamar;
        return view('kamar.edit', $data);
    }

    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:10|unique:kamars,nomor_kamar,' . $kamar->id,
            'tipe' => 'required|in:standar,deluxe,vip',
            'luas' => 'required|numeric|min:1',
            'harga_sewa' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,maintenance',
        ]);

        try {
            $kamar->update($validated);
            return redirect()->route('kamar.index')
                ->with('success', 'Kamar berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal mengupdate kamar: ' . $e->getMessage());
        }
    }

    public function destroy(Kamar $kamar)
    {
        try {
            $kamar->delete();
            return redirect()->route('kamar.index')
                ->with('success', 'Kamar berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kamar.index')
                ->with('error', 'Gagal menghapus kamar: ' . $e->getMessage());
        }
    }

    public function myRoom()
    {
        // Only for penghuni
        if (!auth()->user()->isPenghuni()) {
            abort(403, 'Hanya penghuni yang dapat mengakses halaman ini');
        }

        $penghuni = auth()->user()->penghuni;
        if (!$penghuni) {
            return redirect()->route('dashboard')
                ->with('error', 'Data penghuni tidak ditemukan');
        }

        $penghunian = $penghuni->penghunianAktif;
        if (!$penghunian) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda belum memiliki kamar aktif');
        }

        $data['master'] = array('title' => 'Kamar Saya');
        $data['penghunian'] = $penghunian;
        $data['kamar'] = $penghunian->kamar;
        
        return view('kamar.my-room', $data);
    }
}

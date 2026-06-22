<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komplain;

class KomplainController extends Controller
{
    public function index()
    {
        $data['master'] = array('title' => 'Kelola Komplain');
        
        // Pemilik lihat semua komplain
        if (auth()->user()->isPemilik() || auth()->user()->isAdmin()) {
            $data['komplains'] = Komplain::with('penghuni')->latest()->get();
        } else {
            // Penghuni lihat komplain sendiri
            $penghuni = auth()->user()->penghuni;
            if ($penghuni) {
                $data['komplains'] = Komplain::where('penghuni_id', $penghuni->id)
                    ->latest()
                    ->get();
            } else {
                $data['komplains'] = collect([]);
            }
        }
        
        return view('komplain.index', $data);
    }

    public function create()
    {
        // Only penghuni can create komplain
        if (!auth()->user()->isPenghuni()) {
            abort(403, 'Hanya penghuni yang dapat mengajukan komplain');
        }

        $data['master'] = array('title' => 'Ajukan Komplain');
        return view('komplain.create', $data);
    }

    public function store(Request $request)
    {
        // Only penghuni can create komplain
        if (!auth()->user()->isPenghuni()) {
            abort(403, 'Hanya penghuni yang dapat mengajukan komplain');
        }

        $penghuni = auth()->user()->penghuni;
        if (!$penghuni) {
            return redirect()->route('dashboard')
                ->with('error', 'Data penghuni tidak ditemukan');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:fasilitas,kebersihan,keamanan,lainnya',
            'prioritas' => 'required|in:low,medium,high,urgent',
        ], [
            'judul.required' => 'Judul komplain wajib diisi',
            'deskripsi.required' => 'Deskripsi komplain wajib diisi',
            'kategori.required' => 'Kategori wajib dipilih',
            'prioritas.required' => 'Prioritas wajib dipilih',
        ]);

        try {
            Komplain::create([
                'penghuni_id' => $penghuni->id,
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'kategori' => $validated['kategori'],
                'prioritas' => $validated['prioritas'],
                'status' => 'open',
            ]);

            return redirect()->route('komplain.index')
                ->with('success', 'Komplain berhasil diajukan. Akan segera ditangani.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal mengajukan komplain: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $komplain = Komplain::findOrFail($id);
            $komplain->update([
                'status' => $request->status,
                'resolved_at' => $request->status == 'resolved' ? now() : null,
            ]);
            
            return redirect()->route('komplain.index')
                ->with('success', 'Status komplain berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('komplain.index')
                ->with('error', 'Gagal mengupdate status: ' . $e->getMessage());
        }
    }
}

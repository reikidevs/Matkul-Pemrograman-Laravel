<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;

class PenghuniController extends Controller
{
    public function index()
    {
        $data['master'] = array('title' => 'Kelola Penghuni');
        $data['penghunis'] = Penghuni::with('user', 'penghunianAktif.kamar')->latest()->get();
        
        return view('penghuni.index', $data);
    }

    public function approve($id)
    {
        try {
            $penghuni = Penghuni::findOrFail($id);
            $penghuni->update(['status' => 'active']);
            
            return redirect()->route('penghuni.index')
                ->with('success', 'Penghuni berhasil disetujui');
        } catch (\Exception $e) {
            return redirect()->route('penghuni.index')
                ->with('error', 'Gagal menyetujui penghuni: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $penghuni = Penghuni::findOrFail($id);
            $penghuni->update(['status' => 'inactive']);
            
            return redirect()->route('penghuni.index')
                ->with('success', 'Penghuni ditolak');
        } catch (\Exception $e) {
            return redirect()->route('penghuni.index')
                ->with('error', 'Gagal menolak penghuni: ' . $e->getMessage());
        }
    }
}

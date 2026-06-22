<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Tagihan;

class PembayaranController extends Controller
{
    public function index()
    {
        $data['master'] = array('title' => 'Kelola Pembayaran');
        $data['pembayarans'] = Pembayaran::with('tagihan.penghunian.penghuni', 'tagihan.penghunian.kamar')
            ->latest()
            ->get();
        
        return view('pembayaran.index', $data);
    }

    public function approve($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);

            // Update status tagihan
            $pembayaran->tagihan->update(['status' => 'paid']);
            
            return redirect()->route('pembayaran.index')
                ->with('success', 'Pembayaran berhasil disetujui');
        } catch (\Exception $e) {
            return redirect()->route('pembayaran.index')
                ->with('error', 'Gagal menyetujui pembayaran: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->update([
                'status' => 'rejected',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
                'catatan' => $request->catatan,
            ]);

            // Reset status tagihan
            $pembayaran->tagihan->update(['status' => 'unpaid']);
            
            return redirect()->route('pembayaran.index')
                ->with('success', 'Pembayaran ditolak');
        } catch (\Exception $e) {
            return redirect()->route('pembayaran.index')
                ->with('error', 'Gagal menolak pembayaran: ' . $e->getMessage());
        }
    }
}

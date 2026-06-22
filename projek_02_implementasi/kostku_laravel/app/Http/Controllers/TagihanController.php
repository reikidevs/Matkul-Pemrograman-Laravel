<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class TagihanController extends Controller
{
    public function index()
    {
        $data['master'] = array('title' => 'Tagihan Saya');
        
        // Get penghuni's active penghunian
        $penghuni = auth()->user()->penghuni;
        
        if (!$penghuni || !$penghuni->penghunianAktif) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda belum memiliki kamar aktif');
        }

        // Get tagihan dari penghunian aktif
        $data['tagihans'] = $penghuni->penghunianAktif->tagihans()
            ->with('pembayaran')
            ->orderBy('tanggal_jatuh_tempo', 'desc')
            ->get();
        
        return view('tagihan.index', $data);
    }

    public function bayar($id)
    {
        $tagihan = Tagihan::with('penghunian.penghuni')->findOrFail($id);
        
        // Verify tagihan belongs to logged in user
        if ($tagihan->penghunian->penghuni->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Check if already paid or has pending payment
        if ($tagihan->status === 'paid') {
            return redirect()->route('tagihan.index')
                ->with('error', 'Tagihan sudah dibayar');
        }

        if ($tagihan->pembayaran && $tagihan->pembayaran->status === 'pending') {
            return redirect()->route('tagihan.index')
                ->with('error', 'Pembayaran sedang menunggu konfirmasi');
        }

        $data['master'] = array('title' => 'Bayar Tagihan');
        $data['tagihan'] = $tagihan;
        
        return view('tagihan.bayar', $data);
    }

    public function submitPembayaran(Request $request, $id)
    {
        $tagihan = Tagihan::with('penghunian.penghuni')->findOrFail($id);
        
        // Verify ownership
        if ($tagihan->penghunian->penghuni->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'rekening_tujuan' => 'required|string|max:255',
            'metode_pembayaran' => 'required|in:transfer,ewallet,cash',
            'bukti_transfer' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'catatan' => 'nullable|string',
        ], [
            'jumlah_bayar.required' => 'Jumlah bayar wajib diisi',
            'jumlah_bayar.numeric' => 'Jumlah bayar harus berupa angka',
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi',
            'rekening_tujuan.required' => 'Rekening tujuan transfer wajib dipilih',
            'metode_pembayaran.required' => 'Metode bayar wajib dipilih',
            'bukti_transfer.required' => 'Bukti transfer wajib diupload',
            'bukti_transfer.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'bukti_transfer.max' => 'Ukuran file maksimal 2MB',
        ]);

        try {
            // Handle file upload
            $buktiTransferPath = null;
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $fileName = time() . '_' . $tagihan->id . '_' . $file->getClientOriginalName();
                $buktiTransferPath = $file->storeAs('bukti_transfer', $fileName, 'public');
            }

            // Create pembayaran record
            Pembayaran::create([
                'tagihan_id' => $tagihan->id,
                'jumlah_bayar' => $validated['jumlah_bayar'],
                'tanggal_bayar' => $validated['tanggal_bayar'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'rekening_tujuan' => $validated['rekening_tujuan'],
                'bukti_transfer' => $buktiTransferPath,
                'status' => 'pending',
                'catatan' => $validated['catatan'],
            ]);

            return redirect()->route('tagihan.index')
                ->with('success', 'Pembayaran berhasil disubmit. Menunggu konfirmasi pemilik.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal submit pembayaran: ' . $e->getMessage());
        }
    }
}

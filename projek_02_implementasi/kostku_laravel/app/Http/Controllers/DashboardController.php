<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Penghunian;
use App\Models\Pembayaran;
use App\Models\Komplain;

class DashboardController extends Controller
{
    public function index()
    {
        $data['master'] = array('title' => 'Dashboard');
        
        // Statistik untuk Pemilik/Admin
        if (auth()->user()->isPemilik() || auth()->user()->isAdmin()) {
            $data['totalKamar'] = Kamar::count();
            $data['kamarTerisi'] = Kamar::where('status', 'terisi')->count();
            $data['kamarTersedia'] = Kamar::where('status', 'tersedia')->count();
            $data['totalPenghuni'] = Penghuni::where('status', 'active')->count();
            $data['pembayaranPending'] = Pembayaran::where('status', 'pending')->count();
            $data['komplainOpen'] = Komplain::where('status', 'open')->count();
            
            // Pendapatan bulan ini
            $data['pendapatanBulanIni'] = Pembayaran::where('status', 'approved')
                ->whereMonth('approved_at', now()->month)
                ->sum('jumlah_bayar');
            
            return view('dashboard.pemilik', $data);
        }
        
        // Statistik untuk Penghuni
        if (auth()->user()->isPenghuni()) {
            $penghuni = auth()->user()->penghuni;
            $data['penghuni'] = $penghuni;
            $data['penghunianAktif'] = $penghuni->penghunianAktif;
            $data['komplainAktif'] = $penghuni->komplains()->whereIn('status', ['open', 'in_progress'])->count();
            
            return view('dashboard.penghuni', $data);
        }

        return view('dashboard.welcome', $data);
    }
}

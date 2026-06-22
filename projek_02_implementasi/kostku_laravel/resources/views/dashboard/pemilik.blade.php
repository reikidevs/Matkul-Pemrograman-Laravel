@extends('layouts.app')

@section('title', 'Dashboard Pemilik - KostKu')

@section('content')
<!-- Welcome Section -->
<div class="card" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; margin-bottom: 32px;">
    <h2 style="color: white; margin-bottom: 8px;">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
    <p style="opacity: 0.9;">Berikut adalah ringkasan operasional kost Anda hari ini.</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $totalKamar }}</div>
                <div class="stat-label">Total Kamar</div>
            </div>
            <div class="stat-icon primary">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $kamarTerisi }}</div>
                <div class="stat-label">Kamar Terisi</div>
            </div>
            <div class="stat-icon success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
        </div>
        @if($totalKamar > 0)
        <div style="font-size: 14px; color: var(--success); margin-top: 8px;">
            {{ round(($kamarTerisi / $totalKamar) * 100, 1) }}% Occupancy Rate
        </div>
        @endif
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ number_format($pendapatanBulanIni / 1000000, 1) }} Jt</div>
                <div class="stat-label">Pendapatan Bulan Ini</div>
            </div>
            <div class="stat-icon warning">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $pembayaranPending }}</div>
                <div class="stat-label">Pembayaran Pending</div>
            </div>
            <div class="stat-icon danger">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 32px;">
    <a href="{{ route('pembayaran.index') }}" class="card" style="text-align: center; padding: 24px; cursor: pointer; text-decoration: none; color: inherit;">
        <div style="width: 48px; height: 48px; background-color: #DBEAFE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </div>
        <div style="font-weight: 600; margin-bottom: 4px;">Konfirmasi Pembayaran</div>
        <div style="font-size: 14px; color: var(--gray-500);">{{ $pembayaranPending }} menunggu konfirmasi</div>
    </a>

    <a href="{{ route('komplain.index') }}" class="card" style="text-align: center; padding: 24px; cursor: pointer; text-decoration: none; color: inherit;">
        <div style="width: 48px; height: 48px; background-color: #FEE2E2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
        <div style="font-weight: 600; margin-bottom: 4px;">Kelola Komplain</div>
        <div style="font-size: 14px; color: var(--gray-500);">{{ $komplainOpen }} komplain aktif</div>
    </a>

    <a href="{{ route('penghuni.index') }}" class="card" style="text-align: center; padding: 24px; cursor: pointer; text-decoration: none; color: inherit;">
        <div style="width: 48px; height: 48px; background-color: #D1FAE5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
            </svg>
        </div>
        <div style="font-weight: 600; margin-bottom: 4px;">Kelola Penghuni</div>
        <div style="font-size: 14px; color: var(--gray-500);">{{ $totalPenghuni }} penghuni aktif</div>
    </a>

    <a href="{{ route('kamar.index') }}" class="card" style="text-align: center; padding: 24px; cursor: pointer; text-decoration: none; color: inherit;">
        <div style="width: 48px; height: 48px; background-color: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            </svg>
        </div>
        <div style="font-weight: 600; margin-bottom: 4px;">Kelola Kamar</div>
        <div style="font-size: 14px; color: var(--gray-500);">{{ $kamarTersedia }} kamar tersedia</div>
    </a>
</div>

<!-- Recent Activities -->
<div class="card" style="margin-bottom: 32px;">
    <div class="card-header">
        <h3 class="card-title">Aktivitas Terbaru</h3>
    </div>
    <div style="display: flex; flex-direction: column; gap: 16px;">
        @php
            $pembayaranTerbaru = \App\Models\Pembayaran::with(['tagihan.penghunian.penghuni'])
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        @endphp

        @forelse($pembayaranTerbaru as $pembayaran)
        <div style="display: flex; gap: 16px; padding: 16px; background-color: var(--gray-50); border-radius: 8px;">
            <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                    <line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
            </div>
            <div style="flex: 1;">
                <div style="font-weight: 600; margin-bottom: 4px;">
                    Pembayaran dari {{ $pembayaran->tagihan->penghunian->penghuni->nama ?? 'Penghuni' }}
                </div>
                <div style="font-size: 14px; color: var(--gray-500);">
                    Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                </div>
                <div style="font-size: 12px; color: var(--gray-500); margin-top: 4px;">
                    {{ $pembayaran->created_at->diffForHumans() }}
                </div>
            </div>
            <span class="badge badge-{{ $pembayaran->status == 'approved' ? 'success' : ($pembayaran->status == 'pending' ? 'warning' : 'danger') }}">
                {{ ucfirst($pembayaran->status) }}
            </span>
        </div>
        @empty
        <div class="empty-state">
            <p>Belum ada aktivitas terbaru</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Chart Pendapatan (Simple Bar Chart) -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pendapatan 6 Bulan Terakhir</h3>
    </div>
    <div style="height: 300px; display: flex; align-items: flex-end; justify-content: space-around; gap: 8px; padding: 20px 0;">
        @php
            $pendapatanBulanan = [];
            for ($i = 5; $i >= 0; $i--) {
                $bulan = now()->subMonths($i);
                $total = \App\Models\Pembayaran::where('status', 'approved')
                    ->whereYear('approved_at', $bulan->year)
                    ->whereMonth('approved_at', $bulan->month)
                    ->sum('jumlah_bayar');
                $pendapatanBulanan[] = [
                    'bulan' => $bulan->format('M'),
                    'total' => $total,
                    'height' => $total > 0 ? ($total / 30000000 * 100) : 10 // Max 30jt for scale
                ];
            }
        @endphp

        @foreach($pendapatanBulanan as $data)
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center;">
            <div style="width: 100%; height: {{ min($data['height'], 100) }}%; background: linear-gradient(to top, #3B82F6, #60A5FA); border-radius: 8px 8px 0 0; min-height: 20px;"></div>
            <div style="margin-top: 8px; font-size: 14px; font-weight: 600;">{{ $data['bulan'] }}</div>
            <div style="font-size: 12px; color: var(--gray-500);">{{ number_format($data['total'] / 1000000, 1) }} Jt</div>
        </div>
        @endforeach
    </div>
</div>
@endsection

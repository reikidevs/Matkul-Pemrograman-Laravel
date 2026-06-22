@extends('layouts.app')

@section('title', 'Dashboard Penghuni - KostKu')

@section('content')
<!-- Welcome Section -->
<div class="card" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; margin-bottom: 32px;">
    <h2 style="color: white; margin-bottom: 8px;">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
    <p style="opacity: 0.9;">Semoga harimu menyenangkan. Berikut adalah ringkasan informasi kost Anda.</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $penghunianAktif ? $penghunianAktif->kamar->nomor_kamar : '-' }}</div>
                <div class="stat-label">Nomor Kamar</div>
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
                <div class="stat-value">{{ $penghuni->status == 'active' ? 'Aktif' : ucfirst($penghuni->status) }}</div>
                <div class="stat-label">Status Penghunian</div>
            </div>
            <div class="stat-icon success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                @php
                    $tagihanTerbaru = $penghunianAktif 
                        ? $penghunianAktif->tagihans()->where('status', 'unpaid')->orderBy('tanggal_jatuh_tempo', 'asc')->first() 
                        : null;
                @endphp
                <div class="stat-value">{{ $tagihanTerbaru ? $tagihanTerbaru->tanggal_jatuh_tempo->format('d M') : '-' }}</div>
                <div class="stat-label">Jatuh Tempo</div>
            </div>
            <div class="stat-icon warning">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $komplainAktif }}</div>
                <div class="stat-label">Komplain Aktif</div>
            </div>
            <div class="stat-icon danger">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="card" style="margin-bottom: 32px;">
    <div class="card-header">
        <h3 class="card-title">Aktivitas Terbaru</h3>
    </div>
    <div style="display: flex; flex-direction: column; gap: 16px;">
        @php
            // Gabungkan pembayaran dan komplain untuk aktivitas
            $pembayaranTerbaru = $penghunianAktif 
                ? $penghunianAktif->tagihans()->with('pembayaran')->latest()->take(2)->get() 
                : collect([]);
            $komplainTerbaru = $penghuni->komplains()->latest()->take(1)->get();
        @endphp

        @if($pembayaranTerbaru->count() > 0 || $komplainTerbaru->count() > 0)
            @foreach($pembayaranTerbaru as $tagihan)
                @if($tagihan->pembayaran)
                <div style="display: flex; gap: 16px; padding: 16px; background-color: var(--gray-50); border-radius: 8px;">
                    <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                            <line x1="1" y1="10" x2="23" y2="10"/>
                        </svg>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; margin-bottom: 4px;">Pembayaran {{ $tagihan->periode }}</div>
                        <div style="font-size: 14px; color: var(--gray-500);">
                            @if($tagihan->pembayaran->status == 'pending')
                                Pembayaran Anda sedang diverifikasi
                            @elseif($tagihan->pembayaran->status == 'approved')
                                Pembayaran telah dikonfirmasi
                            @else
                                Pembayaran ditolak
                            @endif
                        </div>
                        <div style="font-size: 12px; color: var(--gray-500); margin-top: 4px;">
                            {{ $tagihan->pembayaran->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <span class="badge badge-{{ $tagihan->pembayaran->status == 'approved' ? 'success' : ($tagihan->pembayaran->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ $tagihan->pembayaran->status == 'approved' ? 'Lunas' : ucfirst($tagihan->pembayaran->status) }}
                    </span>
                </div>
                @endif
            @endforeach

            @foreach($komplainTerbaru as $komplain)
            <div style="display: flex; gap: 16px; padding: 16px; background-color: var(--gray-50); border-radius: 8px;">
                <div style="width: 40px; height: 40px; background-color: #FEE2E2; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; margin-bottom: 4px;">{{ $komplain->judul }}</div>
                    <div style="font-size: 14px; color: var(--gray-500);">
                        @if($komplain->status == 'open')
                            Komplain Anda sedang diproses
                        @elseif($komplain->status == 'in_progress')
                            Komplain sedang ditangani
                        @elseif($komplain->status == 'resolved')
                            Komplain telah diselesaikan
                        @else
                            Komplain ditutup
                        @endif
                    </div>
                    <div style="font-size: 12px; color: var(--gray-500); margin-top: 4px;">
                        {{ $komplain->created_at->diffForHumans() }}
                    </div>
                </div>
                <span class="badge badge-{{ $komplain->status == 'resolved' ? 'success' : ($komplain->status == 'in_progress' ? 'warning' : 'primary') }}">
                    {{ ucfirst($komplain->status) }}
                </span>
            </div>
            @endforeach
        @else
        <div class="empty-state">
            <p>Belum ada aktivitas terbaru</p>
        </div>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
    @if($tagihanTerbaru && $tagihanTerbaru->status == 'unpaid')
    <a href="#" class="card" style="text-align: center; padding: 24px; cursor: pointer; text-decoration: none; color: inherit;">
        <div style="width: 48px; height: 48px; background-color: #DBEAFE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                <line x1="1" y1="10" x2="23" y2="10"/>
            </svg>
        </div>
        <div style="font-weight: 600; margin-bottom: 4px;">Bayar Sewa</div>
        <div style="font-size: 14px; color: var(--gray-500);">Rp {{ number_format($tagihanTerbaru->jumlah, 0, ',', '.') }}</div>
    </a>
    @endif

    <a href="{{ route('komplain.index') }}" class="card" style="text-align: center; padding: 24px; cursor: pointer; text-decoration: none; color: inherit;">
        <div style="width: 48px; height: 48px; background-color: #FEE2E2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
        <div style="font-weight: 600; margin-bottom: 4px;">Ajukan Komplain</div>
        <div style="font-size: 14px; color: var(--gray-500);">Laporkan masalah atau keluhan</div>
    </a>

    @if($penghunianAktif)
    <div class="card" style="text-align: center; padding: 24px;">
        <div style="width: 48px; height: 48px; background-color: #D1FAE5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            </svg>
        </div>
        <div style="font-weight: 600; margin-bottom: 4px;">Info Kamar</div>
        <div style="font-size: 14px; color: var(--gray-500);">{{ $penghunianAktif->kamar->tipe }} - Lt. {{ $penghunianAktif->kamar->lantai }}</div>
    </div>
    @endif
</div>
@endsection

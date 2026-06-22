@extends('layouts.app')

@section('title', 'Kamar Saya - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Kamar Saya</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Informasi detail kamar yang Anda tempati</p>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <!-- Kamar Details -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 24px;">
            <div>
                <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 8px;">Kamar {{ $kamar->nomor_kamar }}</h3>
                <span class="badge badge-{{ $kamar->tipe == 'vip' ? 'warning' : ($kamar->tipe == 'deluxe' ? 'primary' : 'secondary') }}" style="font-size: 14px;">
                    {{ ucfirst($kamar->tipe) }}
                </span>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Harga Sewa</div>
                <div style="font-size: 28px; font-weight: 700; color: var(--primary);">
                    Rp {{ number_format($kamar->harga_sewa, 0, ',', '.') }}
                </div>
                <div style="font-size: 14px; color: var(--gray-500);">per bulan</div>
            </div>
        </div>

        <!-- Kamar Info Grid -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; padding: 24px; background-color: var(--gray-50); border-radius: 12px; margin-bottom: 24px;">
            <div style="text-align: center;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px;">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                </svg>
                <div style="font-size: 24px; font-weight: 700; margin-bottom: 4px;">{{ $kamar->luas }} m²</div>
                <div style="font-size: 14px; color: var(--gray-500);">Luas Kamar</div>
            </div>
            <div style="text-align: center;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px;">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                <div style="font-size: 24px; font-weight: 700; margin-bottom: 4px;">Lantai {{ $kamar->lantai }}</div>
                <div style="font-size: 14px; color: var(--gray-500);">Lokasi</div>
            </div>
            <div style="text-align: center;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--warning)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px;">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                <div style="font-size: 24px; font-weight: 700; margin-bottom: 4px;">{{ ucfirst($kamar->status) }}</div>
                <div style="font-size: 14px; color: var(--gray-500);">Status</div>
            </div>
        </div>

        <!-- Fasilitas -->
        <div style="margin-bottom: 24px;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 16px;">Fasilitas Kamar</h4>
            @if($kamar->fasilitas)
                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                    @foreach(explode(',', $kamar->fasilitas) as $fasilitas)
                        <span style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: var(--gray-100); border-radius: 8px; font-size: 14px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            {{ trim($fasilitas) }}
                        </span>
                    @endforeach
                </div>
            @else
                <p style="color: var(--gray-500); font-style: italic;">Tidak ada fasilitas tercatat</p>
            @endif
        </div>

        <!-- Informasi Penghunian -->
        <div style="padding: 24px; background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); border-radius: 12px; color: white;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 16px; color: white;">Informasi Penghunian</h4>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                <div>
                    <div style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;">Tanggal Masuk</div>
                    <div style="font-size: 16px; font-weight: 600;">{{ $penghunian->tanggal_masuk->format('d F Y') }}</div>
                </div>
                <div>
                    <div style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;">Status Sewa</div>
                    <div style="font-size: 16px; font-weight: 600;">{{ ucfirst($penghunian->status) }}</div>
                </div>
                <div style="grid-column: 1 / -1;">
                    <div style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;">Durasi Tinggal</div>
                    <div style="font-size: 16px; font-weight: 600;">
                        {{ $penghunian->tanggal_masuk->diffForHumans(null, true) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Info -->
    <div>
        <!-- Quick Actions -->
        <div class="card" style="margin-bottom: 16px;">
            <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">Quick Actions</h4>
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <a href="{{ route('tagihan.index') }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                        <line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                    Lihat Tagihan
                </a>
                <a href="{{ route('komplain.create') }}" class="btn btn-danger" style="width: 100%; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                    Ajukan Komplain
                </a>
            </div>
        </div>

        <!-- Tagihan Info -->
        <div class="card">
            <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">Informasi Tagihan</h4>
            @php
                $tagihanUnpaid = $penghunian->tagihans()->where('status', 'unpaid')->first();
            @endphp
            @if($tagihanUnpaid)
                <div style="padding: 16px; background-color: #FEF3C7; border-left: 4px solid #F59E0B; border-radius: 8px; margin-bottom: 16px;">
                    <div style="font-size: 14px; color: #92400E; margin-bottom: 8px;">Tagihan Pending</div>
                    <div style="font-size: 20px; font-weight: 700; color: #92400E; margin-bottom: 4px;">
                        Rp {{ number_format($tagihanUnpaid->total, 0, ',', '.') }}
                    </div>
                    <div style="font-size: 13px; color: #92400E;">
                        Jatuh tempo: {{ $tagihanUnpaid->tanggal_jatuh_tempo->format('d M Y') }}
                    </div>
                </div>
                <a href="{{ route('tagihan.bayar', $tagihanUnpaid->id) }}" class="btn btn-warning" style="width: 100%; justify-content: center;">
                    Bayar Sekarang
                </a>
            @else
                <div style="text-align: center; padding: 24px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: 0.5;">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <p style="color: var(--success); font-weight: 600;">Tidak ada tagihan pending</p>
                    <p style="font-size: 14px; color: var(--gray-500); margin-top: 4px;">Semua tagihan sudah lunas</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

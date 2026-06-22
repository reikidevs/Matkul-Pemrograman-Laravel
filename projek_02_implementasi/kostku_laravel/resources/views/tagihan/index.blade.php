@extends('layouts.app')

@section('title', 'Tagihan Saya - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Tagihan Saya</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Daftar tagihan sewa dan riwayat pembayaran</p>
</div>

<!-- Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Total Tagihan</div>
                <div style="font-size: 24px; font-weight: 700;">{{ $tagihans->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                    <line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Belum Dibayar</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--danger);">{{ $tagihans->where('status', 'unpaid')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #FEE2E2; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Sudah Dibayar</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--success);">{{ $tagihans->where('status', 'paid')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #D1FAE5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Total Dibayar</div>
                <div style="font-size: 20px; font-weight: 700; color: var(--primary);">
                    Rp {{ number_format($tagihans->where('status', 'paid')->sum('jumlah') / 1000000, 1) }}Jt
                </div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Periode</th>
                    <th>Jumlah</th>
                    <th>Jatuh Tempo</th>
                    <th>Denda</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tagihans as $index => $tagihan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $tagihan->periode }}</strong></td>
                    <td>Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
                    <td>
                        {{ $tagihan->tanggal_jatuh_tempo->format('d M Y') }}
                        @if($tagihan->status == 'unpaid' && $tagihan->tanggal_jatuh_tempo->isPast())
                            <span class="badge badge-danger" style="margin-left: 8px;">Lewat Tempo</span>
                        @endif
                    </td>
                    <td>
                        @if($tagihan->denda > 0)
                            <span style="color: var(--danger);">Rp {{ number_format($tagihan->denda, 0, ',', '.') }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td><strong>Rp {{ number_format($tagihan->total, 0, ',', '.') }}</strong></td>
                    <td>
                        @if($tagihan->pembayaran)
                            @if($tagihan->pembayaran->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($tagihan->pembayaran->status == 'approved')
                                <span class="badge badge-success">Lunas</span>
                            @else
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        @else
                            <span class="badge badge-danger">Belum Bayar</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons" style="justify-content: center;">
                            @if($tagihan->status == 'unpaid' && (!$tagihan->pembayaran || $tagihan->pembayaran->status == 'rejected'))
                                <a href="{{ route('tagihan.bayar', $tagihan->id) }}" class="btn btn-sm btn-primary">
                                    Bayar Sekarang
                                </a>
                            @elseif($tagihan->pembayaran && $tagihan->pembayaran->status == 'pending')
                                <span style="color: var(--warning); font-size: 14px;">Menunggu Konfirmasi</span>
                            @elseif($tagihan->status == 'paid')
                                <span style="color: var(--success); font-size: 14px;">✓ Lunas</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 48px;">
                        <div class="empty-state">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; opacity: 0.3;">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                            <p>Belum ada tagihan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

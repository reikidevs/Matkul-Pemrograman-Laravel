@extends('layouts.app')

@section('title', 'Kelola Kamar - KostKu')

@section('content')
<!-- Page Header -->
<div class="flex-between" style="margin-bottom: 24px;">
    <div>
        <h2 class="page-title">Kelola Kamar</h2>
        <p style="color: var(--gray-500); margin-top: 4px;">Manajemen data kamar kost</p>
    </div>
    <a href="{{ route('kamar.create') }}" class="btn btn-primary">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Kamar
    </a>
</div>

<!-- Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Total Kamar</div>
                <div style="font-size: 24px; font-weight: 700;">{{ $kamars->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Tersedia</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--success);">{{ $kamars->where('status', 'tersedia')->count() }}</div>
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
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Terisi</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--warning);">{{ $kamars->where('status', 'terisi')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #FEF3C7; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Maintenance</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--danger);">{{ $kamars->where('status', 'maintenance')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #FEE2E2; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
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
                    <th>No. Kamar</th>
                    <th>Tipe</th>
                    <th>Luas</th>
                    <th>Lantai</th>
                    <th>Harga Sewa</th>
                    <th>Status</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kamars as $index => $kamar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $kamar->nomor_kamar }}</strong></td>
                    <td>
                        <span class="badge badge-{{ $kamar->tipe == 'vip' ? 'warning' : ($kamar->tipe == 'deluxe' ? 'primary' : 'secondary') }}">
                            {{ ucfirst($kamar->tipe) }}
                        </span>
                    </td>
                    <td>{{ $kamar->luas }} m²</td>
                    <td>Lantai {{ $kamar->lantai }}</td>
                    <td><strong>Rp {{ number_format($kamar->harga_sewa, 0, ',', '.') }}</strong></td>
                    <td>
                        <span class="badge badge-{{ $kamar->status == 'tersedia' ? 'success' : ($kamar->status == 'terisi' ? 'warning' : 'danger') }}">
                            {{ ucfirst($kamar->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons" style="justify-content: center;">
                            <a href="{{ route('kamar.edit', $kamar) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <form action="{{ route('kamar.destroy', $kamar) }}" method="POST" style="display: inline;" 
                                onsubmit="return confirm('Yakin ingin menghapus kamar {{ $kamar->nomor_kamar }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 48px;">
                        <div class="empty-state">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; opacity: 0.3;">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            </svg>
                            <p>Belum ada data kamar</p>
                            <a href="{{ route('kamar.create') }}" class="btn btn-primary" style="margin-top: 16px;">
                                Tambah Kamar Pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

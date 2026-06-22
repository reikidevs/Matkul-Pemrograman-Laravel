@extends('layouts.app')

@section('title', 'Kelola Penghuni - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Kelola Penghuni</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Manajemen data penghuni kost</p>
</div>

<!-- Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Total Penghuni</div>
                <div style="font-size: 24px; font-weight: 700;">{{ $penghunis->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Aktif</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--success);">{{ $penghunis->where('status', 'active')->count() }}</div>
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
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Pending</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--warning);">{{ $penghunis->where('status', 'pending')->count() }}</div>
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
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Inactive</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--gray-500);">{{ $penghunis->where('status', 'inactive')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: var(--gray-200); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gray-500)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Kamar</th>
                    <th>Tgl Masuk</th>
                    <th>Status</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penghunis as $index => $penghuni)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $penghuni->nama }}</strong></td>
                    <td>{{ $penghuni->user->email ?? '-' }}</td>
                    <td>{{ $penghuni->no_hp }}</td>
                    <td>
                        @if($penghuni->penghunianAktif)
                            <span class="badge badge-primary">{{ $penghuni->penghunianAktif->kamar->nomor_kamar }}</span>
                        @else
                            <span style="color: var(--gray-500);">-</span>
                        @endif
                    </td>
                    <td>
                        @if($penghuni->penghunianAktif)
                            {{ $penghuni->penghunianAktif->tanggal_masuk->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $penghuni->status == 'active' ? 'success' : ($penghuni->status == 'pending' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($penghuni->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons" style="justify-content: center;">
                            @if($penghuni->status == 'pending')
                                <form action="{{ route('penghuni.approve', $penghuni->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" 
                                        onclick="return confirm('Setujui penghuni {{ $penghuni->nama }}?')">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('penghuni.reject', $penghuni->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Tolak penghuni {{ $penghuni->nama }}?')">
                                        Reject
                                    </button>
                                </form>
                            @else
                                <span style="color: var(--gray-500); font-size: 14px;">
                                    {{ $penghuni->status == 'active' ? 'Sudah disetujui' : 'Tidak aktif' }}
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 48px;">
                        <div class="empty-state">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; opacity: 0.3;">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                            </svg>
                            <p>Belum ada data penghuni</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Kelola Komplain - KostKu')

@section('content')
<!-- Page Header -->
<div class="flex-between" style="margin-bottom: 24px;">
    <div>
        <h2 class="page-title">{{ auth()->user()->isPemilik() || auth()->user()->isAdmin() ? 'Kelola Komplain' : 'Daftar Komplain' }}</h2>
        <p style="color: var(--gray-500); margin-top: 4px;">
            {{ auth()->user()->isPemilik() || auth()->user()->isAdmin() ? 'Manajemen komplain dari penghuni' : 'Riwayat komplain Anda' }}
        </p>
    </div>
    @if(auth()->user()->isPenghuni())
    <a href="{{ route('komplain.create') }}" class="btn btn-success">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Ajukan Komplain Baru
    </a>
    @endif
</div>

<!-- Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Total Komplain</div>
                <div style="font-size: 24px; font-weight: 700;">{{ $komplains->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Open</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--primary);">{{ $komplains->where('status', 'open')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #DBEAFE; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">In Progress</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--warning);">{{ $komplains->where('status', 'in_progress')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #FEF3C7; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Resolved</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--success);">{{ $komplains->where('status', 'resolved')->count() }}</div>
            </div>
            <div style="width: 40px; height: 40px; background-color: #D1FAE5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
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
                    @if(auth()->user()->isPemilik() || auth()->user()->isAdmin())
                    <th>Penghuni</th>
                    @endif
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    @if(auth()->user()->isPemilik() || auth()->user()->isAdmin())
                    <th style="width: 15%; text-align: center;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($komplains as $index => $komplain)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    @if(auth()->user()->isPemilik() || auth()->user()->isAdmin())
                    <td><strong>{{ $komplain->penghuni->nama ?? '-' }}</strong></td>
                    @endif
                    <td>
                        <strong>{{ $komplain->judul }}</strong>
                        <div style="font-size: 13px; color: var(--gray-500); margin-top: 4px;">
                            {{ Str::limit($komplain->deskripsi, 60) }}
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-{{ $komplain->kategori == 'kerusakan' ? 'danger' : ($komplain->kategori == 'kebersihan' ? 'warning' : 'info') }}">
                            {{ ucfirst($komplain->kategori) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $komplain->prioritas == 'urgent' || $komplain->prioritas == 'high' ? 'danger' : ($komplain->prioritas == 'medium' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($komplain->prioritas) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $komplain->status == 'resolved' ? 'success' : ($komplain->status == 'in_progress' ? 'warning' : ($komplain->status == 'open' ? 'primary' : 'secondary')) }}">
                            {{ $komplain->status == 'in_progress' ? 'In Progress' : ucfirst($komplain->status) }}
                        </span>
                    </td>
                    <td>{{ $komplain->created_at->format('d M Y') }}</td>
                    @if(auth()->user()->isPemilik() || auth()->user()->isAdmin())
                    <td>
                        <div style="display: flex; justify-content: center;">
                            @if($komplain->status != 'closed')
                            <select onchange="updateStatus({{ $komplain->id }}, this.value)" 
                                class="btn btn-sm btn-primary" 
                                style="padding: 6px 12px; cursor: pointer;">
                                <option value="">Update Status</option>
                                @if($komplain->status != 'in_progress')
                                <option value="in_progress">In Progress</option>
                                @endif
                                @if($komplain->status != 'resolved')
                                <option value="resolved">Resolved</option>
                                @endif
                                @if($komplain->status != 'closed')
                                <option value="closed">Close</option>
                                @endif
                            </select>
                            @else
                            <span style="color: var(--gray-500); font-size: 14px;">Closed</span>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ (auth()->user()->isPemilik() || auth()->user()->isAdmin()) ? '8' : '6' }}" class="text-center" style="padding: 48px;">
                        <div class="empty-state">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; opacity: 0.3;">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                            <p>Belum ada komplain</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@if(auth()->user()->isPemilik() || auth()->user()->isAdmin())
@push('scripts')
<script>
function updateStatus(id, status) {
    if (!status) return;
    
    if (confirm('Update status komplain menjadi ' + status + '?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ url("komplain") }}/' + id + '/update-status';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        
        form.appendChild(csrfToken);
        form.appendChild(statusInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
@endif

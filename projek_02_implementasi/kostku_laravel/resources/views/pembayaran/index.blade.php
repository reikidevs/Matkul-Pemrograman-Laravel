@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Konfirmasi Pembayaran</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Verifikasi pembayaran sewa penghuni</p>
</div>

<!-- Alert Pending -->
@php
    $pendingCount = $pembayarans->where('status', 'pending')->count();
@endphp
@if($pendingCount > 0)
<div class="alert alert-warning" style="margin-bottom: 24px;">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
    </svg>
    <span>Ada <strong>{{ $pendingCount }}</strong> pembayaran menunggu konfirmasi Anda</span>
</div>
@endif

<!-- Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Total Pembayaran</div>
                <div style="font-size: 24px; font-weight: 700;">{{ $pembayarans->count() }}</div>
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
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Pending</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--warning);">{{ $pendingCount }}</div>
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
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Approved</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--success);">{{ $pembayarans->where('status', 'approved')->count() }}</div>
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
                <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px;">Total Diterima</div>
                <div style="font-size: 20px; font-weight: 700; color: var(--primary);">
                    Rp {{ number_format($pembayarans->where('status', 'approved')->sum('jumlah_bayar') / 1000000, 1) }}Jt
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
                    <th>Penghuni</th>
                    <th>Kamar</th>
                    <th>Periode</th>
                    <th>Jumlah</th>
                    <th>Tgl Transfer</th>
                    <th>Metode / Rekening Tujuan</th>
                    <th>Bukti Transfer</th>
                    <th>Status</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayarans as $index => $pembayaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $pembayaran->tagihan->penghunian->penghuni->nama ?? '-' }}</strong></td>
                    <td>
                        <span class="badge badge-primary">
                            {{ $pembayaran->tagihan->penghunian->kamar->nomor_kamar ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $pembayaran->tagihan->periode ?? '-' }}</td>
                    <td><strong>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</strong></td>
                    <td>{{ $pembayaran->tanggal_bayar->format('d M Y') }}</td>
                    <td>
                        @php
                            $labelMetode = [
                                'transfer' => 'Transfer Bank',
                                'ewallet' => 'E-Wallet',
                                'cash' => 'Tunai',
                            ];
                        @endphp
                        <span class="badge badge-info">{{ $labelMetode[$pembayaran->metode_pembayaran] ?? ucfirst($pembayaran->metode_pembayaran) }}</span>
                        <div style="font-size: 12px; color: var(--gray-500); margin-top: 4px;">
                            {{ $pembayaran->rekening_tujuan ?? 'Rekening tidak dicantumkan' }}
                        </div>
                    </td>
                    <td>
                        @if($pembayaran->bukti_transfer)
                            <button type="button" class="btn btn-sm btn-secondary" onclick="showBuktiModal('{{ asset('storage/' . $pembayaran->bukti_transfer) }}', '{{ $pembayaran->tagihan->penghunian->penghuni->nama ?? 'Penghuni' }}')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                Lihat Bukti
                            </button>
                        @else
                            <span style="color: var(--gray-400); font-size: 13px;">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $pembayaran->status == 'approved' ? 'success' : ($pembayaran->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ $pembayaran->status == 'approved' ? 'Approved' : ($pembayaran->status == 'pending' ? 'Pending' : 'Rejected') }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons" style="justify-content: center;">
                            @if($pembayaran->status == 'pending')
                                <form action="{{ route('pembayaran.approve', $pembayaran->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" 
                                        onclick="return confirm('Setujui pembayaran dari {{ $pembayaran->tagihan->penghunian->penghuni->nama ?? 'penghuni' }}?')">
                                        Approve
                                    </button>
                                </form>
                                <button type="button" class="btn btn-sm btn-danger" 
                                    onclick="showRejectModal({{ $pembayaran->id }}, '{{ $pembayaran->tagihan->penghunian->penghuni->nama ?? 'penghuni' }}')">
                                    Reject
                                </button>
                            @else
                                <span style="color: var(--gray-500); font-size: 14px;">
                                    {{ $pembayaran->status == 'approved' ? 'Disetujui' : 'Ditolak' }}
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center" style="padding: 48px;">
                        <div class="empty-state">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; opacity: 0.3;">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                            <p>Belum ada data pembayaran</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Reject -->
<div id="rejectModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tolak Pembayaran</h3>
            <button type="button" class="modal-close" onclick="closeRejectModal()">&times;</button>
        </div>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="modal-body">
                <p style="margin-bottom: 16px;">
                    Yakin ingin menolak pembayaran dari <strong id="penghuniName"></strong>?
                </p>
                <div class="form-group">
                    <label for="catatan">Alasan Penolakan</label>
                    <textarea id="catatan" name="catatan" rows="3" 
                        placeholder="Contoh: Bukti transfer tidak jelas, nominal tidak sesuai, dll"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeRejectModal()">Batal</button>
                <button type="submit" class="btn btn-danger">Tolak Pembayaran</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Bukti Transfer -->
<div id="buktiModal" class="image-modal">
    <button type="button" class="image-modal-close" onclick="closeBuktiModal()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
    </button>
    <div class="image-modal-content">
        <div style="background: white; padding: 16px; border-radius: 8px 8px 0 0; text-align: center;">
            <h3 style="margin: 0; font-size: 18px; color: var(--gray-900);" id="buktiModalTitle">Bukti Transfer</h3>
        </div>
        <img id="buktiModalImage" src="" alt="Bukti Transfer" style="border-radius: 0 0 8px 8px;">
    </div>
</div>
@endsection

@push('scripts')
<script>
function showRejectModal(id, nama) {
    document.getElementById('rejectForm').action = '{{ url("pembayaran") }}/' + id + '/reject';
    document.getElementById('penghuniName').textContent = nama;
    document.getElementById('rejectModal').classList.add('active');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.remove('active');
    document.getElementById('catatan').value = '';
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});

// Show Bukti Transfer Modal
function showBuktiModal(imageUrl, penghuniNama) {
    const modal = document.getElementById('buktiModal');
    const image = document.getElementById('buktiModalImage');
    const title = document.getElementById('buktiModalTitle');
    
    image.src = imageUrl;
    title.textContent = 'Bukti Transfer - ' + penghuniNama;
    modal.classList.add('active');
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

// Close Bukti Transfer Modal
function closeBuktiModal() {
    const modal = document.getElementById('buktiModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Close bukti modal when clicking outside image
document.getElementById('buktiModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeBuktiModal();
    }
});

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRejectModal();
        closeBuktiModal();
    }
});
</script>
@endpush

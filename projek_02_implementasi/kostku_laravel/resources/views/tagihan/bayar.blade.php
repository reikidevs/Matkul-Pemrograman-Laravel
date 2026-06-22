@extends('layouts.app')

@section('title', 'Bayar Tagihan - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Bayar Tagihan</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Submit pembayaran untuk tagihan {{ $tagihan->periode }}</p>
</div>

<div style="display: grid; grid-template-columns: 1fr 400px; gap: 24px;">
    <!-- Form Pembayaran -->
    <div class="card">
        <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 20px;">Form Pembayaran</h3>
        
        <form action="{{ route('tagihan.submitPembayaran', $tagihan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Langkah Pembayaran (di atas, biar jelas urutannya) -->
            <div class="alert alert-info" style="margin-bottom: 24px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                <div>
                    <strong>Cara Pembayaran (ikuti urutan):</strong>
                    <ol style="margin: 8px 0 0 20px; font-size: 14px;">
                        <li>Pilih <strong>rekening tujuan</strong> di bawah, lalu transfer sesuai total tagihan.</li>
                        <li>Simpan screenshot / foto bukti transfer.</li>
                        <li>Isi form ini dan <strong>upload bukti transfer</strong>.</li>
                        <li>Klik Submit, lalu tunggu konfirmasi pemilik (maks. 1x24 jam).</li>
                    </ol>
                </div>
            </div>

            <!-- Jumlah Bayar -->
            <div class="form-group">
                <label for="jumlah_bayar">Jumlah Bayar <span style="color: var(--danger);">*</span></label>
                <input type="number" id="jumlah_bayar" name="jumlah_bayar" 
                    value="{{ old('jumlah_bayar', $tagihan->total) }}" 
                    min="0"
                    required>
                @error('jumlah_bayar')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                    Jumlah yang harus dibayar: Rp {{ number_format($tagihan->total, 0, ',', '.') }}
                </small>
            </div>

            <!-- Tanggal Bayar -->
            <div class="form-group">
                <label for="tanggal_bayar">Tanggal Transfer <span style="color: var(--danger);">*</span></label>
                <input type="date" id="tanggal_bayar" name="tanggal_bayar" 
                    value="{{ old('tanggal_bayar', date('Y-m-d')) }}" 
                    max="{{ date('Y-m-d') }}"
                    required>
                @error('tanggal_bayar')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rekening Tujuan Transfer (spesifik, agar pemilik tahu cek ke mana) -->
            <div class="form-group">
                <label for="rekening_tujuan">Rekening Tujuan Transfer <span style="color: var(--danger);">*</span></label>
                <select id="rekening_tujuan" name="rekening_tujuan" required onchange="syncMetode(this)">
                    <option value="">Pilih rekening tujuan</option>
                    <optgroup label="Transfer Bank">
                        <option value="Bank BCA - 1234567890 a.n. PT Kost Sejahtera" {{ old('rekening_tujuan') == 'Bank BCA - 1234567890 a.n. PT Kost Sejahtera' ? 'selected' : '' }}>Bank BCA - 1234567890 (PT Kost Sejahtera)</option>
                        <option value="Bank Mandiri - 9876543210 a.n. PT Kost Sejahtera" {{ old('rekening_tujuan') == 'Bank Mandiri - 9876543210 a.n. PT Kost Sejahtera' ? 'selected' : '' }}>Bank Mandiri - 9876543210 (PT Kost Sejahtera)</option>
                        <option value="Bank BNI - 5555666677 a.n. PT Kost Sejahtera" {{ old('rekening_tujuan') == 'Bank BNI - 5555666677 a.n. PT Kost Sejahtera' ? 'selected' : '' }}>Bank BNI - 5555666677 (PT Kost Sejahtera)</option>
                    </optgroup>
                    <optgroup label="E-Wallet">
                        <option value="GoPay - 081234567890 a.n. KostKu" {{ old('rekening_tujuan') == 'GoPay - 081234567890 a.n. KostKu' ? 'selected' : '' }}>GoPay - 081234567890 (KostKu)</option>
                        <option value="OVO - 081234567890 a.n. KostKu" {{ old('rekening_tujuan') == 'OVO - 081234567890 a.n. KostKu' ? 'selected' : '' }}>OVO - 081234567890 (KostKu)</option>
                        <option value="Dana - 081234567890 a.n. KostKu" {{ old('rekening_tujuan') == 'Dana - 081234567890 a.n. KostKu' ? 'selected' : '' }}>Dana - 081234567890 (KostKu)</option>
                    </optgroup>
                </select>
                @error('rekening_tujuan')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                    Pilih rekening yang Anda gunakan untuk transfer. Detail nomor rekening ada di panel kanan.
                </small>
            </div>

            <!-- Metode otomatis terisi dari pilihan rekening -->
            <input type="hidden" id="metode_pembayaran" name="metode_pembayaran" value="{{ old('metode_pembayaran') }}">
            @error('metode_pembayaran')
                <div class="form-error">{{ $message }}</div>
            @enderror

            <!-- Upload Bukti Transfer -->
            <div class="form-group">
                <label for="bukti_transfer">Upload Bukti Transfer <span style="color: var(--danger);">*</span></label>
                <input type="file" id="bukti_transfer" name="bukti_transfer" 
                    accept="image/jpeg,image/png,image/jpg,application/pdf" 
                    onchange="previewImage(this)" 
                    required>
                @error('bukti_transfer')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                    Format: JPG, PNG, atau PDF (Maks. 2MB). Upload screenshot atau foto bukti transfer Anda.
                </small>
                
                <!-- Image Preview -->
                <div id="imagePreviewContainer" class="image-preview-container">
                    <div class="image-preview">
                        <img id="imagePreview" src="" alt="Preview">
                        <button type="button" class="image-preview-remove" onclick="removeImage()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Catatan -->
            <div class="form-group">
                <label for="catatan">Catatan (Opsional)</label>
                <textarea id="catatan" name="catatan" rows="3" 
                    placeholder="Contoh: Transfer dari rekening BCA a.n. John Doe">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Actions -->
            <div style="display: flex; justify-content: flex-end; gap: 8px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                <a href="{{ route('tagihan.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Submit Pembayaran
                </button>
            </div>
        </form>
    </div>

    <!-- Detail Tagihan -->
    <div>
        <div class="card">
            <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 20px;">Detail Tagihan</h3>
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div>
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Periode</label>
                    <p style="font-size: 16px; font-weight: 600; color: var(--gray-900);">{{ $tagihan->periode }}</p>
                </div>
                
                <div>
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Kamar</label>
                    <p style="font-size: 16px; color: var(--gray-900);">{{ $tagihan->penghunian->kamar->nomor_kamar }}</p>
                </div>
                
                <div style="padding-top: 16px; border-top: 1px solid var(--gray-200);">
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Sewa Bulanan</label>
                    <p style="font-size: 16px; color: var(--gray-900);">Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</p>
                </div>
                
                @if($tagihan->denda > 0)
                <div>
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Denda</label>
                    <p style="font-size: 16px; color: var(--danger);">Rp {{ number_format($tagihan->denda, 0, ',', '.') }}</p>
                </div>
                @endif
                
                <div style="padding-top: 16px; border-top: 2px solid var(--gray-300);">
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Total yang Harus Dibayar</label>
                    <p style="font-size: 24px; font-weight: 700; color: var(--primary);">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</p>
                </div>
                
                <div>
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Jatuh Tempo</label>
                    <p style="font-size: 16px; color: var(--gray-900);">{{ $tagihan->tanggal_jatuh_tempo->format('d F Y') }}</p>
                    @if($tagihan->tanggal_jatuh_tempo->isPast())
                        <span class="badge badge-danger" style="margin-top: 4px;">Lewat Tempo</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informasi Rekening -->
        <div class="card" style="margin-top: 16px;">
            <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">Informasi Rekening Tujuan</h4>
            
            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
                <div>
                    <strong>Bank BCA</strong><br>
                    1234567890<br>
                    a.n. PT Kost Sejahtera
                </div>
                <div>
                    <strong>Bank Mandiri</strong><br>
                    9876543210<br>
                    a.n. PT Kost Sejahtera
                </div>
                <div>
                    <strong>Bank BNI</strong><br>
                    5555666677<br>
                    a.n. PT Kost Sejahtera
                </div>
                <div style="padding-top: 12px; border-top: 1px solid var(--gray-200);">
                    <strong>E-Wallet (GoPay / OVO / Dana)</strong><br>
                    081234567890<br>
                    a.n. KostKu
                </div>
            </div>
            <p style="font-size: 12px; color: var(--gray-500); margin-top: 12px;">
                Pilih rekening yang sama pada dropdown "Rekening Tujuan Transfer" agar pemilik mudah memverifikasi.
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Sinkron metode pembayaran (transfer/ewallet) dari pilihan rekening tujuan
function syncMetode(select) {
    const opt = select.options[select.selectedIndex];
    const grup = opt && opt.parentNode ? (opt.parentNode.label || '') : '';
    const metode = grup.toLowerCase().indexOf('wallet') !== -1 ? 'ewallet' : 'transfer';
    document.getElementById('metode_pembayaran').value = select.value ? metode : '';
}

// Set nilai metode saat halaman load (mis. setelah validasi gagal / old value)
document.addEventListener('DOMContentLoaded', function() {
    const sel = document.getElementById('rekening_tujuan');
    if (sel && sel.value) {
        syncMetode(sel);
    }
});

// Image Preview Function
function previewImage(input) {
    const container = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Check file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            container.classList.remove('show');
            return;
        }
        
        // Check file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        if (!validTypes.includes(file.type)) {
            alert('Format file tidak valid. Gunakan JPG, PNG, atau PDF.');
            input.value = '';
            container.classList.remove('show');
            return;
        }
        
        // Show preview for images only
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.add('show');
            };
            reader.readAsDataURL(file);
        } else {
            // For PDF, show a placeholder
            preview.src = '';
            preview.alt = 'PDF: ' + file.name;
            container.innerHTML = `
                <div style="padding: 24px; text-align: center; background-color: var(--gray-50); border-radius: var(--radius-sm); border: 2px solid var(--gray-200);">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--danger)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px;">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    <p style="margin: 0; font-size: 14px; color: var(--gray-700);">
                        <strong>${file.name}</strong>
                    </p>
                    <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--gray-500);">
                        PDF (${(file.size / 1024).toFixed(0)} KB)
                    </p>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeImage()" style="margin-top: 12px;">
                        Hapus File
                    </button>
                </div>
            `;
            container.classList.add('show');
        }
    }
}

// Remove Image Function
function removeImage() {
    const input = document.getElementById('bukti_transfer');
    const container = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    
    input.value = '';
    preview.src = '';
    container.classList.remove('show');
    container.innerHTML = `
        <div class="image-preview">
            <img id="imagePreview" src="" alt="Preview">
            <button type="button" class="image-preview-remove" onclick="removeImage()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    `;
}
</script>
@endpush

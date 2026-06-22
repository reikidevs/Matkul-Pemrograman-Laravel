@extends('layouts.app')

@section('title', 'Ajukan Komplain - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Ajukan Komplain Baru</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Laporkan masalah atau keluhan terkait kamar kost Anda</p>
</div>

<div class="card">
    <form action="{{ route('komplain.store') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
            <!-- Judul -->
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="judul">Judul Komplain <span style="color: var(--danger);">*</span></label>
                <input type="text" id="judul" name="judul" 
                    value="{{ old('judul') }}" 
                    placeholder="Contoh: AC Kamar 201 Tidak Dingin"
                    required>
                @error('judul')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label for="kategori">Kategori <span style="color: var(--danger);">*</span></label>
                <select id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="fasilitas" {{ old('kategori') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                    <option value="kebersihan" {{ old('kategori') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                    <option value="keamanan" {{ old('kategori') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                    <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kategori')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                    Pilih kategori yang sesuai dengan masalah Anda
                </small>
            </div>

            <!-- Prioritas -->
            <div class="form-group">
                <label for="prioritas">Tingkat Prioritas <span style="color: var(--danger);">*</span></label>
                <select id="prioritas" name="prioritas" required>
                    <option value="">Pilih Prioritas</option>
                    <option value="low" {{ old('prioritas') == 'low' ? 'selected' : '' }}>Low (Tidak Mendesak)</option>
                    <option value="medium" {{ old('prioritas') == 'medium' ? 'selected' : '' }}>Medium (Perlu Segera)</option>
                    <option value="high" {{ old('prioritas') == 'high' ? 'selected' : '' }}>High (Mendesak)</option>
                    <option value="urgent" {{ old('prioritas') == 'urgent' ? 'selected' : '' }}>Urgent (Sangat Mendesak)</option>
                </select>
                @error('prioritas')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Deskripsi (Full Width) -->
        <div class="form-group">
            <label for="deskripsi">Deskripsi Masalah <span style="color: var(--danger);">*</span></label>
            <textarea id="deskripsi" name="deskripsi" rows="6" 
                placeholder="Jelaskan masalah yang Anda alami secara detail. Contoh: AC di kamar 201 tidak dingin sejak 2 hari yang lalu. Sudah dicoba setting suhu ke 16°C tapi tetap tidak dingin. Mohon segera diperbaiki karena cuaca sedang panas."
                required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="form-error">{{ $message }}</div>
            @enderror
            <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                Jelaskan masalah dengan detail agar dapat ditangani dengan tepat
            </small>
        </div>

        <!-- Info Box -->
        <div class="alert alert-info" style="margin-bottom: 24px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
            <div>
                <strong>Kategori Komplain:</strong>
                <ul style="margin: 8px 0 0 20px; font-size: 14px;">
                    <li><strong>Fasilitas:</strong> AC rusak, TV tidak berfungsi, kasur rusak, dll</li>
                    <li><strong>Kebersihan:</strong> Kamar kotor, kamar mandi tidak bersih, sampah menumpuk</li>
                    <li><strong>Keamanan:</strong> Kunci rusak, CCTV mati, pencahayaan kurang</li>
                    <li><strong>Lainnya:</strong> Komplain yang tidak masuk kategori di atas</li>
                </ul>
            </div>
        </div>

        <!-- Actions -->
        <div style="display: flex; justify-content: flex-end; gap: 8px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
            <a href="{{ route('komplain.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                Ajukan Komplain
            </button>
        </div>
    </form>
</div>
@endsection

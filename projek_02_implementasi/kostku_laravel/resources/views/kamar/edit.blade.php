@extends('layouts.app')

@section('title', 'Edit Kamar - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Edit Kamar {{ $kamar->nomor_kamar }}</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Perbarui informasi kamar</p>
</div>

<div class="card">
    <form action="{{ route('kamar.update', $kamar) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
            <!-- Nomor Kamar -->
            <div class="form-group">
                <label for="nomor_kamar">Nomor Kamar <span style="color: var(--danger);">*</span></label>
                <input type="text" id="nomor_kamar" name="nomor_kamar" 
                    value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" 
                    placeholder="Contoh: 201, A1, dll"
                    required>
                @error('nomor_kamar')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipe -->
            <div class="form-group">
                <label for="tipe">Tipe Kamar <span style="color: var(--danger);">*</span></label>
                <select id="tipe" name="tipe" required>
                    <option value="">Pilih Tipe</option>
                    <option value="standar" {{ old('tipe', $kamar->tipe) == 'standar' ? 'selected' : '' }}>Standar</option>
                    <option value="deluxe" {{ old('tipe', $kamar->tipe) == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                    <option value="vip" {{ old('tipe', $kamar->tipe) == 'vip' ? 'selected' : '' }}>VIP</option>
                </select>
                @error('tipe')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Luas -->
            <div class="form-group">
                <label for="luas">Luas (m²) <span style="color: var(--danger);">*</span></label>
                <input type="number" id="luas" name="luas" 
                    value="{{ old('luas', $kamar->luas) }}" 
                    placeholder="Contoh: 15"
                    min="1" step="0.1"
                    required>
                @error('luas')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Lantai -->
            <div class="form-group">
                <label for="lantai">Lantai <span style="color: var(--danger);">*</span></label>
                <input type="number" id="lantai" name="lantai" 
                    value="{{ old('lantai', $kamar->lantai) }}" 
                    placeholder="Contoh: 2"
                    min="1"
                    required>
                @error('lantai')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Harga Sewa -->
            <div class="form-group">
                <label for="harga_sewa">Harga Sewa (Rp/bulan) <span style="color: var(--danger);">*</span></label>
                <input type="number" id="harga_sewa" name="harga_sewa" 
                    value="{{ old('harga_sewa', $kamar->harga_sewa) }}" 
                    placeholder="Contoh: 1500000"
                    min="0"
                    required>
                @error('harga_sewa')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status <span style="color: var(--danger);">*</span></label>
                <select id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="tersedia" {{ old('status', $kamar->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terisi" {{ old('status', $kamar->status) == 'terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="maintenance" {{ old('status', $kamar->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
                @error('status')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Fasilitas (Full Width) -->
        <div class="form-group">
            <label for="fasilitas">Fasilitas</label>
            <textarea id="fasilitas" name="fasilitas" rows="4" 
                placeholder="Contoh: AC, Kasur, Lemari, Kamar Mandi Dalam, WiFi">{{ old('fasilitas', $kamar->fasilitas) }}</textarea>
            @error('fasilitas')
                <div class="form-error">{{ $message }}</div>
            @enderror
            <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                Pisahkan setiap fasilitas dengan koma (,)
            </small>
        </div>

        <!-- Actions -->
        <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
            <a href="{{ route('kamar.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Update Kamar
            </button>
        </div>
    </form>
</div>
@endsection

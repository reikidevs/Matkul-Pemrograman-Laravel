@extends('layouts.app')

@section('title', 'Edit Profil - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Edit Profil</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Perbarui informasi profil Anda</p>
</div>

<div class="card">
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
            <!-- Name (User table) -->
            <div class="form-group">
                <label for="name">Nama Pengguna <span style="color: var(--danger);">*</span></label>
                <input type="text" id="name" name="name" 
                    value="{{ old('name', auth()->user()->name) }}" 
                    required>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                    Nama untuk login dan tampilan sistem
                </small>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email <span style="color: var(--danger);">*</span></label>
                <input type="email" id="email" name="email" 
                    value="{{ old('email', auth()->user()->email) }}" 
                    required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            @if($profile)
            <!-- Nama Lengkap (Profile table) -->
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" 
                    value="{{ old('nama', $profile->nama) }}" 
                    placeholder="Nama lengkap sesuai KTP">
                @error('nama')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- No HP -->
            <div class="form-group">
                <label for="no_hp">No. HP</label>
                <input type="text" id="no_hp" name="no_hp" 
                    value="{{ old('no_hp', $profile->no_hp) }}" 
                    placeholder="Contoh: 081234567890">
                @error('no_hp')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            @endif
        </div>

        @if($profile)
        <!-- Alamat (Full Width) -->
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4" 
                placeholder="Alamat lengkap sesuai KTP">{{ old('alamat', $profile->alamat) }}</textarea>
            @error('alamat')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <!-- Actions -->
        <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Ubah Password - KostKu')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 24px;">
    <h2 class="page-title">Ubah Password</h2>
    <p style="color: var(--gray-500); margin-top: 4px;">Perbarui password akun Anda</p>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('profile.updatePassword') }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Current Password -->
        <div class="form-group">
            <label for="current_password">Password Lama <span style="color: var(--danger);">*</span></label>
            <input type="password" id="current_password" name="current_password" 
                placeholder="Masukkan password lama Anda"
                required>
            @error('current_password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="password">Password Baru <span style="color: var(--danger);">*</span></label>
            <input type="password" id="password" name="password" 
                placeholder="Minimal 8 karakter"
                required>
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
            <small style="color: var(--gray-500); font-size: 13px; display: block; margin-top: 4px;">
                Password minimal 8 karakter
            </small>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru <span style="color: var(--danger);">*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation" 
                placeholder="Ulangi password baru"
                required>
            @error('password_confirmation')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Info Box -->
        <div class="alert alert-info" style="margin-top: 16px; margin-bottom: 24px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
            <div>
                <strong>Tips Keamanan:</strong>
                <ul style="margin: 8px 0 0 20px; font-size: 14px;">
                    <li>Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                    <li>Jangan gunakan password yang sama dengan akun lain</li>
                    <li>Ubah password secara berkala</li>
                </ul>
            </div>
        </div>

        <!-- Actions -->
        <div style="display: flex; justify-content: flex-end; gap: 8px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Ubah Password
            </button>
        </div>
    </form>
</div>
@endsection

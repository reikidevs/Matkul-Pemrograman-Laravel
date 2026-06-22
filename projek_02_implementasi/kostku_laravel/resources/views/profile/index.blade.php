@extends('layouts.app')

@section('title', 'Profil Saya - KostKu')

@section('content')
<!-- Page Header -->
<div class="flex-between" style="margin-bottom: 24px;">
    <div>
        <h2 class="page-title">Profil Saya</h2>
        <p style="color: var(--gray-500); margin-top: 4px;">Informasi akun dan profil Anda</p>
    </div>
    <div style="display: flex; gap: 8px;">
        <a href="{{ route('profile.changePassword') }}" class="btn btn-secondary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            Ubah Password
        </a>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit Profil
        </a>
    </div>
</div>

<div class="card">
    <!-- Profile Header -->
    <div style="display: flex; align-items: center; gap: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--gray-200); margin-bottom: 24px;">
        <div class="user-avatar" style="width: 80px; height: 80px; font-size: 32px;">
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        </div>
        <div style="flex: 1;">
            <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 4px;">{{ auth()->user()->name }}</h3>
            <p style="color: var(--gray-500); margin-bottom: 8px;">{{ auth()->user()->email }}</p>
            <span class="badge badge-{{ auth()->user()->isPemilik() ? 'primary' : (auth()->user()->isPenghuni() ? 'success' : 'secondary') }}">
                {{ auth()->user()->isPemilik() ? 'Pemilik Kost' : (auth()->user()->isPenghuni() ? 'Penghuni' : 'Admin') }}
            </span>
        </div>
    </div>

    <!-- Profile Details -->
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
        <!-- Account Information -->
        <div>
            <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: var(--gray-700);">Informasi Akun</h4>
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div>
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Email</label>
                    <p style="font-size: 16px; color: var(--gray-900);">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Role</label>
                    <p style="font-size: 16px; color: var(--gray-900);">
                        {{ auth()->user()->isPemilik() ? 'Pemilik Kost' : (auth()->user()->isPenghuni() ? 'Penghuni' : 'Administrator') }}
                    </p>
                </div>
                <div>
                    <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Bergabung Sejak</label>
                    <p style="font-size: 16px; color: var(--gray-900);">{{ auth()->user()->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div>
            <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: var(--gray-700);">Informasi Pribadi</h4>
            <div style="display: flex; flex-direction: column; gap: 16px;">
                @if($profile)
                    <div>
                        <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Nama Lengkap</label>
                        <p style="font-size: 16px; color: var(--gray-900);">{{ $profile->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">No. HP</label>
                        <p style="font-size: 16px; color: var(--gray-900);">{{ $profile->no_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Alamat</label>
                        <p style="font-size: 16px; color: var(--gray-900);">{{ $profile->alamat ?? '-' }}</p>
                    </div>
                @else
                    <p style="color: var(--gray-500); font-style: italic;">Data profil tidak tersedia</p>
                @endif

                @if($profile_type === 'penghuni' && $profile && $profile->penghunianAktif)
                    <div style="margin-top: 8px; padding-top: 16px; border-top: 1px solid var(--gray-200);">
                        <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Status Penghunian</label>
                        <p style="font-size: 16px; color: var(--gray-900);">
                            <span class="badge badge-success">{{ ucfirst($profile->status) }}</span>
                        </p>
                    </div>
                    <div>
                        <label style="font-size: 14px; color: var(--gray-500); margin-bottom: 4px; display: block;">Kamar</label>
                        <p style="font-size: 16px; color: var(--gray-900);">{{ $profile->penghunianAktif->kamar->nomor_kamar ?? '-' }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

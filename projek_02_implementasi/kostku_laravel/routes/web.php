<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KomplainController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagihanController;

/*
|--------------------------------------------------------------------------
| Web Routes - KostKu Application
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Auth routes (simple, manual login/logout)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
})->name('login.submit');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kamar (CRUD) - Pemilik only
    Route::middleware('pemilik')->group(function () {
        Route::resource('kamar', KamarController::class);
    });

    // Penghuni - Pemilik only
    Route::middleware('pemilik')->group(function () {
        Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni.index');
        Route::post('/penghuni/{id}/approve', [PenghuniController::class, 'approve'])->name('penghuni.approve');
        Route::post('/penghuni/{id}/reject', [PenghuniController::class, 'reject'])->name('penghuni.reject');
    });

    // Pembayaran - Pemilik only
    Route::middleware('pemilik')->group(function () {
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::post('/pembayaran/{id}/approve', [PembayaranController::class, 'approve'])->name('pembayaran.approve');
        Route::post('/pembayaran/{id}/reject', [PembayaranController::class, 'reject'])->name('pembayaran.reject');
    });

    // Komplain - All authenticated users
    Route::get('/komplain', [KomplainController::class, 'index'])->name('komplain.index');
    Route::get('/komplain/create', [KomplainController::class, 'create'])->name('komplain.create');
    Route::post('/komplain', [KomplainController::class, 'store'])->name('komplain.store');
    Route::post('/komplain/{id}/update-status', [KomplainController::class, 'updateStatus'])->name('komplain.updateStatus');

    // Profile - All authenticated users
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // Tagihan & Pembayaran - Penghuni only
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::get('/tagihan/{id}/bayar', [TagihanController::class, 'bayar'])->name('tagihan.bayar');
    Route::post('/tagihan/{id}/bayar', [TagihanController::class, 'submitPembayaran'])->name('tagihan.submitPembayaran');

    // Kamar Saya - Penghuni only
    Route::get('/kamar-saya', [KamarController::class, 'myRoom'])->name('kamar.myRoom');
});

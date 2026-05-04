<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

// Route untuk mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);

// Contoh route dengan multiple parameter
Route::get('/mahasiswa/{nim}/{nama}', function($nim, $nama) {
    return "NIM: $nim, Nama: $nama";
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgramStudiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
});

// Route untuk mahasiswa (CRUD)
// Penting: route /create harus didefinisikan SEBELUM route /{id}
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

// Route untuk program studi (CRUD)
Route::get('/prodi', [ProgramStudiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/create', [ProgramStudiController::class, 'create'])->name('prodi.create');
Route::post('/prodi', [ProgramStudiController::class, 'store'])->name('prodi.store');
Route::get('/prodi/{prodi}/edit', [ProgramStudiController::class, 'edit'])->name('prodi.edit');
Route::put('/prodi/{prodi}', [ProgramStudiController::class, 'update'])->name('prodi.update');
Route::delete('/prodi/{prodi}', [ProgramStudiController::class, 'destroy'])->name('prodi.destroy');

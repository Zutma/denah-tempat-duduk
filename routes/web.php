<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Kumpulan Route Admin
Route::middleware('auth')->group(function () {
    
    // Route bawaan profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==== MENU MASTER DATA ====
    Route::get('/data-fakultas', function () { return view('fakultas'); });
    Route::get('/data-prodi', function () { return view('prodi'); });
    
    // ==== ALUR HIERARKI WISUDA (EVENT -> SESI -> KURSI) ====
    // 1. Menampilkan daftar semua Event Wisuda
    Route::get('/wisuda', function () { return view('wisuda.index'); }); 
    
    // 2. Nanti ke depannya, teman lu bakal butuh route bersarang kayak gini:
    // Route::get('/wisuda/{event_id}/sesi', [SesiController::class, 'index']);
    // Route::get('/wisuda/{event_id}/sesi/{sesi_id}/kursi', [KursiController::class, 'index']);

    // ==== IMPORT EXCEL ====
    Route::get('/import-excel', function () { return view('import-excel'); });
});

require __DIR__.'/auth.php';
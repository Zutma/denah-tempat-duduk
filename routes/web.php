<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\GraduationEventController;
use App\Http\Controllers\GraduationSessionController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeatRowController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\PublicController;
use App\Models\Faculty;
use Illuminate\Support\Facades\Route;

// Route Utama Publik yang manggil PublicController
Route::get('/', [PublicController::class, 'index'])->name('public.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Kumpulan Route Admin
Route::middleware('auth')->group(function () {
    
    // Route bawaan profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- ROUTE BULK DELETE (Wajib di atas resource biar tidak error) ---
    Route::delete('/faculties/bulk-delete', [FacultyController::class, 'bulkDestroy'])->name('faculties.bulkDestroy');
    Route::delete('/study-programs/bulk-delete', [StudyProgramController::class, 'bulkDestroy'])->name('study-programs.bulkDestroy');
    Route::delete('/graduation-events/bulk-delete', [GraduationEventController::class, 'bulkDestroy'])->name('graduation-events.bulkDestroy');
    Route::delete('/graduation-sessions/bulk-delete', [GraduationSessionController::class, 'bulkDestroy'])->name('sessions.bulkDestroy');
    Route::delete('/graduates/bulk-delete', [GraduateController::class, 'bulkDestroy'])->name('graduates.bulkDestroy');
    // -------------------------------------------------------------------

    Route::resource('/faculties', FacultyController::class);
    Route::resource('/study-programs', StudyProgramController::class);
    Route::resource('/graduation-events', GraduationEventController::class);
    Route::resource('graduation-events.sessions', GraduationSessionController::class)->shallow();
    
    Route::get('/graduation-sessions/{session}/seats', [SeatRowController::class, 'index'])->name('sessions.seats.index');
    Route::post('/graduation-sessions/{session}/seats', [SeatRowController::class, 'store'])->name('sessions.seats.store');
    Route::delete('/seat-rows/{seatRow}', [SeatRowController::class, 'destroy'])->name('seat-rows.destroy');
    
    // Route Wisudawan
    Route::get('/graduation-sessions/{session}/graduates',[GraduateController::class,'index'])->name('sessions.graduates.index');
    Route::get('/graduation-sessions/{session}/graduates/create',[GraduateController::class,'create'])->name('sessions.graduates.create');
    Route::post('/graduation-sessions/{session}/graduates',[GraduateController::class,'store'])->name('sessions.graduates.store');
    Route::delete('/graduates/{graduate}', [GraduateController::class, 'destroy'])->name('graduates.destroy');
    
    // Route Import Excel
    Route::get('/graduation-sessions/{session}/import', [ImportController::class, 'create'])->name('sessions.import.create');
    Route::post('/graduation-sessions/{session}/import', [ImportController::class, 'store'])->name('sessions.import.store');
});

require __DIR__.'/auth.php';
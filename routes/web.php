<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GraduateSessionController;
use App\Http\Controllers\GraduationEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudyProgram;
use App\Http\Controllers\StudyProgramController;
use App\Models\Faculty;
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
    Route::resource('/faculties', FacultyController::class);
    Route::resource('/study-programs', StudyProgramController::class);
    Route::resource('/graduation-events', GraduationEventController::class);
    Route::resource('graduation-events.sessions', GraduateSessionController::class)->shallow();

});

require __DIR__.'/auth.php';
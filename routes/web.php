<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas (solo para usuarios logueados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/skills/create', [App\Http\Controllers\SkillController::class, 'create'])->name('skills.create');
    Route::post('/skills', [App\Http\Controllers\SkillController::class, 'store'])->name('skills.store');
});

// ESTA LÍNEA ES LA MÁS IMPORTANTE: Importa Login, Registro, etc.
require __DIR__.'/auth.php';
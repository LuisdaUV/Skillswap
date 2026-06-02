<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
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
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');           // LISTAR
    Route::get('/skills/create', [SkillController::class, 'create'])->name('skills.create');   // CREAR
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');           // GUARDAR
    Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])->name('skills.edit');    // EDITAR
    Route::put('/skills/{id}', [SkillController::class, 'update'])->name('skills.update');     // ACTUALIZAR
    Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
    Route::get('/search/skills', [App\Http\Controllers\SearchController::class, 'searchSkills'])->name('search.skills');
    Route::post('/user/skills', [SkillController::class, 'attachUser'])->name('user.skills.attach');
    Route::post('/exchanges', [ExchangeController::class, 'store'])->name('exchanges.store');
});

// ESTA LÍNEA ES LA MÁS IMPORTANTE: Importa Login, Registro, etc.
require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\ExchangeController;
use App\Models\Exchange;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Aseguramos la importación de Auth

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas (solo para usuarios logueados)
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        // Obtenemos el ID de forma segura usando la Fachada
        $userId = Auth::id();

        // Buscamos las solicitudes de intercambio pendientes destinadas al usuario logueado
        $incomingRequests = Exchange::with(['sender', 'requestedSkill', 'offeredSkill'])
            ->where('receiver_id', $userId)
            ->where('status', 'pendiente')
            ->get();

        // Enviamos la variable a la vista dashboard
        return view('dashboard', compact('incomingRequests'));
    })->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/skills/create', [SkillController::class, 'create'])->name('skills.create');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');           // LISTAR
    Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])->name('skills.edit');    // EDITAR
    Route::put('/skills/{id}', [SkillController::class, 'update'])->name('skills.update');     // ACTUALIZAR
    Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');
    
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
    Route::get('/search/skills', [App\Http\Controllers\SearchController::class, 'searchSkills'])->name('search.skills');
    Route::post('/user/skills', [SkillController::class, 'attachUser'])->name('user.skills.attach');
    
    Route::post('/exchanges', [ExchangeController::class, 'store'])->name('exchanges.store');

    // Añade estas dos líneas junto a la ruta exchanges.store que ya tenías:
    Route::post('/exchanges/{exchange}/accept', [ExchangeController::class, 'accept'])->name('exchanges.accept');
    Route::post('/exchanges/{exchange}/reject', [ExchangeController::class, 'reject'])->name('exchanges.reject');
});

// ESTA LÍNEA ES LA MÁS IMPORTANTE: Importa Login, Registro, etc.
require __DIR__.'/auth.php';
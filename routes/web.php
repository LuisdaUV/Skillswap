<?php

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SkillController;
use App\Models\Exchange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $userId = Auth::id();

        $incomingRequests = Exchange::with(['sender', 'requestedSkill', 'offeredSkill'])
            ->where('receiver_id', $userId)
            ->where('status', 'pendiente')
            ->get();

        $pendingSessions = Exchange::with(['sender', 'receiver', 'requestedSkill', 'offeredSkill'])
            ->where('status', 'aceptado')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->orderBy('meet_date')
            ->orderBy('meet_time')
            ->get();

        $sessionHistory = Exchange::with(['sender', 'receiver', 'requestedSkill', 'offeredSkill'])
            ->whereIn('status', ['completado', 'cancelado'])
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->latest('updated_at')
            ->get();

        $sentRequests = Exchange::with(['receiver', 'requestedSkill', 'offeredSkill'])
            ->where('sender_id', $userId)
            ->latest('id')
            ->get();    

        return view('dashboard', compact(
            'incomingRequests',
            'pendingSessions',
            'sessionHistory',
            'sentRequests',
        ));
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/skills/create', [SkillController::class, 'create'])->name('skills.create');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])->name('skills.edit');
    Route::put('/skills/{id}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');

    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/search/skills', [SearchController::class, 'searchSkills'])->name('search.skills');
    Route::post('/user/skills', [SkillController::class, 'attachUser'])->name('user.skills.attach');

    Route::post('/exchanges', [ExchangeController::class, 'store'])->name('exchanges.store');
    Route::post('/exchanges/{exchange}/accept', [ExchangeController::class, 'accept'])
        ->name('exchanges.accept');
    Route::post('/exchanges/{exchange}/reject', [ExchangeController::class, 'reject'])
        ->name('exchanges.reject');
    Route::post('/exchanges/{exchange}/confirm-completion', [ExchangeController::class, 'confirmCompletion'])
        ->middleware('verified')
        ->name('exchanges.confirm-completion');


    Route::post('/exchanges/{exchange}/cancel', [ExchangeController::class, 'cancel'])
    ->middleware('verified')
    ->name('exchanges.cancel');

    Route::post('/exchanges/{exchange}/report', [ExchangeController::class, 'report'])
    ->middleware('verified')
    ->name('exchanges.report');
    
});

require __DIR__.'/auth.php';
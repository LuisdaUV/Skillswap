<?php

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SkillController;
use App\Models\Exchange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
    $userId = Auth::id();

    $pendingRequestCount = Exchange::query()
        ->where('receiver_id', $userId)
        ->where('status', 'pendiente')
        ->count();

    $openSessionCount = Exchange::query()
        ->where('status', 'aceptado')
        ->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
        })
        ->count();

    return view('dashboard', compact('pendingRequestCount', 'openSessionCount'));
})->name('dashboard');

    Route::get('/movimientos', function () {
        $userId = Auth::id();

        $creditMovements = DB::table('credit_transfers as transfer')
            ->leftJoin('users as payer', 'payer.id', '=', 'transfer.payer_id')
            ->leftJoin('users as recipient', 'recipient.id', '=', 'transfer.recipient_id')
            ->where(function ($query) use ($userId) {
                $query->where('transfer.payer_id', $userId)
                    ->orWhere('transfer.recipient_id', $userId);
            })
            ->select(
                'transfer.exchange_id',
                'transfer.payer_id',
                'transfer.amount',
                'transfer.created_at',
                'payer.name as payer_name',
                'recipient.name as recipient_name',
            )
            ->orderByDesc('transfer.id')
            ->paginate(10, ['*'], 'movimientos');

        return view('credits.index', compact('creditMovements'));
    })->name('credits.index');

    Route::get('/solicitudes', function () {
    $userId = Auth::id();

    $incomingRequests = Exchange::with(['sender', 'requestedSkill', 'offeredSkill'])
        ->where('receiver_id', $userId)
        ->where('status', 'pendiente')
        ->latest('id')
        ->get();

    $sentRequests = Exchange::with(['receiver', 'requestedSkill', 'offeredSkill'])
        ->where('sender_id', $userId)
        ->latest('id')
        ->get();

    return view('exchanges.requests', compact('incomingRequests', 'sentRequests'));
})->name('exchanges.requests');

Route::get('/sesiones', function () {
    $userId = Auth::id();

    $mySessions = Exchange::with(['sender', 'receiver', 'requestedSkill', 'offeredSkill'])
        ->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
        });

    $pendingSessions = (clone $mySessions)
        ->where('status', 'aceptado')
        ->orderBy('meet_date')
        ->orderBy('meet_time')
        ->get();

    $sessionHistory = (clone $mySessions)
        ->whereIn('status', ['completado', 'cancelado'])
        ->latest('updated_at')
        ->get();

    return view('exchanges.sessions', compact('pendingSessions', 'sessionHistory'));
})->name('exchanges.sessions');

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

    Route::middleware(['auth', 'verified', 'can:moderate-reports'])
    ->prefix('admin/reportes')
    ->name('admin.reports.')
    ->group(function () {
        Route::get('/', [ReportController::class, 'index'])
            ->name('index');

        Route::post('/{report}/descartar', [ReportController::class, 'discard'])
            ->whereNumber('report')
            ->name('discard');

            Route::post('/{report}/sancionar', [ReportController::class, 'sanction'])
            ->whereNumber('report')
            ->name('sanction');
    });
});

require __DIR__.'/auth.php';
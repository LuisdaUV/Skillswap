<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exchange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;


class ExchangeController extends Controller
{
    /**
     * Almacena una nueva solicitud de intercambio de habilidades.
     */
    public function store(Request $request)
    {
        
        $request->merge(['mode' => $request->input('mode', 'directo')]);
    // 1. Validar estrictamente los datos que vienen del Modal
        $request->validate([
            'receiver_id' => [
                'required',
                'exists:users,id',
                // Validación extra: Evitar que un usuario se envíe una solicitud a sí mismo
                function ($attribute, $value, $fail) {
                    if ($value == Auth::id()) {
                        $fail('No puedes solicitar un intercambio de habilidades contigo mismo.');
                    }
                },
            ],
            'requested_skill_id' => 'required|exists:skills,id',
            'mode' => ['required', 'in:directo,creditos'],
            'offered_skill_id' => ['exclude_unless:mode,directo', 'required', 'exists:skills,id'],

            'meet_date' => 'required|date|after_or_equal:today',
            'meet_time' => 'required|date_format:H:i',



        ]);

        // 2. Crear el registro del intercambio en la base de datos
        Exchange::create([
            'sender_id'          => Auth::id(),
            'receiver_id'        => $request->receiver_id,
            'requested_skill_id' => $request->requested_skill_id,
            'mode' => $request->input('mode'),
            'offered_skill_id' => $request->input('mode') === 'directo'
                ? $request->input('offered_skill_id')
                : null,
            'meet_date'          => $request->meet_date,
            'meet_time'          => $request->meet_time,
            'status'             => 'pendiente', // Estado inicial por defecto
        ]);

        // 3. Redireccionar a la página anterior con el mensaje de éxito flash
        return back()->with('success', '¡Éxito! Tu solicitud de intercambio ha sido enviada al compañero.');
    }

    /**
     * Acepta una solicitud de intercambio.
     */ 
    public function accept(Exchange $exchange)
    {        // Validar que el usuario autenticado es el receptor de la solicitud
        if ($exchange->receiver_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para aceptar esta solicitud de intercambio.');
        }

        // Actualizar el estado del intercambio a "aceptado"
        $exchange->status = 'aceptado';
        $exchange->save();
        // Aquí podrías agregar lógica adicional, como notificar al remitente o actualizar habilidades
        return back()->with('success', 'Has aceptado la solicitud de intercambio.');
    }

    public function confirmCompletion(Exchange $exchange)
{
    return DB::transaction(function () use ($exchange) {
        $session = Exchange::query()->lockForUpdate()->findOrFail($exchange->id);
        $userId = (int) Auth::id();

        $isSender = (int) $session->sender_id === $userId;
        $isReceiver = (int) $session->receiver_id === $userId;

        abort_unless($isSender || $isReceiver, 403);

        if ($session->status === 'completado') {
            return back()->with('session_notice', 'La sesión ya está completada.');
        }

        if ($session->status !== 'aceptado') {
            return back()->with('session_notice', 'Esta sesión ya no admite confirmaciones.');
        }

        if (!$session->meet_date || !$session->meet_time) {
            return back()->with('session_notice', 'La sesión necesita una fecha y hora acordadas.');
        }

        $scheduledAt = Carbon::parse(
            $session->meet_date . ' ' . $session->meet_time,
            'America/Bogota'
        );

        if ($scheduledAt->isFuture()) {
            return back()->with('session_notice', 'Podrás confirmar cuando llegue la hora acordada.');
        }

        $confirmation = $isSender ? 'sender_completed_at' : 'receiver_completed_at';
        $otherConfirmation = $isSender ? 'receiver_completed_at' : 'sender_completed_at';

        if ($session->mode === 'creditos' && $session->{$otherConfirmation} !== null) {
            $participants = User::query()
                ->whereKey([$session->sender_id, $session->receiver_id])
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $payer = $participants->get($session->sender_id);
            $recipient = $participants->get($session->receiver_id);

            if (!$payer || !$recipient) {
                return back()->with('session_notice', 'Una de las cuentas ya no está activa.');
            }

            if ($payer->credits < 1) {
                return back()->with(
                    'session_notice',
                    'La sesión sigue pendiente porque quien la solicitó necesita 1 crédito. Podrás volver a confirmar cuando tenga saldo.'
                );
            }

            $payer->decrement('credits', 1);
            $recipient->increment('credits', 1);

            DB::table('credit_transfers')->insert([
                'exchange_id' => $session->id,
                'payer_id' => $payer->id,
                'recipient_id' => $recipient->id,
                'amount' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

$session->{$confirmation} ??= now();

if ($session->sender_completed_at && $session->receiver_completed_at) {
    $session->status = 'completado';
}

$session->save();

        return back()->with(
            'session_notice',
            $session->status === 'completado'
                ? 'Ambos confirmaron. La sesión quedó completada.'
                : 'Confirmación guardada. Falta la de tu compañero.'
        );
    });
}


public function cancel(Exchange $exchange)
{
    $userId = (int) Auth::id();

    abort_unless(
        (int) $exchange->sender_id === $userId
            || (int) $exchange->receiver_id === $userId,
        403
    );

    $updated = Exchange::query()
        ->whereKey($exchange->id)
        ->where('status', 'aceptado')
        ->update(['status' => 'cancelado']);

    return back()->with(
        'session_notice',
        $updated
            ? 'La sesión fue cancelada. Puedes verla en el historial.'
            : 'Esta sesión ya no se puede cancelar.'
    );
}

public function report(Request $request, Exchange $exchange)
{
    $reporterId = (int) Auth::id();
    $senderId = (int) $exchange->sender_id;
    $receiverId = (int) $exchange->receiver_id;

    abort_unless($reporterId === $senderId || $reporterId === $receiverId, 403);

    abort_unless(
        in_array($exchange->status, ['aceptado', 'completado', 'cancelado'], true),
        404
    );

    $data = $request->validateWithBag('sessionReport', [
        'reason' => ['required', 'in:insultos,ciberacoso,suplantacion,otro'],
        'description' => ['required', 'string', 'max:1000'],
    ], [
        'reason.required' => 'Selecciona un motivo.',
        'reason.in' => 'Selecciona un motivo válido.',
        'description.required' => 'Describe brevemente qué ocurrió.',
        'description.max' => 'La descripción debe tener máximo 1000 caracteres.',
    ]);

    DB::table('reports')->insert([
        'reporter_id' => $reporterId,
        'reported_user_id' => $reporterId === $senderId ? $receiverId : $senderId,
        'exchange_id' => $exchange->id,
        'reason' => $data['reason'],
        'description' => $data['description'],
        'status' => 'pendiente',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('dashboard')
        ->with('report_notice', 'Reporte enviado. Quedó pendiente de revisión.');
}



    /**
     * Rechaza una solicitud de intercambio.
     */
    public function reject(Exchange $exchange)
    {        // Validar que el usuario autenticado es el receptor de la solicitud
        if ($exchange->receiver_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para rechazar esta solicitud de intercambio.');
        }   
        // Actualizar el estado del intercambio a "rechazado"
        $exchange->status = 'rechazado';
        $exchange->save();
        // Aquí podrías agregar lógica adicional, como notificar al remitente
        return back()->with('success', 'Has rechazado la solicitud de intercambio.');
    }
}
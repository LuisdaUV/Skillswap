<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exchange;
use Illuminate\Support\Facades\Auth;

class ExchangeController extends Controller
{
    /**
     * Almacena una nueva solicitud de intercambio de habilidades.
     */
    public function store(Request $request)
    {
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
            'offered_skill_id' => 'required|exists:skills,id',

            'meet_date' => 'required|date|after_or_equal:today',
            'meet_time' => 'required|date_format:H:i',



        ]);

        // 2. Crear el registro del intercambio en la base de datos
        Exchange::create([
            'sender_id'          => Auth::id(),
            'receiver_id'        => $request->receiver_id,
            'requested_skill_id' => $request->requested_skill_id,
            'offered_skill_id'   => $request->offered_skill_id,
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
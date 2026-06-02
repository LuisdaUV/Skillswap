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
        ]);

        // 2. Crear el registro del intercambio en la base de datos
        Exchange::create([
            'sender_id'          => Auth::id(),
            'receiver_id'        => $request->receiver_id,
            'requested_skill_id' => $request->requested_skill_id,
            'offered_skill_id'   => $request->offered_skill_id,
            'status'             => 'pendiente', // Estado inicial por defecto
        ]);

        // 3. Redireccionar a la página anterior con el mensaje de éxito flash
        return back()->with('success', '¡Éxito! Tu solicitud de intercambio ha sido enviada al compañero.');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Definimos los mensajes PRIMERO
    $messages = [
        'password.min' => 'La contraseña es muy corta, pon al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden, verifica de nuevo.',
        'university_id.unique' => 'Esta matrícula ya está registrada en SkillSwap.',
        'required' => 'Oye, el campo :attribute es obligatorio.',
    ];

    // 2. Ejecutamos la validación pasando los mensajes al final
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'university_id' => ['required', 'string', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ], $messages); // <--- IMPORTANTE: Poner la variable aquí

    // 3. Si todo está bien, se crea el usuario
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'university_id' => $request->university_id,
        'password' => Hash::make($request->password),
        'credits' => 3,
    ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

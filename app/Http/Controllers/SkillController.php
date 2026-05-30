<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    // Muestra el formulario para crear una habilidad
    public function create()
    {
        return view('skills.create');
    }

    // Guarda la habilidad y la asocia al usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:skills',
            'category' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Debes escribir el nombre de la habilidad.',
            'name.unique' => 'Esta habilidad ya existe en la base de datos.',
        ]);

        // Crear la habilidad
        $skill = Skill::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        // ASOCIAR LA HABILIDAD AL USUARIO ACTUAL
        Auth::user()->skills()->attach($skill->id, ['level' => 'intermedio']);

        return redirect()->route('skills.create')->with('success', '¡Habilidad creada y agregada a tu perfil!');
    }
}
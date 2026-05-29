<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    // Muestra el formulario para crear una habilidad
    public function create()
    {
        return view('skills.create');
    }

    // Guarda la habilidad en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:skills',
            'category' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Debes escribir el nombre de la habilidad.',
            'name.unique' => 'Esta habilidad ya existe en la base de datos.',
        ]);

        Skill::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        return redirect()->route('skills.create')->with('success', '¡Habilidad creada con éxito!');
    }
}
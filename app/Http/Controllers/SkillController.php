<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    // LISTAR las habilidades del usuario
    public function index()
    {
        $skills = Auth::user()->skills;
        return view('skills.index', compact('skills'));
    }

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
            'level' => 'required|in:principiante,intermedio,avanzado,experto',
        ], [
            'name.required' => 'Debes escribir el nombre de la habilidad.',
            'name.unique' => 'Esta habilidad ya existe en la base de datos.',
            'level.required' => 'Selecciona tu nivel de conocimiento.',
        ]);

        // Crear la habilidad
        $skill = Skill::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        // ASOCIAR LA HABILIDAD AL USUARIO ACTUAL
        Auth::user()->skills()->attach($skill->id, ['level' => $request->level]);

        return redirect()->route('skills.index')->with('success', '¡Habilidad agregada a tu perfil!');
    }

    // Mostrar formulario para editar
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $userSkill = Auth::user()->skills()->where('skill_id', $id)->first();
        
        if (!$userSkill) {
            return redirect()->route('skills.index')->with('error', 'Esta habilidad no está en tu perfil.');
        }
        
        $level = $userSkill->pivot->level;
        
        return view('skills.edit', compact('skill', 'level'));
    }

    // Actualizar habilidad
    public function update(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|in:principiante,intermedio,avanzado,experto',
        ]);

        Auth::user()->skills()->updateExistingPivot($id, [
            'level' => $request->level,
        ]);

        return redirect()->route('skills.index')->with('success', '¡Nivel actualizado correctamente!');
    }

    // Eliminar habilidad del usuario
    public function destroy($id)
    {
        Auth::user()->skills()->detach($id);
        
        return redirect()->route('skills.index')->with('success', 'Habilidad eliminada de tu perfil.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    // LISTAR las habilidades del usuario
    public function index()
    {
        $user = Auth::user();
        $skills = DB::table('skills')
            ->join('skill_user', 'skills.id', '=', 'skill_user.skill_id')
            ->where('skill_user.user_id', $user->id)
            ->select('skills.*', 'skill_user.level')
            ->get();
        return view('skills.index', compact('skills'));
    }

    // Muestra el formulario para crear una habilidad
    public function create()
    {
        $skills = Skill::orderBy('name')->get();
        return view('skills.create', compact('skills'));
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

        // Crear la habilidadñ
        $skill = Skill::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        // ASOCIAR LA HABILIDAD AL USUARIO ACTUAL (insertar en tabla pivote)
        $user = Auth::user();
        DB::table('skill_user')->insert([
            'user_id' => $user->id,
            'skill_id' => $skill->id,
            'level' => $request->level,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('skills.index')->with('success', '¡Habilidad agregada a tu perfil!');
    }

    // Vincula una habilidad EXISTENTE al usuario logueado
    public function attachUser(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'level' => 'required|string', 
        ]);

        $user = Auth::user();

        // Verificamos que el usuario no tenga ya esta habilidad para evitar duplicados
        $exists = DB::table('skill_user')
            ->where('user_id', $user->id)
            ->where('skill_id', $request->skill_id)
            ->exists();

        if (!$exists) {
            DB::table('skill_user')->insert([
                'user_id' => $user->id,
                'skill_id' => $request->skill_id,
                'level' => $request->level,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return back()->with('success', '¡Habilidad añadida a tu perfil exitosamente!');
        }

        return back()->withErrors(['name' => 'Ya tienes esta habilidad registrada en tu perfil.']);
    }

    // Mostrar formulario para editar
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $user = Auth::user();
        $userSkill = DB::table('skill_user')->where('user_id', $user->id)->where('skill_id', $id)->first();

        if (!$userSkill) {
            return redirect()->route('skills.index')->with('error', 'Esta habilidad no está en tu perfil.');
        }

        $level = $userSkill->level;
        
        return view('skills.edit', compact('skill', 'level'));
    }

    // Actualizar habilidad
    public function update(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|in:principiante,intermedio,avanzado,experto',
        ]);

        $user = Auth::user();
        DB::table('skill_user')->where('user_id', $user->id)->where('skill_id', $id)->update([
            'level' => $request->level,
            'updated_at' => now(),
        ]);

        return redirect()->route('skills.index')->with('success', '¡Nivel actualizado correctamente!');
    }

    // Eliminar habilidad del usuario
    public function destroy($id)
    {
        $user = Auth::user();
        DB::table('skill_user')->where('user_id', $user->id)->where('skill_id', $id)->delete();
        
        return redirect()->route('skills.index')->with('success', 'Habilidad eliminada de tu perfil.');
    }
}
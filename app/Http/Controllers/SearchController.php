<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    // Mostrar página de búsqueda
    public function index()
    {
        $skills = Skill::all();
        $popularSkills = Skill::withCount('users')->orderBy('users_count', 'desc')->take(5)->get();
        
        return view('search.index', compact('skills', 'popularSkills'));
    }

    // Buscar habilidades
    public function searchSkills(Request $request)
    {
        $query = $request->get('query');
        $category = $request->get('category');
        
        // Buscar habilidades
        $skillsQuery = Skill::query();
        
        if ($query) {
            $skillsQuery->where('name', 'LIKE', "%{$query}%");
        }
        
        if ($category) {
            $skillsQuery->where('category', $category);
        }
        
        $skills = $skillsQuery->get();
        
        // Para cada habilidad, obtener los usuarios que la ofrecen
        $results = [];
        foreach ($skills as $skill) {
            $users = $skill->users()->where('user_id', '!=', Auth::id())->get();
            if ($users->count() > 0) {
                $results[] = [
                    'skill' => $skill,
                    'users' => $users
                ];
            }
        }
        
        return view('search.results', compact('results', 'query', 'category'));
    }
}
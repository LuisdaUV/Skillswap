<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Mis Habilidades' }}
            </h2>
            <a href="{{ route('skills.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
                + Nueva Habilidad
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            ❌ {{ session('error') }}
                        </div>
                    @endif

                    @php
                        $skills = Auth::user()->skills;
                    @endphp

                    @if($skills->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Habilidad</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nivel</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($skills as $skill)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $skill->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $skill->category ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($skill->pivot->level == 'principiante') bg-green-100 text-green-800
                                                    @elseif($skill->pivot->level == 'intermedio') bg-blue-100 text-blue-800
                                                    @elseif($skill->pivot->level == 'avanzado') bg-orange-100 text-orange-800
                                                    @else bg-purple-100 text-purple-800
                                                    @endif">
                                                    {{ ucfirst($skill->pivot->level ?? 'intermedio') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                                <a href="{{ route('skills.edit', $skill->id) }}" class="text-indigo-600 hover:text-indigo-900">✏️ Editar</a>
                                                <form method="POST" action="{{ route('skills.destroy', $skill->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-3" onclick="return confirm('¿Eliminar {{ $skill->name }} de tus habilidades?')">
                                                        🗑️ Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Aún no tienes habilidades registradas</p>
                            <a href="{{ route('skills.create') }}" class="inline-block mt-3 text-indigo-600 hover:underline">
                                Agrega tu primera habilidad →
                            </a>
                        </div>
                    @endif

                    <div class="mt-6 text-center">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                            ← Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ '🔍 Resultados de búsqueda' }}
            </h2>
            <a href="{{ route('search.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                ← Nueva búsqueda
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Resumen de búsqueda -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    @if($query)
                        <p class="text-gray-600">Resultados para: <strong>"{{ $query }}"</strong></p>
                    @endif
                    @if($category)
                        <p class="text-gray-600">Categoría: <strong>{{ $category }}</strong></p>
                    @endif
                </div>
            </div>

            <!-- Resultados -->
            @if(count($results) > 0)
                @foreach($results as $result)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-bold text-indigo-600">
                                    {{ $result['skill']->name }}
                                </h3>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">
                                    {{ $result['users']->count() }} compañeros disponibles
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($result['users'] as $user)
                                    <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                        <div class="flex items-center gap-3 mb-3">
                                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full w-10 h-10 flex items-center justify-center">
                                                <span class="text-white font-bold text-lg">
                                                    {{ substr($user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-500">Código: {{ $user->university_id }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <span class="inline-block text-xs px-2 py-1 rounded-full 
                                                @if($user->pivot->level == 'principiante') bg-green-100 text-green-700
                                                @elseif($user->pivot->level == 'intermedio') bg-blue-100 text-blue-700
                                                @else bg-purple-100 text-purple-700
                                                @endif">
                                                📊 Nivel: {{ ucfirst($user->pivot->level) }}
                                            </span>
                                        </div>
                                        
                                        <button onclick="solicitarIntercambio({{ $user->id }}, {{ $result['skill']->id }})" 
                                                class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
                                            💬 Solicitar intercambio
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
                        <p class="text-gray-500 mb-4">No hay compañeros que ofrezcan esta habilidad todavía</p>
                        <a href="{{ route('search.index') }}" class="text-indigo-600 hover:underline">
                            Realizar otra búsqueda
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ '🔍 Buscar Compañeros' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Formulario de búsqueda -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('search.skills') }}" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Buscar por nombre -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Buscar habilidad</label>
                                <input type="text" 
                                       name="query" 
                                       placeholder="Ej: Programación, Inglés, Matemáticas..."
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            
                            <!-- Filtrar por categoría -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                                <select name="category" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Todas las categorías</option>
                                    <option value="tecnologia">💻 Tecnología</option>
                                    <option value="idiomas">🌎 Idiomas</option>
                                    <option value="ciencias">🔬 Ciencias</option>
                                    <option value="arte">🎨 Arte</option>
                                    <option value="musica">🎵 Música</option>
                                    <option value="deporte">⚽ Deporte</option>
                                    <option value="otros">📚 Otros</option>
                                </select>
                            </div>
                            
                            <!-- Botón -->
                            <div class="flex items-end">
                                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                    🔍 Buscar compañeros
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Habilidades populares -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📈 Habilidades más buscadas</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($popularSkills as $skill)
                            <a href="{{ route('search.skills', ['query' => $skill->name]) }}" 
                               class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-full text-sm hover:bg-indigo-100 transition">
                                {{ $skill->name }}
                                <span class="text-xs text-indigo-400">({{ $skill->users_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Categorías rápidas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📂 Explorar por categoría</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <a href="{{ route('search.skills', ['category' => 'tecnologia']) }}" class="text-center p-3 border rounded-lg hover:bg-indigo-50 transition">
                            💻 Tecnología
                        </a>
                        <a href="{{ route('search.skills', ['category' => 'idiomas']) }}" class="text-center p-3 border rounded-lg hover:bg-indigo-50 transition">
                            🌎 Idiomas
                        </a>
                        <a href="{{ route('search.skills', ['category' => 'ciencias']) }}" class="text-center p-3 border rounded-lg hover:bg-indigo-50 transition">
                            🔬 Ciencias
                        </a>
                        <a href="{{ route('search.skills', ['category' => 'arte']) }}" class="text-center p-3 border rounded-lg hover:bg-indigo-50 transition">
                            🎨 Arte
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
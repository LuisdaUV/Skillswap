<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Añadir Nueva Habilidad' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- MENSAJE DE ÉXITO -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <!-- MENSAJE DE ERROR -->
                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('skills.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la Habilidad *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                               placeholder="Ej: Programación, Matemáticas, Inglés..." required>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Selecciona una categoría</option>
                            <option value="tecnologia">💻 Tecnología</option>
                            <option value="idiomas">🌎 Idiomas</option>
                            <option value="ciencias">🔬 Ciencias</option>
                            <option value="arte">🎨 Arte y Diseño</option>
                            <option value="musica">🎵 Música</option>
                            <option value="deporte">⚽ Deporte</option>
                            <option value="otros">📚 Otros</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="level" class="block text-sm font-medium text-gray-700">Tu nivel *</label>
                        <select name="level" id="level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="principiante">🌱 Principiante - Estoy empezando</option>
                            <option value="intermedio">📘 Intermedio - Tengo experiencia</option>
                            <option value="avanzado">🚀 Avanzado - Domino el tema</option>
                            <option value="experto">🏆 Experto - Nivel profesional</option>
                        </select>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('skills.index') }}" class="text-gray-500 hover:text-gray-700">
                            ← Cancelar
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                            ✅ Agregar Habilidad
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
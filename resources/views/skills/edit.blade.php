<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Editar Habilidad: ' . $skill->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600">
                        <strong>Habilidad:</strong> {{ $skill->name }}
                        @if($skill->category)
                            <br><strong>Categoría:</strong> {{ $skill->category }}
                        @endif
                    </p>
                </div>

                <form method="POST" action="{{ route('skills.update', $skill->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="level" class="block text-sm font-medium text-gray-700">Actualizar nivel</label>
                        <select name="level" id="level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="principiante" {{ $level == 'principiante' ? 'selected' : '' }}>🌱 Principiante</option>
                            <option value="intermedio" {{ $level == 'intermedio' ? 'selected' : '' }}>📘 Intermedio</option>
                            <option value="avanzado" {{ $level == 'avanzado' ? 'selected' : '' }}>🚀 Avanzado</option>
                            <option value="experto" {{ $level == 'experto' ? 'selected' : '' }}>🏆 Experto</option>
                        </select>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('skills.index') }}" class="text-gray-500 hover:text-gray-700">
                            ← Cancelar
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            💾 Actualizar nivel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
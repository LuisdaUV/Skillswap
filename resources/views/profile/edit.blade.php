<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Mi Perfil' }}
            </h2>
            <div class="text-sm">
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                    🎓 Código: {{ Auth::user()->university_id }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Tarjeta de perfil con foto y datos principales -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center space-x-6">
                        <!-- Avatar -->
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full p-4">
                            <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        
                        <!-- Información del usuario -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-500">{{ Auth::user()->email }}</p>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">✅ Estudiante verificado</span>
                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                                    💰 {{ Auth::user()->credits ?? 3 }} créditos disponibles
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario para editar perfil -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">📝 Información de la cuenta</h3>
                    
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Código de estudiante (solo lectura) -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700">🎓 Código de Estudiante</label>
                            <p class="mt-1 text-lg font-semibold text-indigo-600">{{ $user->university_id }}</p>
                            <p class="text-xs text-gray-400 mt-1">El código de estudiante no puede ser modificado</p>
                        </div>

                        <!-- Botón guardar -->
                        <div class="flex items-center gap-4 pt-3">
                            <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                                💾 Guardar cambios
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-green-600 bg-green-50 px-3 py-1 rounded">
                                    ✓ ¡Perfil actualizado!
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Estadísticas del usuario -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-5">
                    <div class="text-3xl font-bold text-indigo-600">{{ \App\Models\Skill::count() }}</div>
                    <div class="text-sm text-gray-500 mt-1">📚 Habilidades totales</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-5">
                    <div class="text-3xl font-bold text-indigo-600">0</div>
                    <div class="text-sm text-gray-500 mt-1">🔄 Intercambios realizados</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-5">
                    <div class="text-3xl font-bold text-indigo-600">⭐ 0.0</div>
                    <div class="text-sm text-gray-500 mt-1">Calificación promedio</div>
                </div>
            </div>

            <!-- Sección de habilidades del usuario -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">🏆 Mis habilidades</h3>
                        <a href="{{ route('skills.create') }}" class="bg-indigo-50 text-indigo-600 px-4 py-1.5 rounded-md text-sm font-medium hover:bg-indigo-100 transition">
                            + Agregar habilidad
                        </a>
                    </div>
                    
                    <div class="flex flex-wrap gap-2">
                        <div class="bg-gray-100 text-gray-500 px-4 py-2 rounded-lg text-sm">
                            Aún no tienes habilidades registradas
                        </div>
                    </div>
                    
                    <div class="mt-4 text-right">
                        <a href="{{ route('skills.create') }}" class="text-indigo-500 hover:text-indigo-700 text-sm">
                            Administrar habilidades →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Botón de volver al dashboard -->
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                    ← Volver al Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
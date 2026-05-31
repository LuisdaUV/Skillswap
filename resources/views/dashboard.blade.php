<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'SkillSwap' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold">¡Hola, {{ Auth::user()->name }}!</h3>
                            <p class="text-gray-600">Bienvenido a la comunidad de intercambio de habilidades.</p>
                            
                            <!--<form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline font-bold">
                                    Cerrar Sesión
                                </button>
                            </form>-->
                        </div>
                        <div class="bg-indigo-100 p-4 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-indigo-600">{{ Auth::user()->credits ?? 3 }}</span>
                            <span class="text-xs text-indigo-500 uppercase font-bold tracking-wider">Créditos</span>
                        </div>
                    </div>

                    <hr class="my-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border p-4 rounded-md">
                            <h4 class="font-bold text-indigo-600 mb-2">Información Académica</h4>
                            <p><strong>Código de Estudiante:</strong> {{ Auth::user()->university_id }}</p>
                            <p><strong>Correo:</strong> {{ Auth::user()->email }}</p>
                        </div>

                        <div class="border p-4 rounded-md bg-gray-50">
                            <h4 class="font-bold text-gray-700 mb-2">Próximos pasos</h4>
                            <ul class="list-disc ml-5 text-sm space-y-2">
                                <li><a href="{{ route('skills.index') }}" class="text-indigo-600 hover:underline">Configura tus habilidades</a></li>
                                <li><a href="{{ route('search.index') }}" class="text-indigo-600 hover:underline">🔍 Busca un compañero</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Sección de Mis Habilidades -->
                    <div class="mt-6 border p-4 rounded-md">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-bold text-indigo-600">🏆 Mis Habilidades</h4>
                            <a href="{{ route('skills.index') }}" class="text-sm text-indigo-500 hover:text-indigo-700">
                                Administrar →
                            </a>
                        </div>
                        
                        @if(Auth::user()->skills->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach(Auth::user()->skills as $skill)
                                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
                                        {{ $skill->name }}
                                        <span class="text-xs text-indigo-400">({{ $skill->pivot->level }})</span>
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">Aún no tienes habilidades registradas</p>
                            <a href="{{ route('skills.create') }}" class="text-sm text-indigo-500 hover:underline">
                                + Agregar tu primera habilidad
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
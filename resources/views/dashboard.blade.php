<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Panel Principal' }}
            </h2>
            
            <!-- Badge de créditos visible en móvil -->
            <div class="flex items-center gap-2">
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ Auth::user()->credits ?? 3 }} Créditos
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Tarjeta de bienvenida mejorada -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-6 mb-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold">¡Hola, {{ Auth::user()->name }}!</h3>
                        <p class="text-indigo-100 text-sm mt-1">Bienvenido a SkillSwap</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-4 text-center border border-gray-100">
                    <div class="text-2xl font-bold text-indigo-600">{{ \App\Models\Skill::count() }}</div>
                    <div class="text-xs text-gray-500 mt-1">Habilidades</div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-4 text-center border border-gray-100">
                    <div class="text-2xl font-bold text-indigo-600">0</div>
                    <div class="text-xs text-gray-500 mt-1">Intercambios</div>
                </div>
            </div>

            <!-- Información Académica -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                    <h4 class="font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Información Académica
                    </h4>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Código de Estudiante</span>
                        <span class="font-mono text-sm font-semibold text-gray-800">{{ Auth::user()->university_id }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Correo electrónico</span>
                        <span class="text-sm text-gray-800 break-all text-right">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>

                        <!-- Mis Habilidades -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h4 class="font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mis Habilidades
                    </h4>
                    <a href="{{ route('skills.create') }}" class="text-xs text-indigo-600 hover:text-indigo-800">
                        + Agregar
                    </a>
                </div>
                <div class="p-5">
                    @php
                        $userSkills = Auth::user()->skills;
                    @endphp
                    
                    @if($userSkills->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($userSkills as $skill)
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-full text-sm font-medium">
                                    {{ $skill->name }}
                                    @if($skill->pivot->level)
                                        <span class="text-xs text-indigo-400">({{ $skill->pivot->level }})</span>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-500 text-sm">Aún no tienes habilidades registradas</p>
                            <a href="{{ route('skills.create') }}" class="inline-block mt-3 text-indigo-600 text-sm hover:underline">
                                Comienza agregando tu primera habilidad →
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Próximos pasos / Acciones rápidas -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                    <h4 class="font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Acciones rápidas
                    </h4>
                </div>
                <div class="p-4 space-y-3">
                    <a href="{{ route('skills.create') }}" class="flex items-center justify-between p-3 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Agregar habilidad</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Buscar compañeros</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
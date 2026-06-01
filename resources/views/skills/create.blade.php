<x-app-layout>
    <div class="py-12 min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @error('name')
                <div class="mb-6 bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded">
                    {{ $message }}
                </div>
            @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="bg-[#111312] p-6 rounded-xl border border-gray-800 shadow-xl">
                    <h3 class="text-[#00e676] text-xl font-bold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        Habilidades Disponibles
                    </h3>
                    <p class="text-gray-400 text-sm mb-4">Selecciona una habilidad de la comunidad para añadirla a tu perfil.</p>

                    <div class="overflow-y-auto max-h-[400px] pr-2 custom-scrollbar">
                        <table class="w-full text-left text-gray-300 text-sm">
                            <thead class="sticky top-0 bg-[#111312]">
                                <tr class="border-b border-gray-700 text-gray-400">
                                    <th class="pb-2 font-medium">Habilidad</th>
                                    <th class="pb-2 font-medium">Categoría</th>
                                    <th class="pb-2 font-medium">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skills as $skill)
                                <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition-colors">
                                    <td class="py-3">{{ $skill->name }}</td>
                                    <td class="py-3 text-xs text-gray-500">{{ $skill->category }}</td>
                                    <td class="py-3">
                                        <form action="{{ route('user.skills.attach') }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="skill_id" value="{{ $skill->id }}">
                                            
                                            <select name="level" class="bg-[#1a1d1b] border border-gray-700 text-gray-300 text-xs rounded focus:ring-[#00e676] focus:border-[#00e676] p-1">
                                                <option value="Principiante">Principiante</option>
                                                <option value="Intermedio">Intermedio</option>
                                                <option value="Avanzado">Avanzado</option>
                                                <option value="Experto">Experto</option>
                                            </select>
                                            
                                            <button type="submit" class="text-[#00e676] hover:text-white font-bold text-xs bg-[#00e676]/10 px-2 py-1 rounded transition-colors">
                                                + Añadir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-center text-gray-500">No hay habilidades registradas. ¡Sé el primero en crear una!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-[#111312] p-6 rounded-xl border border-gray-800 shadow-xl h-fit">
                    <h3 class="text-[#00e676] text-xl font-bold mb-6 flex items-center">
                        <span class="mr-2">+</span> Añadir nueva habilidad
                    </h3>
                    
                    <form method="POST" action="{{ route('skills.store') }}">
                        @csrf

                        
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-gray-400 tracking-wider mb-2 uppercase">Nombre de la habilidad *</label>
                            <input type="text" name="name" required class="w-full bg-[#1a1d1b] border border-gray-700 text-gray-300 rounded-md focus:ring-[#00e676] focus:border-[#00e676] p-3 placeholder-gray-600" placeholder="Ej: Programación, Matemáticas, Inglés...">
                        </div>

                        <div class="mb-5">
                            <label class="block text-xs font-bold text-gray-400 tracking-wider mb-2 uppercase">Categoría</label>
                            <select name="category" class="w-full bg-[#1a1d1b] border border-gray-700 text-gray-300 rounded-md focus:ring-[#00e676] focus:border-[#00e676] p-3">
                                <option value="Tecnología">Tecnología</option>
                                <option value="Idiomas">Idiomas</option>
                                <option value="Ciencias Exactas">Ciencias Exactas</option>
                                <option value="Artes">Artes</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-bold text-gray-400 tracking-wider mb-2 uppercase">Tu nivel *</label>
                            <select name="level" class="w-full bg-[#1a1d1b] border border-gray-700 text-gray-300 rounded-md focus:ring-[#00e676] focus:border-[#00e676] p-3">
                                <option value="Principiante">Principiante</option>
                                <option value="Intermedio">Intermedio</option>
                                <option value="Avanzado">Avanzado</option>
                                <option value="Experto">Experto</option>
                            </select>
                        </div>

                        <div class="border-t border-gray-800 pt-5 flex justify-between items-center">
                            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm flex items-center transition-colors">
                                &larr; Cancelar
                            </a>
                            <button type="submit" class="bg-[#00e676] hover:bg-[#00c853] text-black font-bold py-2.5 px-6 rounded-md transition-colors flex items-center shadow-[0_0_15px_rgba(0,230,118,0.3)]">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Agregar habilidad
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
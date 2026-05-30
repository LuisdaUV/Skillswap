<x-guest-layout>

    <div class="mb-8">
        <h2 class="text-5xl font-bold text-gray-800 mb-2">
            Crear cuenta
        </h2>

        <p class="text-gray-500">
            Comparte habilidades y aprende de otros ✨
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <input type="text"
                   name="name"
                   placeholder="Nombre completo"
                   value="{{ old('name') }}"
                   required
                   class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 outline-none">

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <input type="email"
                   name="email"
                   placeholder="Correo institucional"
                   value="{{ old('email') }}"
                   required
                   class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 outline-none">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <input type="text"
                   name="university_id"
                   placeholder="Código universitario"
                   value="{{ old('university_id') }}"
                   required
                   class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 outline-none">

            <x-input-error :messages="$errors->get('university_id')" class="mt-2" />
        </div>

        <div>
            <input type="password"
                   name="password"
                   placeholder="Contraseña"
                   required
                   class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 outline-none">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <input type="password"
                   name="password_confirmation"
                   placeholder="Confirmar contraseña"
                   required
                   class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 outline-none">
        </div>

        <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-2xl font-semibold transition">
            Registrarse
        </button>

        <p class="text-center text-gray-600">
            ¿Ya tienes cuenta?

            <a href="{{ route('login') }}"
               class="text-purple-600 font-semibold">
                Inicia sesión
            </a>
        </p>

    </form>

</x-guest-layout>
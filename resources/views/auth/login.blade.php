<x-guest-layout>

    <div class="mb-8">
        <h2 class="text-5xl font-bold text-gray-800 mb-2">
            Iniciar sesión
        </h2>

        <p class="text-gray-500">
            Aprende enseñando 🚀
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- EMAIL -->
        <div>
            <label class="text-gray-700 font-medium">
                Correo electrónico
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   class="w-full mt-2 px-5 py-4 rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 outline-none transition">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="text-gray-700 font-medium">
                Contraseña
            </label>

            <input type="password"
                   name="password"
                   required
                   class="w-full mt-2 px-5 py-4 rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 outline-none transition">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- RECORDAR -->
        <div class="flex items-center justify-between">

            <label class="flex items-center gap-2 text-gray-600">
                <input type="checkbox"
                       name="remember"
                       class="rounded text-purple-600">

                Recordarme
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <!-- BOTÓN -->
        <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-4 rounded-2xl transition duration-300 shadow-lg hover:shadow-purple-300">

            Ingresar
        </button>

        <!-- REGISTRO -->
        <p class="text-center text-gray-600">
            ¿No tienes cuenta?

            <a href="{{ route('register') }}"
               class="text-purple-600 font-semibold hover:underline">
                Regístrate
            </a>
        </p>

    </form>

</x-guest-layout>
<x-guest-layout>
<style>
.gs-form-title {
    font-size: 22px;
    font-weight: 500;
    color: #e8f5ee;
    margin: 0 0 4px;
}

.gs-form-sub {
    font-size: 13px;
    color: #6b8c78;
    margin: 0 0 24px;
}

.gs-field { margin-bottom: 12px; }

.gs-input {
    display: block;
    width: 100%;
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 10px;
    padding: 11px 14px;
    font-size: 13px;
    color: #e8f5ee;
    font-family: inherit;
    outline: none;
    transition: border-color 0.15s;
}

.gs-input::placeholder { color: #3a4e40; }
.gs-input:focus { border-color: #2de88e; }

.gs-btn {
    width: 100%;
    background: #2de88e;
    color: #0a0f0c;
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-size: 14px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    transition: opacity 0.15s;
    margin-top: 4px;
    margin-bottom: 16px;
}

.gs-btn:hover { opacity: 0.88; }

.gs-footer-text {
    text-align: center;
    font-size: 13px;
    color: #6b8c78;
    margin: 0;
}

.gs-footer-text a { color: #2de88e; text-decoration: none; font-weight: 500; }
.gs-footer-text a:hover { text-decoration: underline; }

.gs-error {
    font-size: 11px;
    color: #e8836e;
    margin-top: 4px;
}
</style>

<p class="gs-form-title">Crear cuenta</p>
<p class="gs-form-sub">Comparte habilidades y aprende de otros</p>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="gs-field">
        <input type="text" name="name" placeholder="Nombre completo"
            value="{{ old('name') }}" required class="gs-input">
        @error('name') <p class="gs-error">{{ $message }}</p> @enderror
    </div>

    <div class="gs-field">
        <input type="email" name="email" placeholder="Correo institucional"
            value="{{ old('email') }}" required class="gs-input">
        @error('email') <p class="gs-error">{{ $message }}</p> @enderror
    </div>

    <div class="gs-field">
        <input type="text" name="university_id" placeholder="Código universitario"
            value="{{ old('university_id') }}" required class="gs-input">
        @error('university_id') <p class="gs-error">{{ $message }}</p> @enderror
    </div>

    <div class="gs-field">
        <input type="password" name="password" placeholder="Contraseña"
            required class="gs-input">
        @error('password') <p class="gs-error">{{ $message }}</p> @enderror
    </div>

    <div class="gs-field">
        <input type="password" name="password_confirmation"
            placeholder="Confirmar contraseña" required class="gs-input">
    </div>

    <button type="submit" class="gs-btn">Registrarse</button>

    <p class="gs-footer-text">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
    </p>
</form>
</x-guest-layout>
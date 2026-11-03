<x-guest-layout>
<style>
/* ── VARIABLES PALETA ACADÉMICA ── */
:root {
    --bg-app: #F4F6F8;
    --bg-surface: #FFFFFF;
    --navy-dark: #002B49;
    --blue-accent: #005A9C;
    --yellow-gold: #FFC700;
    --yellow-hover: #E6B200;
    --text-main: #0F172A;
    --text-muted: #64748B;
    --border-color: #CBD5E1;
    --danger: #DC2626;
}

.gs-form-title {
    font-size: 24px;
    font-weight: 800;
    color: var(--navy-dark);
    margin: 0 0 4px;
    letter-spacing: -0.5px;
}

.gs-form-sub {
    font-size: 14px;
    color: var(--text-muted);
    margin: 0 0 24px;
    font-weight: 500;
}

.gs-field { 
    margin-bottom: 14px; 
}

.gs-input {
    display: block;
    width: 100%;
    background: #FFFFFF;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 12px 14px;
    font-size: 14px;
    color: var(--text-main);
    font-family: inherit;
    outline: none;
    transition: all 0.2s ease;
    box-sizing: border-box;
}

.gs-input::placeholder { 
    color: #94A3B8; 
}

.gs-input:focus { 
    border-color: var(--blue-accent);
    box-shadow: 0 0 0 3px rgba(0, 90, 156, 0.15);
}

.gs-btn {
    width: 100%;
    background: var(--yellow-gold);
    color: var(--navy-dark);
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-size: 14px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 8px;
    margin-bottom: 20px;
}

.gs-btn:hover { 
    background: var(--yellow-hover); 
}

.gs-footer-text {
    text-align: center;
    font-size: 14px;
    color: var(--text-muted);
    margin: 0;
    font-weight: 500;
}

.gs-footer-text a { 
    color: var(--blue-accent); 
    text-decoration: none; 
    font-weight: 700; 
}

.gs-footer-text a:hover { 
    text-decoration: underline; 
}

.gs-error {
    font-size: 12px;
    color: var(--danger);
    margin-top: 4px;
    font-weight: 600;
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
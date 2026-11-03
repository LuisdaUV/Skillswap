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
    --success-bg: #E0F2FE;
    --success-text: #005A9C;
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

.gs-field { margin-bottom: 16px; }

.gs-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 6px;
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

.gs-input::placeholder { color: #94A3B8; }

.gs-input:focus { 
    border-color: var(--blue-accent); 
    box-shadow: 0 0 0 3px rgba(0, 90, 156, 0.15);
}

.gs-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    font-size: 13px;
}

.gs-remember {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-muted);
    font-weight: 500;
    cursor: pointer;
}

.gs-remember input { 
    accent-color: var(--navy-dark); 
    width: 16px;
    height: 16px;
    cursor: pointer;
}

.gs-forgot { 
    color: var(--blue-accent); 
    text-decoration: none; 
    font-weight: 600;
    transition: color 0.2s ease; 
}

.gs-forgot:hover { 
    text-decoration: underline; 
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
    margin-bottom: 18px;
}

.gs-btn:hover { background: var(--yellow-hover); }

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

.gs-footer-text a:hover { text-decoration: underline; }

.gs-status {
    background: var(--success-bg);
    border: 1px solid var(--blue-accent);
    color: var(--success-text);
    font-size: 13px;
    font-weight: 600;
    border-radius: 8px;
    padding: 10px 14px;
    margin-bottom: 18px;
}

.gs-error {
    font-size: 12px;
    color: var(--danger);
    margin-top: 4px;
    font-weight: 600;
}
</style>

<p class="gs-form-title">Iniciar sesión</p>
<p class="gs-form-sub">Aprende enseñando</p>

<x-auth-session-status :status="session('status')" class="gs-status" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="gs-field">
        <label for="email" class="gs-label">Correo electrónico</label>
        <input type="email" name="email" id="email"
            value="{{ old('email') }}" required autocomplete="email"
            class="gs-input" placeholder="tu@universidad.edu.co">
        @error('email') <p class="gs-error">{{ $message }}</p> @enderror
    </div>

    <div class="gs-field">
        <label for="password" class="gs-label">Contraseña</label>
        <input type="password" name="password" id="password"
            required autocomplete="current-password"
            class="gs-input" placeholder="••••••••">
        @error('password') <p class="gs-error">{{ $message }}</p> @enderror
    </div>

    <div class="gs-row">
        <label class="gs-remember">
            <input type="checkbox" name="remember">
            Recordarme
        </label>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="gs-forgot">¿Olvidaste tu contraseña?</a>
        @endif
    </div>

    <button type="submit" class="gs-btn">Ingresar</button>

    <p class="gs-footer-text">
        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
    </p>
</form>
</x-guest-layout>
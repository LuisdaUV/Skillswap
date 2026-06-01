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
    margin: 0 0 28px;
}

.gs-field { margin-bottom: 14px; }

.gs-label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    color: #6b8c78;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin-bottom: 6px;
}

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

.gs-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    font-size: 12px;
}

.gs-remember {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #6b8c78;
    cursor: pointer;
}

.gs-remember input { accent-color: #2de88e; }

.gs-forgot { color: #6b8c78; text-decoration: none; transition: color 0.15s; }
.gs-forgot:hover { color: #2de88e; }

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
    margin-bottom: 18px;
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

.gs-status {
    background: #2de88e18;
    border: 0.5px solid #2de88e40;
    color: #2de88e;
    font-size: 12px;
    border-radius: 8px;
    padding: 8px 12px;
    margin-bottom: 14px;
}

.gs-error {
    font-size: 11px;
    color: #e8836e;
    margin-top: 4px;
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
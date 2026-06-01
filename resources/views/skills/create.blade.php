<x-app-layout>
<style>
*, *::before, *::after { box-sizing: border-box; }

.sk-page { padding: 24px 20px; max-width: 560px; margin: 0 auto; }

.sk-card {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    padding: 24px;
}

.sk-page-title {
    font-size: 18px;
    font-weight: 500;
    color: #2de88e;
    margin: 0 0 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-page-title i { font-size: 18px; }

.sk-alert {
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 13px;
    margin-bottom: 16px;
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.sk-alert-success { background: #2de88e18; border: 0.5px solid #2de88e50; color: #2de88e; }
.sk-alert-error   { background: #e84b2d18; border: 0.5px solid #e84b2d50; color: #e8836e; }
.sk-alert ul { margin: 0; padding-left: 16px; }

.sk-field { margin-bottom: 16px; }

.sk-label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    color: #6b8c78;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin-bottom: 6px;
}

.sk-input, .sk-select {
    display: block;
    width: 100%;
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 9px;
    padding: 10px 12px;
    font-size: 13px;
    color: #e8f5ee;
    font-family: inherit;
    outline: none;
    transition: border-color 0.15s;
    appearance: none;
    -webkit-appearance: none;
}

.sk-input::placeholder { color: #6b8c78; }
.sk-input:focus, .sk-select:focus { border-color: #2de88e; }

.sk-select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b8c78' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 32px; }

.sk-select option { background: #141c17; color: #e8f5ee; }

.sk-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 0.5px solid #1e2e22;
}

.sk-cancel {
    font-size: 13px;
    color: #6b8c78;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.15s;
}

.sk-cancel:hover { color: #e8f5ee; }

.sk-btn {
    background: #2de88e;
    color: #0a0f0c;
    border: none;
    border-radius: 9px;
    padding: 9px 18px;
    font-size: 13px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: opacity 0.15s;
}

.sk-btn:hover { opacity: 0.88; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">
    <div class="sk-card">

        <p class="sk-page-title">
            <i class="ti ti-plus" aria-hidden="true"></i>
            Añadir nueva habilidad
        </p>

        @if(session('success'))
            <div class="sk-alert sk-alert-success">
                <i class="ti ti-circle-check" style="font-size:15px;flex-shrink:0" aria-hidden="true"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="sk-alert sk-alert-error">
                <i class="ti ti-alert-circle" style="font-size:15px;flex-shrink:0" aria-hidden="true"></i>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('skills.store') }}">
            @csrf

            <div class="sk-field">
                <label for="name" class="sk-label">Nombre de la habilidad *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="sk-input"
                    placeholder="Ej: Programación, Matemáticas, Inglés..." required>
            </div>

            <div class="sk-field">
                <label for="category" class="sk-label">Categoría</label>
                <select name="category" id="category" class="sk-select">
                    <option value="">Selecciona una categoría</option>
                    <option value="tecnologia">Tecnología</option>
                    <option value="idiomas">Idiomas</option>
                    <option value="ciencias">Ciencias</option>
                    <option value="arte">Arte y Diseño</option>
                    <option value="musica">Música</option>
                    <option value="deporte">Deporte</option>
                    <option value="otros">Otros</option>
                </select>
            </div>

            <div class="sk-field">
                <label for="level" class="sk-label">Tu nivel *</label>
                <select name="level" id="level" class="sk-select" required>
                    <option value="principiante">Principiante</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="avanzado">Avanzado</option>
                    <option value="experto">Experto</option>
                </select>
            </div>

            <div class="sk-actions">
                <a href="{{ route('skills.index') }}" class="sk-cancel">
                    <i class="ti ti-arrow-left" style="font-size:13px" aria-hidden="true"></i> Cancelar
                </a>
                <button type="submit" class="sk-btn">
                    <i class="ti ti-check" style="font-size:14px" aria-hidden="true"></i>
                    Agregar habilidad
                </button>
            </div>
        </form>

    </div>
</div>
</x-app-layout>
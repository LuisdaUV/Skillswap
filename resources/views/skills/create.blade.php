<x-app-layout>
<style>
*, *::before, *::after { box-sizing: border-box; }

.sk-page {
    padding: 24px 20px;
    max-width: 960px;
    margin: 0 auto;
}

.sk-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

@media (max-width: 700px) {
    .sk-grid { grid-template-columns: 1fr; }
}

.sk-card {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    padding: 20px;
}

/* Alertas */
.sk-alert {
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 13px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.sk-alert-success { background: #2de88e18; border: 0.5px solid #2de88e50; color: #2de88e; }
.sk-alert-error   { background: #e84b2d18; border: 0.5px solid #e84b2d50; color: #e8836e; }

/* Títulos de sección */
.sk-section-title {
    font-size: 12px;
    font-weight: 500;
    color: #2de88e;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    display: flex;
    align-items: center;
    gap: 7px;
    margin: 0 0 6px;
}

.sk-section-title i { font-size: 15px; }

.sk-section-sub {
    font-size: 12px;
    color: #6b8c78;
    margin: 0 0 16px;
}

/* Tabla de habilidades disponibles */
.sk-table-wrap {
    max-height: 380px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #1e2e22 transparent;
}

.sk-table-wrap::-webkit-scrollbar { width: 4px; }
.sk-table-wrap::-webkit-scrollbar-track { background: transparent; }
.sk-table-wrap::-webkit-scrollbar-thumb { background: #1e2e22; border-radius: 4px; }

.sk-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12.5px;
}

.sk-table thead tr {
    border-bottom: 0.5px solid #1e2e22;
    position: sticky;
    top: 0;
    background: #0f1410;
}

.sk-table th {
    padding: 8px 10px 10px;
    text-align: left;
    font-size: 10px;
    font-weight: 500;
    color: #6b8c78;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

.sk-table tbody tr {
    border-bottom: 0.5px solid #1e2e22;
    transition: background 0.12s;
}

.sk-table tbody tr:last-child { border-bottom: none; }
.sk-table tbody tr:hover { background: #141c17; }

.sk-table td { padding: 10px; color: #e8f5ee; vertical-align: middle; }
.sk-table td.cat { color: #6b8c78; font-size: 11px; }

/* Select inline en tabla */
.sk-select-sm {
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 6px;
    padding: 4px 8px;
    font-size: 11px;
    color: #e8f5ee;
    font-family: inherit;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
    transition: border-color 0.15s;
}

.sk-select-sm:focus { border-color: #2de88e; }
.sk-select-sm option { background: #141c17; }

.sk-btn-add {
    background: #2de88e18;
    color: #2de88e;
    border: 0.5px solid #2de88e40;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    transition: background 0.15s, color 0.15s;
    white-space: nowrap;
}

.sk-btn-add:hover { background: #2de88e; color: #0a0f0c; }

.sk-empty-row td {
    text-align: center;
    color: #6b8c78;
    padding: 28px;
    font-size: 13px;
}

/* Formulario nueva habilidad */
.sk-field { margin-bottom: 14px; }

.sk-label {
    display: block;
    font-size: 10px;
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

.sk-input::placeholder { color: #3a4e40; }
.sk-input:focus, .sk-select:focus { border-color: #2de88e; }

.sk-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b8c78' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 32px;
}

.sk-select option { background: #141c17; color: #e8f5ee; }

.sk-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 14px;
    border-top: 0.5px solid #1e2e22;
    margin-top: 8px;
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

.sk-btn-submit {
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

.sk-btn-submit:hover { opacity: 0.88; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    @if(session('success'))
        <div class="sk-alert sk-alert-success">
            <i class="ti ti-circle-check" style="font-size:15px;flex-shrink:0" aria-hidden="true"></i>
            {{ session('success') }}
        </div>
    @endif

    @error('name')
        <div class="sk-alert sk-alert-error">
            <i class="ti ti-alert-circle" style="font-size:15px;flex-shrink:0" aria-hidden="true"></i>
            {{ $message }}
        </div>
    @enderror

    <div class="sk-grid">

        {{-- ── Habilidades disponibles ── --}}
        <div class="sk-card">
            <p class="sk-section-title">
                <i class="ti ti-list-search" aria-hidden="true"></i>
                Habilidades disponibles
            </p>
            <p class="sk-section-sub">Selecciona una habilidad de la comunidad para añadirla a tu perfil.</p>

            <div class="sk-table-wrap">
                <table class="sk-table">
                    <thead>
                        <tr>
                            <th>Habilidad</th>
                            <th>Categoría</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                            <tr>
                                <td>{{ $skill->name }}</td>
                                <td class="cat">{{ $skill->category }}</td>
                                <td>
                                    <form action="{{ route('user.skills.attach') }}" method="POST"
                                        style="display:flex;align-items:center;gap:6px;">
                                        @csrf
                                        <input type="hidden" name="skill_id" value="{{ $skill->id }}">
                                        <select name="level" class="sk-select-sm">
                                            <option value="Principiante">Principiante</option>
                                            <option value="Intermedio">Intermedio</option>
                                            <option value="Avanzado">Avanzado</option>
                                            <option value="Experto">Experto</option>
                                        </select>
                                        <button type="submit" class="sk-btn-add">+ Añadir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="sk-empty-row">
                                <td colspan="3">No hay habilidades registradas. ¡Sé el primero en crear una!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── Nueva habilidad ── --}}
        <div class="sk-card">
            <p class="sk-section-title">
                <i class="ti ti-plus" aria-hidden="true"></i>
                Añadir nueva habilidad
            </p>
            <p class="sk-section-sub" style="margin-bottom:18px;">Crea una habilidad que aún no existe en la comunidad.</p>

            <form method="POST" action="{{ route('skills.store') }}">
                @csrf

                <div class="sk-field">
                    <label class="sk-label">Nombre de la habilidad *</label>
                    <input type="text" name="name" required class="sk-input"
                        placeholder="Ej: Programación, Matemáticas, Inglés...">
                </div>

                <div class="sk-field">
                    <label class="sk-label">Categoría</label>
                    <select name="category" class="sk-select">
                        <option value="Tecnología">Tecnología</option>
                        <option value="Idiomas">Idiomas</option>
                        <option value="Ciencias Exactas">Ciencias Exactas</option>
                        <option value="Artes">Artes</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="sk-field">
                    <label class="sk-label">Tu nivel *</label>
                    <select name="level" class="sk-select">
                        <option value="Principiante">Principiante</option>
                        <option value="Intermedio">Intermedio</option>
                        <option value="Avanzado">Avanzado</option>
                        <option value="Experto">Experto</option>
                    </select>
                </div>

                <div class="sk-actions">
                    <a href="{{ route('dashboard') }}" class="sk-cancel">
                        <i class="ti ti-arrow-left" style="font-size:13px" aria-hidden="true"></i> Cancelar
                    </a>
                    <button type="submit" class="sk-btn-submit">
                        <i class="ti ti-check" style="font-size:14px" aria-hidden="true"></i>
                        Agregar habilidad
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
</x-app-layout>
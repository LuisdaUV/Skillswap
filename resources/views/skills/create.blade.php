<x-app-layout>
<style>
/* ── VARIABLES PALETA ACADÉMICA ── */
:root {
    --bg-app: #F4F6F8;             /* Gris claro institucional */
    --bg-surface: #FFFFFF;         /* Blanco puro para tarjetas */
    --bg-surface-hover: #EBF3FA;   /* Azul ultra claro para hovers */
    --border-color: #CBD5E1;       /* Bordes nítidos */
    
    --navy-dark: #002B49;          /* Azul Marino Profundo */
    --blue-accent: #005A9C;        /* Azul Institucional */
    --yellow-gold: #FFC700;        /* Amarillo / Dorado Escolar */
    --yellow-hover: #E6B200;       /* Hover amarillo */
    
    --text-main: #0F172A;          /* Texto principal */
    --text-muted: #64748B;         /* Texto secundario */
    --danger: #DC2626;
    --danger-bg: #FEE2E2;
    --success: #059669;
    --success-bg: #D1FAE5;
}

*, *::before, *::after { box-sizing: border-box; }

.sk-page {
    padding: 24px 20px;
    max-width: 960px;
    margin: 0 auto;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: var(--text-main);
}

.sk-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

@media (max-width: 700px) {
    .sk-grid { grid-template-columns: 1fr; }
}

.sk-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 22px;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.04);
}

/* Alertas */
.sk-alert {
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.sk-alert-success { background: var(--success-bg); border: 1px solid var(--success); color: #065F46; }
.sk-alert-error   { background: var(--danger-bg); border: 1px solid var(--danger); color: #991B1B; }

/* Títulos de sección */
.sk-section-title {
    font-size: 13px;
    font-weight: 800;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0 0 6px;
}

.sk-section-title i { font-size: 18px; color: var(--blue-accent); }

.sk-section-sub {
    font-size: 13px;
    color: var(--text-muted);
    margin: 0 0 16px;
    line-height: 1.5;
}

/* Tabla de habilidades disponibles */
.sk-table-wrap {
    max-height: 380px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: var(--border-color) transparent;
}

.sk-table-wrap::-webkit-scrollbar { width: 6px; }
.sk-table-wrap::-webkit-scrollbar-track { background: transparent; }
.sk-table-wrap::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }

.sk-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.sk-table thead tr {
    border-bottom: 1px solid var(--border-color);
    position: sticky;
    top: 0;
    background: var(--bg-surface);
    z-index: 1;
}

.sk-table th {
    padding: 10px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sk-table tbody tr {
    border-bottom: 1px solid var(--border-color);
    transition: background 0.15s;
}

.sk-table tbody tr:last-child { border-bottom: none; }
.sk-table tbody tr:hover { background: var(--bg-surface-hover); }

.sk-table td { padding: 10px; color: var(--text-main); font-weight: 500; vertical-align: middle; }
.sk-table td.cat { color: var(--text-muted); font-size: 12px; }

/* Select inline en tabla */
.sk-select-sm {
    background: #FFFFFF;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    padding: 6px 8px;
    font-size: 12px;
    color: var(--text-main);
    font-family: inherit;
    outline: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.sk-select-sm:focus { border-color: var(--blue-accent); }

.sk-btn-add {
    background: var(--yellow-gold);
    color: var(--navy-dark);
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    transition: background-color 0.2s ease;
    white-space: nowrap;
}

.sk-btn-add:hover { background: var(--yellow-hover); }

.sk-empty-row td {
    text-align: center;
    color: var(--text-muted);
    padding: 28px;
    font-size: 13px;
}

/* Formulario nueva habilidad */
.sk-field { margin-bottom: 16px; }

.sk-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 6px;
}

.sk-input, .sk-select {
    display: block;
    width: 100%;
    background: #FFFFFF;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    color: var(--text-main);
    font-family: inherit;
    outline: none;
    transition: all 0.2s ease;
    appearance: none;
    -webkit-appearance: none;
    box-sizing: border-box;
    height: 42px;
}

.sk-input::placeholder { color: #94A3B8; }
.sk-input:focus, .sk-select:focus { 
    border-color: var(--blue-accent); 
    box-shadow: 0 0 0 3px rgba(0, 90, 156, 0.15);
}

.sk-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23005A9C' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
}

.sk-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
    margin-top: 12px;
}

.sk-cancel {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s ease;
}

.sk-cancel:hover { color: var(--navy-dark); }

.sk-btn-submit {
    background: var(--yellow-gold);
    color: var(--navy-dark);
    border: none;
    border-radius: 8px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background-color 0.2s ease;
}

.sk-btn-submit:hover { background: var(--yellow-hover); }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    @if(session('success'))
        <div class="sk-alert sk-alert-success">
            <i class="ti ti-circle-check" style="font-size:18px;flex-shrink:0" aria-hidden="true"></i>
            {{ session('success') }}
        </div>
    @endif

    @error('name')
        <div class="sk-alert sk-alert-error">
            <i class="ti ti-alert-circle" style="font-size:18px;flex-shrink:0" aria-hidden="true"></i>
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
                        <i class="ti ti-arrow-left" style="font-size:15px" aria-hidden="true"></i> Cancelar
                    </a>
                    <button type="submit" class="sk-btn-submit">
                        <i class="ti ti-check" style="font-size:16px" aria-hidden="true"></i>
                        Agregar habilidad
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
</x-app-layout>
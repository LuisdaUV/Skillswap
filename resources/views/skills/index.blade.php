<x-app-layout>
<style>
*, *::before, *::after { box-sizing: border-box; }

.sk-page { padding: 24px 20px; max-width: 860px; margin: 0 auto; }

.sk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.sk-page-title {
    font-size: 18px;
    font-weight: 500;
    color: #2de88e;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-btn-new {
    background: #2de88e;
    color: #0a0f0c;
    border: none;
    border-radius: 9px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: opacity 0.15s;
}

.sk-btn-new:hover { opacity: 0.88; }

.sk-card {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    overflow: hidden;
}

.sk-alert {
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 13px;
    margin: 16px 16px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-alert-success { background: #2de88e18; border: 0.5px solid #2de88e50; color: #2de88e; }
.sk-alert-error   { background: #e84b2d18; border: 0.5px solid #e84b2d50; color: #e8836e; }

/* Tabla */
.sk-table { width: 100%; border-collapse: collapse; }

.sk-table thead tr {
    border-bottom: 0.5px solid #1e2e22;
}

.sk-table th {
    padding: 12px 16px;
    text-align: left;
    font-size: 10px;
    font-weight: 500;
    color: #6b8c78;
    text-transform: uppercase;
    letter-spacing: 0.07em;
}

.sk-table tbody tr {
    border-bottom: 0.5px solid #1e2e22;
    transition: background 0.1s;
}

.sk-table tbody tr:last-child { border-bottom: none; }
.sk-table tbody tr:hover { background: #141c17; }

.sk-table td {
    padding: 13px 16px;
    font-size: 13px;
    color: #e8f5ee;
    vertical-align: middle;
}

.sk-table td.muted { color: #6b8c78; }

/* Badge de nivel */
.sk-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 500;
}

.sk-badge-principiante { background: #2de88e18; color: #2de88e; border: 0.5px solid #2de88e40; }
.sk-badge-intermedio   { background: #3d9be918; color: #3d9be9; border: 0.5px solid #3d9be940; }
.sk-badge-avanzado     { background: #e8a02d18; color: #e8a02d; border: 0.5px solid #e8a02d40; }
.sk-badge-experto      { background: #b06de818; color: #b06de8; border: 0.5px solid #b06de840; }

/* Acciones */
.sk-action-edit {
    font-size: 12px;
    color: #6b8c78;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 6px;
    border: 0.5px solid #1e2e22;
    transition: all 0.15s;
}

.sk-action-edit:hover { border-color: #2de88e; color: #2de88e; }

.sk-action-delete {
    font-size: 12px;
    color: #6b8c78;
    background: none;
    border: 0.5px solid #1e2e22;
    border-radius: 6px;
    padding: 4px 10px;
    cursor: pointer;
    font-family: inherit;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.15s;
    margin-left: 6px;
}

.sk-action-delete:hover { border-color: #e84b2d; color: #e84b2d; }

/* Empty state */
.sk-empty {
    padding: 48px 20px;
    text-align: center;
}

.sk-empty-icon { font-size: 32px; color: #1e2e22; margin-bottom: 12px; }
.sk-empty-text { font-size: 14px; color: #6b8c78; margin: 0 0 14px; }

.sk-empty-link {
    color: #2de88e;
    text-decoration: none;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.sk-empty-link:hover { text-decoration: underline; }

.sk-back {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    color: #6b8c78;
    text-decoration: none;
    margin-top: 16px;
    transition: color 0.15s;
}

.sk-back:hover { color: #2de88e; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    <div class="sk-header">
        <p class="sk-page-title">
            <i class="ti ti-books" aria-hidden="true"></i>
            Mis habilidades
        </p>
        <a href="{{ route('skills.create') }}" class="sk-btn-new">
            <i class="ti ti-plus" style="font-size:14px" aria-hidden="true"></i>
            Nueva habilidad
        </a>
    </div>

    <div class="sk-card">

        @if(session('success'))
            <div class="sk-alert sk-alert-success">
                <i class="ti ti-circle-check" style="font-size:15px" aria-hidden="true"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="sk-alert sk-alert-error">
                <i class="ti ti-alert-circle" style="font-size:15px" aria-hidden="true"></i>
                {{ session('error') }}
            </div>
        @endif

        @php $skills = Auth::user()->skills; @endphp

        @if($skills->count() > 0)
            <table class="sk-table">
                <thead>
                    <tr>
                        <th>Habilidad</th>
                        <th>Categoría</th>
                        <th>Nivel</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                        <tr>
                            <td>{{ $skill->name }}</td>
                            <td class="muted">{{ $skill->category ?? '—' }}</td>
                            <td>
                                <span class="sk-badge sk-badge-{{ $skill->pivot->level ?? 'intermedio' }}">
                                    {{ ucfirst($skill->pivot->level ?? 'intermedio') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('skills.edit', $skill->id) }}" class="sk-action-edit">
                                    <i class="ti ti-edit" style="font-size:13px" aria-hidden="true"></i> Editar
                                </a>
                                <form method="POST" action="{{ route('skills.destroy', $skill->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="sk-action-delete"
                                        onclick="return confirm('¿Eliminar {{ $skill->name }}?')">
                                        <i class="ti ti-trash" style="font-size:13px" aria-hidden="true"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="sk-empty">
                <div class="sk-empty-icon">
                    <i class="ti ti-books" aria-hidden="true"></i>
                </div>
                <p class="sk-empty-text">Aún no tienes habilidades registradas</p>
                <a href="{{ route('skills.create') }}" class="sk-empty-link">
                    <i class="ti ti-plus" style="font-size:13px" aria-hidden="true"></i>
                    Agrega tu primera habilidad
                </a>
            </div>
        @endif

    </div>

    <a href="{{ route('dashboard') }}" class="sk-back">
        <i class="ti ti-arrow-left" style="font-size:13px" aria-hidden="true"></i> Volver al dashboard
    </a>

</div>
</x-app-layout>
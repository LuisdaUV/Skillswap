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
    max-width: 860px; 
    margin: 0 auto; 
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: var(--text-main);
}

.sk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    background: var(--navy-dark);
    padding: 16px 20px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.08);
}

.sk-page-title {
    font-size: 16px;
    font-weight: 800;
    color: #FFFFFF;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-btn-new {
    background: var(--yellow-gold);
    color: var(--navy-dark);
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background-color 0.2s ease;
}

.sk-btn-new:hover { background: var(--yellow-hover); }

.sk-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.04);
}

.sk-alert {
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 600;
    margin: 16px 16px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-alert-success { background: var(--success-bg); border: 1px solid var(--success); color: #065F46; }
.sk-alert-error   { background: var(--danger-bg); border: 1px solid var(--danger); color: #991B1B; }

/* Tabla */
.sk-table { width: 100%; border-collapse: collapse; }

.sk-table thead tr {
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-app);
}

.sk-table th {
    padding: 12px 16px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sk-table tbody tr {
    border-bottom: 1px solid var(--border-color);
    transition: background 0.15s ease;
}

.sk-table tbody tr:last-child { border-bottom: none; }
.sk-table tbody tr:hover { background: var(--bg-surface-hover); }

.sk-table td {
    padding: 14px 16px;
    font-size: 14px;
    color: var(--text-main);
    font-weight: 500;
    vertical-align: middle;
}

.sk-table td.muted { color: var(--text-muted); }

/* Badge de nivel */
.sk-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sk-badge-principiante { background: #E0F2FE; color: #0369A1; border: 1px solid rgba(3, 105, 161, 0.2); }
.sk-badge-intermedio   { background: #FEF3C7; color: #92400E; border: 1px solid rgba(146, 64, 14, 0.2); }
.sk-badge-avanzado     { background: #DCFCE7; color: #15803D; border: 1px solid rgba(21, 128, 61, 0.2); }
.sk-badge-experto      { background: #F3E8FF; color: #6B21A8; border: 1px solid rgba(107, 33, 168, 0.2); }

/* Acciones */
.sk-action-edit {
    font-size: 12px;
    font-weight: 600;
    color: var(--blue-accent);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid var(--border-color);
    background: var(--bg-app);
    transition: all 0.2s ease;
}

.sk-action-edit:hover { 
    border-color: var(--blue-accent); 
    background: var(--bg-surface-hover); 
}

.sk-action-delete {
    font-size: 12px;
    font-weight: 600;
    color: var(--danger);
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    border-radius: 6px;
    padding: 6px 12px;
    cursor: pointer;
    font-family: inherit;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
    margin-left: 6px;
}

.sk-action-delete:hover { 
    border-color: var(--danger); 
    background: var(--danger-bg); 
}

/* Empty state */
.sk-empty {
    padding: 48px 20px;
    text-align: center;
}

.sk-empty-icon { font-size: 36px; color: var(--text-muted); margin-bottom: 12px; }
.sk-empty-text { font-size: 14px; font-weight: 600; color: var(--text-muted); margin: 0 0 14px; }

.sk-empty-link {
    color: var(--blue-accent);
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.sk-empty-link:hover { text-decoration: underline; }

.sk-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    text-decoration: none;
    margin-top: 16px;
    transition: color 0.2s ease;
}

.sk-back:hover { color: var(--navy-dark); }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    <div class="sk-header">
        <p class="sk-page-title">
            <i class="ti ti-books" style="color: var(--yellow-gold); font-size: 20px;" aria-hidden="true"></i>
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
                <i class="ti ti-circle-check" style="font-size:18px" aria-hidden="true"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="sk-alert sk-alert-error">
                <i class="ti ti-alert-circle" style="font-size:18px" aria-hidden="true"></i>
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
                                <span class="sk-badge sk-badge-{{ strtolower($skill->pivot->level ?? 'intermedio') }}">
                                    {{ ucfirst($skill->pivot->level ?? 'intermedio') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('skills.edit', $skill->id) }}" class="sk-action-edit">
                                    <i class="ti ti-edit" style="font-size:14px" aria-hidden="true"></i> Editar
                                </a>
                                <form method="POST" action="{{ route('skills.destroy', $skill->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="sk-action-delete"
                                        onclick="return confirm('¿Eliminar {{ $skill->name }}?')">
                                        <i class="ti ti-trash" style="font-size:14px" aria-hidden="true"></i> Eliminar
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
                    <i class="ti ti-plus" style="font-size:14px" aria-hidden="true"></i>
                    Agrega tu primera habilidad
                </a>
            </div>
        @endif

    </div>

    <a href="{{ route('dashboard') }}" class="sk-back">
        <i class="ti ti-arrow-left" style="font-size:15px" aria-hidden="true"></i> Volver al dashboard
    </a>

</div>
</x-app-layout>
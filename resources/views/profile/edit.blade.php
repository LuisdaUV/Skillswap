<x-app-layout>
<style>
/* ── VARIABLES PALETA ACADÉMICA ── */
:root {
    --bg-app: #F4F6F8;             /* Gris claro institucional */
    --bg-surface: #FFFFFF;         /* Blanco puro para tarjetas */
    --bg-surface-hover: #EBF3FA;   /* Azul ultra claro para hovers */
    --border-color: #CBD5E1;       /* Bordes definidos */
    
    --navy-dark: #002B49;          /* Azul Marino Profundo */
    --blue-accent: #005A9C;        /* Azul Institucional */
    --yellow-gold: #FFC700;        /* Amarillo / Dorado Escolar */
    
    --text-main: #0F172A;          /* Texto principal */
    --text-muted: #64748B;         /* Texto secundario */
}

*, *::before, *::after { box-sizing: border-box; }

.sk-page { 
    padding: 24px 20px; 
    max-width: 860px; 
    margin: 0 auto; 
    display: flex; 
    flex-direction: column; 
    gap: 16px; 
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: var(--text-main);
}

.sk-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.04);
}

/* ── HERO DE PERFIL ── */
.sk-profile-hero {
    display: flex;
    align-items: center;
    gap: 20px;
}

.sk-avatar-lg {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: var(--navy-dark);
    border: 2px solid var(--navy-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: 800;
    color: #FFFFFF;
    flex-shrink: 0;
    text-transform: uppercase;
}

.sk-profile-name {
    font-size: 22px;
    font-weight: 800;
    color: var(--navy-dark);
    margin: 0 0 3px;
    letter-spacing: -0.5px;
}

.sk-profile-email { 
    font-size: 14px; 
    color: var(--text-muted); 
    margin: 0 0 10px; 
    font-weight: 500;
}

.sk-badges { display: flex; flex-wrap: wrap; gap: 8px; }

.sk-badge-pill {
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 99px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.sk-badge-verified { background: #E0F2FE; color: var(--blue-accent); border: 1px solid rgba(0, 90, 156, 0.2); }
.sk-badge-credits  { background: #FEF3C7; color: #92400E; border: 1px solid rgba(255, 199, 0, 0.4); }
.sk-badge-code     { background: #F1F5F9; color: var(--navy-dark); border: 1px solid var(--border-color); font-family: monospace; }

/* ── INFO DE CUENTA ── */
.sk-section-label {
    font-size: 12px;
    font-weight: 800;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0 0 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color);
    font-size: 14px;
}

.sk-info-row:last-child { border-bottom: none; padding-bottom: 0; }
.sk-info-key  { color: var(--text-muted); font-weight: 500; }
.sk-info-val  { color: var(--text-main); font-weight: 600; }
.sk-info-val.accent { color: var(--blue-accent); font-weight: 700; font-family: monospace; }

/* ── ESTADÍSTICAS ── */
.sk-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

@media (max-width: 600px) { .sk-stats-grid { grid-template-columns: 1fr; } }

.sk-stat-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.04);
}

.sk-stat-num { font-size: 30px; font-weight: 800; color: var(--navy-dark); margin: 0 0 4px; }
.sk-stat-label { font-size: 13px; font-weight: 600; color: var(--text-muted); margin: 0; }

/* ── HABILIDADES ── */
.sk-skills-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.sk-btn-sm {
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    color: var(--navy-dark);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
}

.sk-btn-sm:hover { border-color: var(--blue-accent); color: var(--blue-accent); background: var(--bg-surface-hover); }

.sk-tags { display: flex; flex-wrap: wrap; gap: 8px; }

.sk-tag {
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    color: var(--text-main);
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 99px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.sk-tag-level { color: var(--blue-accent); font-size: 12px; font-weight: 700; }

.sk-empty-inline {
    font-size: 14px;
    color: var(--text-muted);
    padding: 20px;
    text-align: center;
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    border-radius: 8px;
}

.sk-manage-link {
    display: flex;
    justify-content: flex-end;
    margin-top: 16px;
}

.sk-manage-link a {
    font-size: 13px;
    font-weight: 700;
    color: var(--blue-accent);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s ease;
}

.sk-manage-link a:hover { text-decoration: underline; }

.sk-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-muted);
    text-decoration: none;
    margin-top: 8px;
    transition: color 0.2s ease;
}

.sk-back:hover { color: var(--navy-dark); }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    {{-- Hero --}}
    <div class="sk-card">
        <div class="sk-profile-hero">
            <div class="sk-avatar-lg">{{ substr(Auth::user()->name, 0, 2) }}</div>
            <div>
                <p class="sk-profile-name">{{ Auth::user()->name }}</p>
                <p class="sk-profile-email">{{ Auth::user()->email }}</p>
                <div class="sk-badges">
                    <span class="sk-badge-pill sk-badge-verified">
                        <i class="ti ti-circle-check" style="font-size:14px" aria-hidden="true"></i>
                        Estudiante verificado
                    </span>
                    <span class="sk-badge-pill sk-badge-credits">
                        <i class="ti ti-coin" style="font-size:14px" aria-hidden="true"></i>
                        {{ Auth::user()->credits ?? 3 }} créditos
                    </span>
                    <span class="sk-badge-pill sk-badge-code">
                        <i class="ti ti-id-badge" style="font-size:14px" aria-hidden="true"></i>
                        {{ Auth::user()->university_id }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Info de cuenta --}}
    <div class="sk-card">
        <p class="sk-section-label">
            <i class="ti ti-user" aria-hidden="true"></i> Información de la cuenta
        </p>
        <div class="sk-info-row">
            <span class="sk-info-key">Nombre completo</span>
            <span class="sk-info-val">{{ $user->name }}</span>
        </div>
        <div class="sk-info-row">
            <span class="sk-info-key">Correo electrónico</span>
            <span class="sk-info-val">{{ $user->email }}</span>
        </div>
        <div class="sk-info-row">
            <span class="sk-info-key">Código de estudiante</span>
            <span class="sk-info-val accent">{{ $user->university_id }}</span>
        </div>
    </div>

    {{-- Estadísticas --}}
    <div class="sk-stats-grid">
        <div class="sk-stat-card">
            <p class="sk-stat-num">{{ \App\Models\Skill::count() }}</p>
            <p class="sk-stat-label">Habilidades totales</p>
        </div>
        <div class="sk-stat-card">
            <p class="sk-stat-num">0</p>
            <p class="sk-stat-label">Intercambios realizados</p>
        </div>
        <div class="sk-stat-card">
            <p class="sk-stat-num">0.0</p>
            <p class="sk-stat-label">Calificación promedio</p>
        </div>
    </div>

    {{-- Habilidades --}}
    <div class="sk-card">
        <div class="sk-skills-header">
            <p class="sk-section-label" style="margin:0">
                <i class="ti ti-trophy" aria-hidden="true"></i> Mis habilidades
            </p>
            <a href="{{ route('skills.create') }}" class="sk-btn-sm">
                <i class="ti ti-plus" style="font-size:14px" aria-hidden="true"></i> Agregar
            </a>
        </div>

        @php $userSkills = Auth::user()->skills; @endphp

        @if($userSkills->count() > 0)
            <div class="sk-tags">
                @foreach($userSkills as $skill)
                    <span class="sk-tag">
                        {{ $skill->name }}
                        <span class="sk-tag-level">({{ $skill->pivot->level ?? 'intermedio' }})</span>
                    </span>
                @endforeach
            </div>
        @else
            <div class="sk-empty-inline">Aún no tienes habilidades registradas</div>
        @endif

        <div class="sk-manage-link">
            <a href="{{ route('skills.index') }}">
                Administrar habilidades <i class="ti ti-arrow-right" style="font-size:14px" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="sk-back">
        <i class="ti ti-arrow-left" style="font-size:16px" aria-hidden="true"></i> Volver al dashboard
    </a>

</div>
</x-app-layout>
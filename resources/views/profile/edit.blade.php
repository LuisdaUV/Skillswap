<x-app-layout>
<style>
*, *::before, *::after { box-sizing: border-box; }

.sk-page { padding: 24px 20px; max-width: 860px; margin: 0 auto; display: flex; flex-direction: column; gap: 12px; }

.sk-card {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    padding: 20px;
}

/* Hero de perfil */
.sk-profile-hero {
    display: flex;
    align-items: center;
    gap: 18px;
}

.sk-avatar-lg {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #2de88e22;
    border: 2px solid #2de88e;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: 500;
    color: #2de88e;
    flex-shrink: 0;
    text-transform: uppercase;
}

.sk-profile-name {
    font-size: 20px;
    font-weight: 500;
    color: #e8f5ee;
    margin: 0 0 3px;
}

.sk-profile-email { font-size: 13px; color: #6b8c78; margin: 0 0 8px; }

.sk-badges { display: flex; flex-wrap: wrap; gap: 6px; }

.sk-badge-pill {
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 99px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.sk-badge-verified { background: #2de88e18; color: #2de88e; border: 0.5px solid #2de88e40; }
.sk-badge-credits  { background: #3d9be918; color: #3d9be9; border: 0.5px solid #3d9be940; }
.sk-badge-code     { background: #b06de818; color: #b06de8; border: 0.5px solid #b06de840; }

/* Info de cuenta */
.sk-section-label {
    font-size: 11px;
    font-weight: 500;
    color: #2de88e;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin: 0 0 14px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.sk-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 11px 0;
    border-bottom: 0.5px solid #1e2e22;
    font-size: 13px;
}

.sk-info-row:last-child { border-bottom: none; padding-bottom: 0; }
.sk-info-key  { color: #6b8c78; }
.sk-info-val  { color: #e8f5ee; font-weight: 500; }
.sk-info-val.accent { color: #2de88e; }

/* Estadísticas */
.sk-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

@media (max-width: 600px) { .sk-stats-grid { grid-template-columns: 1fr; } }

.sk-stat-card {
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 12px;
    padding: 16px;
    text-align: center;
}

.sk-stat-num { font-size: 28px; font-weight: 500; color: #2de88e; margin: 0 0 4px; }
.sk-stat-label { font-size: 12px; color: #6b8c78; margin: 0; }

/* Habilidades */
.sk-skills-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.sk-btn-sm {
    background: none;
    border: 0.5px solid #1e2e22;
    border-radius: 8px;
    padding: 5px 12px;
    font-size: 12px;
    color: #6b8c78;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: border-color 0.15s, color 0.15s;
}

.sk-btn-sm:hover { border-color: #2de88e; color: #2de88e; }

.sk-tags { display: flex; flex-wrap: wrap; gap: 6px; }

.sk-tag {
    background: #141c17;
    border: 0.5px solid #1e2e22;
    color: #c8e8d4;
    font-size: 12px;
    padding: 4px 12px;
    border-radius: 99px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.sk-tag-level { color: #2de88e; font-size: 11px; }

.sk-empty-inline {
    font-size: 13px;
    color: #6b8c78;
    padding: 16px;
    text-align: center;
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 9px;
}

.sk-manage-link {
    display: flex;
    justify-content: flex-end;
    margin-top: 12px;
}

.sk-manage-link a {
    font-size: 12px;
    color: #6b8c78;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.15s;
}

.sk-manage-link a:hover { color: #2de88e; }
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
                        <i class="ti ti-circle-check" style="font-size:12px" aria-hidden="true"></i>
                        Estudiante verificado
                    </span>
                    <span class="sk-badge-pill sk-badge-credits">
                        <i class="ti ti-coin" style="font-size:12px" aria-hidden="true"></i>
                        {{ Auth::user()->credits ?? 3 }} créditos
                    </span>
                    <span class="sk-badge-pill sk-badge-code">
                        <i class="ti ti-id-badge" style="font-size:12px" aria-hidden="true"></i>
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
                <i class="ti ti-plus" style="font-size:12px" aria-hidden="true"></i> Agregar
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
                Administrar habilidades <i class="ti ti-arrow-right" style="font-size:12px" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="sk-back">
        <i class="ti ti-arrow-left" style="font-size:13px" aria-hidden="true"></i> Volver al dashboard
    </a>

</div>
</x-app-layout>
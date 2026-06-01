<x-app-layout>
<style>
*, *::before, *::after { box-sizing: border-box; }

.sk-page { padding: 24px 20px; max-width: 900px; margin: 0 auto; }

.sk-top {
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

.sk-back {
    font-size: 12px;
    color: #6b8c78;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.15s;
}

.sk-back:hover { color: #2de88e; }

.sk-card {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    padding: 14px 18px;
    margin-bottom: 12px;
}

.sk-summary { font-size: 13px; color: #6b8c78; }
.sk-summary strong { color: #e8f5ee; font-weight: 500; }

/* Bloque por habilidad */
.sk-skill-block { margin-bottom: 12px; }

.sk-skill-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.sk-skill-name {
    font-size: 14px;
    font-weight: 500;
    color: #2de88e;
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
}

.sk-count {
    font-size: 11px;
    color: #6b8c78;
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 99px;
    padding: 3px 10px;
}

/* Cards de usuarios */
.sk-users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 8px;
}

.sk-user-card {
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 12px;
    padding: 14px;
    transition: border-color 0.15s;
}

.sk-user-card:hover { border-color: #2de88e40; }

.sk-user-top {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.sk-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #2de88e22;
    border: 1.5px solid #2de88e;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 500;
    color: #2de88e;
    flex-shrink: 0;
    text-transform: uppercase;
}

.sk-user-name { font-size: 13px; font-weight: 500; color: #e8f5ee; margin: 0 0 2px; }
.sk-user-code { font-size: 11px; color: #6b8c78; margin: 0; }

.sk-level-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 500;
    margin-bottom: 10px;
}

.sk-level-principiante { background: #2de88e18; color: #2de88e; border: 0.5px solid #2de88e40; }
.sk-level-intermedio   { background: #3d9be918; color: #3d9be9; border: 0.5px solid #3d9be940; }
.sk-level-avanzado     { background: #e8a02d18; color: #e8a02d; border: 0.5px solid #e8a02d40; }
.sk-level-experto      { background: #b06de818; color: #b06de8; border: 0.5px solid #b06de840; }

.sk-btn-swap {
    width: 100%;
    background: #2de88e;
    color: #0a0f0c;
    border: none;
    border-radius: 8px;
    padding: 8px;
    font-size: 12px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    transition: opacity 0.15s;
}

.sk-btn-swap:hover { opacity: 0.88; }

/* Empty */
.sk-empty {
    text-align: center;
    padding: 48px 20px;
}

.sk-empty i { font-size: 36px; color: #1e2e22; margin-bottom: 12px; display: block; }
.sk-empty-title { font-size: 15px; font-weight: 500; color: #e8f5ee; margin: 0 0 6px; }
.sk-empty-sub   { font-size: 13px; color: #6b8c78; margin: 0 0 16px; }
.sk-empty-link  { color: #2de88e; text-decoration: none; font-size: 13px; }
.sk-empty-link:hover { text-decoration: underline; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    <div class="sk-top">
        <p class="sk-page-title">
            <i class="ti ti-search" aria-hidden="true"></i>
            Resultados de búsqueda
        </p>
        <a href="{{ route('search.index') }}" class="sk-back">
            <i class="ti ti-arrow-left" style="font-size:13px" aria-hidden="true"></i> Nueva búsqueda
        </a>
    </div>

    {{-- Resumen --}}
    @if($query || $category)
        <div class="sk-card">
            <p class="sk-summary" style="margin:0">
                @if($query) Búsqueda: <strong>"{{ $query }}"</strong> @endif
                @if($query && $category) &nbsp;·&nbsp; @endif
                @if($category) Categoría: <strong>{{ $category }}</strong> @endif
            </p>
        </div>
    @endif

    {{-- Resultados --}}
    @if(count($results) > 0)
        @foreach($results as $result)
            <div class="sk-card sk-skill-block">
                <div class="sk-skill-header">
                    <p class="sk-skill-name">
                        <i class="ti ti-sparkles" style="font-size:14px" aria-hidden="true"></i>
                        {{ $result['skill']->name }}
                    </p>
                    <span class="sk-count">{{ $result['users']->count() }} compañeros</span>
                </div>

                <div class="sk-users-grid">
                    @foreach($result['users'] as $user)
                        <div class="sk-user-card">
                            <div class="sk-user-top">
                                <div class="sk-avatar">{{ substr($user->name, 0, 2) }}</div>
                                <div>
                                    <p class="sk-user-name">{{ $user->name }}</p>
                                    <p class="sk-user-code">{{ $user->university_id }}</p>
                                </div>
                            </div>

                            <div class="sk-level-badge sk-level-{{ $user->pivot->level ?? 'intermedio' }}">
                                Nivel: {{ ucfirst($user->pivot->level ?? 'intermedio') }}
                            </div>

                            <button onclick="solicitarIntercambio({{ $user->id }}, {{ $result['skill']->id }})"
                                class="sk-btn-swap">
                                <i class="ti ti-switch-horizontal" style="font-size:13px" aria-hidden="true"></i>
                                Solicitar intercambio
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="sk-card">
            <div class="sk-empty">
                <i class="ti ti-mood-sad" aria-hidden="true"></i>
                <p class="sk-empty-title">Sin resultados</p>
                <p class="sk-empty-sub">No hay compañeros que ofrezcan esta habilidad todavía</p>
                <a href="{{ route('search.index') }}" class="sk-empty-link">Realizar otra búsqueda</a>
            </div>
        </div>
    @endif

</div>
</x-app-layout>
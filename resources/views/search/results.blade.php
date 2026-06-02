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

/* Nuevos Estilos para el Modal e Intercambio (Alineados a tu diseño) */
.sk-alert {
    background: rgba(45, 232, 142, 0.08);
    border: 0.5px solid #2de88e;
    color: #2de88e;
    border-radius: 10px;
    padding: 12px 16px;
    margin-bottom: 16px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 16px;
}

.sk-modal {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    padding: 20px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    text-align: left;
}

.sk-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.sk-modal-title {
    font-size: 15px;
    font-weight: 500;
    color: #2de88e;
    margin: 0;
}

.sk-modal-close {
    background: none;
    border: none;
    color: #6b8c78;
    font-size: 20px;
    cursor: pointer;
    line-height: 1;
}

.sk-modal-close:hover { color: #e8f5ee; }

.sk-modal-text {
    font-size: 13px;
    color: #6b8c78;
    margin: 0 0 16px 0;
    line-height: 1.5;
}

.sk-modal-text strong { color: #e8f5ee; font-weight: 500; }

.sk-form-group { margin-bottom: 18px; }

.sk-label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    color: #6b8c78;
    text-transform: uppercase;
    margin-bottom: 6px;
    letter-spacing: 0.5px;
}

.sk-select {
    width: 100%;
    background: #141c17;
    border: 0.5px solid #1e2e22;
    color: #e8f5ee;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 13px;
    font-family: inherit;
    outline: none;
    cursor: pointer;
}

.sk-select:focus { border-color: #2de88e; }

.sk-modal-actions {
    display: flex;
    gap: 8px;
}

.sk-btn-cancel {
    flex: 1;
    background: transparent;
    border: 0.5px solid #1e2e22;
    color: #6b8c78;
    border-radius: 8px;
    padding: 8px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.15s;
}

.sk-btn-cancel:hover { border-color: #6b8c78; color: #e8f5ee; }
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

    {{-- Banner de Éxito --}}
    @if(session('success'))
        <div class="sk-alert">
            <i class="ti ti-circle-check" style="font-size:16px" aria-hidden="true"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

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
                        {{-- Cada tarjeta de usuario inicializa su propio estado del modal con Alpine.js --}}
                        <div class="sk-user-card" x-data="{ modalOpen: false }">
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

                            {{-- Botón que abre el modal --}}
                            <button @click="modalOpen = true" type="button" class="sk-btn-swap">
                                <i class="ti ti-switch-horizontal" style="font-size:13px" aria-hidden="true"></i>
                                Solicitar intercambio
                            </button>

                            {{-- Modal Emergente Específico para este Intercambio --}}
                            <div x-show="modalOpen" x-transition class="sk-modal-overlay" style="display: none;">
                                <div @click.away="modalOpen = false" class="sk-modal">
                                    <div class="sk-modal-header">
                                        <p class="sk-modal-title">Proponer Intercambio</p>
                                        <button type="button" @click="modalOpen = false" class="sk-modal-close">&times;</button>
                                    </div>
                                    
                                    <p class="sk-modal-text">
                                        Vas a solicitar la habilidad <strong>{{ $result['skill']->name }}</strong> de <strong>{{ $user->name }}</strong>. Elige cuál de tus conocimientos le ofreces a cambio:
                                    </p>

                                    <form action="{{ route('exchanges.store') }}" method="POST">
                                        @csrf
                                        {{-- IDs ocultos necesarios para el backend --}}
                                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                        <input type="hidden" name="requested_skill_id" value="{{ $result['skill']->id }}">
                                        
                                        <div class="sk-form-group">
                                            <label class="sk-label">Tu oferta *</label>
                                            <select name="offered_skill_id" required class="sk-select">
                                                <option value="" disabled selected>Selecciona una de tus habilidades...</option>
                                                @foreach(Auth::user()->skills as $mySkill)
                                                    <option value="{{ $mySkill->id }}">{{ $mySkill->name }} (Nivel: {{ $mySkill->pivot->level }})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="sk-modal-actions">
                                            <button type="button" @click="modalOpen = false" class="sk-btn-cancel">Cancelar</button>
                                            <button type="submit" class="sk-btn-swap" style="width: auto; flex: 1;">Enviar solicitud</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
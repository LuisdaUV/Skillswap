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
}

*, *::before, *::after { box-sizing: border-box; }

.sk-page { 
    padding: 24px 20px; 
    max-width: 900px; 
    margin: 0 auto; 
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: var(--text-main);
}

.sk-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    background: var(--navy-dark);
    padding: 14px 20px;
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

.sk-back {
    font-size: 13px;
    font-weight: 600;
    color: #FFFFFF;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.1);
    padding: 6px 14px;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.sk-back:hover { 
    background: #FFFFFF;
    color: var(--navy-dark);
}

.sk-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 16px;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.04);
}

.sk-summary { font-size: 14px; color: var(--text-muted); }
.sk-summary strong { color: var(--navy-dark); font-weight: 700; }

/* Bloque por habilidad */
.sk-skill-block { margin-bottom: 16px; }

.sk-skill-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 10px;
}

.sk-skill-name {
    font-size: 16px;
    font-weight: 800;
    color: var(--navy-dark);
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.sk-count {
    font-size: 12px;
    font-weight: 700;
    color: var(--blue-accent);
    background: var(--bg-surface-hover);
    border: 1px solid var(--border-color);
    border-radius: 99px;
    padding: 4px 12px;
}

/* Cards de usuarios */
.sk-users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 12px;
}

.sk-user-card {
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    padding: 16px;
    transition: all 0.2s ease;
}

.sk-user-card:hover { 
    border-color: var(--blue-accent); 
    background: var(--bg-surface);
    box-shadow: 0 2px 8px rgba(0, 90, 156, 0.08);
}

.sk-user-top {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.sk-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--navy-dark);
    border: 1px solid var(--navy-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 800;
    color: #FFFFFF;
    flex-shrink: 0;
    text-transform: uppercase;
}

.sk-user-name { font-size: 14px; font-weight: 700; color: var(--navy-dark); margin: 0 0 2px; }
.sk-user-code { font-size: 12px; color: var(--text-muted); margin: 0; font-family: monospace; }

.sk-level-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sk-level-principiante { background: #E0F2FE; color: #0369A1; border: 1px solid rgba(3, 105, 161, 0.2); }
.sk-level-intermedio   { background: #FEF3C7; color: #92400E; border: 1px solid rgba(146, 64, 14, 0.2); }
.sk-level-avanzado     { background: #DCFCE7; color: #15803D; border: 1px solid rgba(21, 128, 61, 0.2); }
.sk-level-experto      { background: #F3E8FF; color: #6B21A8; border: 1px solid rgba(107, 33, 168, 0.2); }

.sk-btn-swap {
    width: 100%;
    background: var(--yellow-gold);
    color: var(--navy-dark);
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-size: 13px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: background 0.2s ease;
}

.sk-btn-swap:hover { background: var(--yellow-hover); }

/* Empty state */
.sk-empty {
    text-align: center;
    padding: 48px 20px;
}

.sk-empty i { font-size: 42px; color: var(--text-muted); margin-bottom: 12px; display: block; }
.sk-empty-title { font-size: 16px; font-weight: 800; color: var(--navy-dark); margin: 0 0 6px; }
.sk-empty-sub   { font-size: 14px; color: var(--text-muted); margin: 0 0 16px; }
.sk-empty-link  { color: var(--blue-accent); text-decoration: none; font-size: 14px; font-weight: 700; }
.sk-empty-link:hover { text-decoration: underline; }

/* Banner de Alerta */
.sk-alert {
    background: #D1FAE5;
    border: 1px solid #059669;
    color: #065F46;
    border-radius: 10px;
    padding: 12px 16px;
    margin-bottom: 16px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Modal Emergente */
.sk-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 43, 73, 0.6);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 16px;
}

.sk-modal {
    background: #FFFFFF;
    border: 1px solid var(--border-color);
    border-radius: 14px;
    padding: 24px;
    width: 100%;
    max-width: 440px;
    box-shadow: 0 10px 30px rgba(0, 43, 73, 0.2);
    text-align: left;
}

.sk-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 10px;
}

.sk-modal-title {
    font-size: 16px;
    font-weight: 800;
    color: var(--navy-dark);
    margin: 0;
}

.sk-modal-close {
    background: none;
    border: none;
    color: var(--text-muted);
    font-size: 22px;
    cursor: pointer;
    line-height: 1;
}

.sk-modal-close:hover { color: var(--navy-dark); }

.sk-modal-text {
    font-size: 14px;
    color: var(--text-main);
    margin: 0 0 16px 0;
    line-height: 1.5;
}

.sk-modal-text strong { color: var(--navy-dark); font-weight: 700; }

.sk-form-group { margin-bottom: 16px; }

.sk-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: var(--navy-dark);
    text-transform: uppercase;
    margin-bottom: 6px;
    letter-spacing: 0.05em;
}

.sk-select {
    width: 100%;
    background: #FFFFFF;
    border: 1px solid var(--border-color);
    color: var(--text-main);
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 14px;
    font-family: inherit;
    outline: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.sk-select:focus { 
    border-color: var(--blue-accent); 
    box-shadow: 0 0 0 3px rgba(0, 90, 156, 0.15);
}

.sk-modal-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.sk-btn-cancel {
    flex: 1;
    background: transparent;
    border: 1px solid var(--border-color);
    color: var(--text-muted);
    border-radius: 8px;
    padding: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.2s ease;
}

.sk-btn-cancel:hover { 
    border-color: var(--navy-dark); 
    color: var(--navy-dark); 
    background: var(--bg-app);
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    <div class="sk-top">
        <p class="sk-page-title">
            <i class="ti ti-search" style="color: var(--yellow-gold); font-size: 20px;" aria-hidden="true"></i>
            Resultados de búsqueda
        </p>
        <a href="{{ route('search.index') }}" class="sk-back">
            <i class="ti ti-arrow-left" style="font-size:15px" aria-hidden="true"></i> Nueva búsqueda
        </a>
    </div>

    {{-- Banner de Éxito --}}
    @if(session('success'))
        <div class="sk-alert">
            <i class="ti ti-circle-check" style="font-size:18px" aria-hidden="true"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Resumen --}}
    @if($query || $category)
        <div class="sk-card">
            <p class="sk-summary" style="margin:0">
                @if($query) Búsqueda: <strong>"{{ $query }}"</strong> @endif
                @if($query && $category) &nbsp;·&nbsp; @endif
                @if($category) Categoría: <strong>{{ ucfirst($category) }}</strong> @endif
            </p>
        </div>
    @endif

    {{-- Resultados --}}
    @if(count($results) > 0)
        @foreach($results as $result)
            <div class="sk-card sk-skill-block">
                <div class="sk-skill-header">
                    <p class="sk-skill-name">
                        <i class="ti ti-sparkles" style="font-size:16px; color: var(--blue-accent);" aria-hidden="true"></i>
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

                            <div class="sk-level-badge sk-level-{{ strtolower($user->pivot->level ?? 'intermedio') }}">
                                Nivel: {{ ucfirst($user->pivot->level ?? 'intermedio') }}
                            </div>

                            {{-- Botón que abre el modal --}}
                            <button @click="modalOpen = true" type="button" class="sk-btn-swap">
                                <i class="ti ti-switch-horizontal" style="font-size:15px" aria-hidden="true"></i>
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
                                                    <option value="{{ $mySkill->id }}">{{ $mySkill->name }} (Nivel: {{ ucfirst($mySkill->pivot->level) }})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- ========================================================================= --}}
                                        {{-- COMPONENTE: FECHA Y HORA DEL ENCUENTRO --}}
                                        {{-- ========================================================================= --}}
                                        <div class="sk-form-group" style="display: flex; gap: 12px; margin-top: 16px;">
                                            <div style="flex: 1;">
                                                <label class="sk-label">¿Qué día se reunirán? *</label>
                                                <input type="date" name="meet_date" required min="{{ date('Y-m-d') }}" class="sk-select">
                                            </div>
                                
                                            <div style="flex: 1;">
                                                <label class="sk-label">¿A qué hora? *</label>
                                                <input type="time" name="meet_time" required class="sk-select">
                                            </div>
                                        </div>
                                        {{-- ========================================================================= --}}

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
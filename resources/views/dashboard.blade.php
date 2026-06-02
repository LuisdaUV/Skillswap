<x-app-layout>

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        html, body { overflow-x: hidden; }

        .ss-app {
            display: grid;
            grid-template-columns: 230px 1fr 230px;
            gap: 12px;
            padding: 16px;
            height: calc(100vh - 60px);
            overflow: hidden;
            align-items: start;
        }

        @media (max-width: 768px) {
            .ss-app { grid-template-columns: 1fr; height: auto; overflow: visible; }
            .ss-right { display: none; }
        }


        /* ── Sidebar ── */
        .ss-sidebar {
            background: #0f1410;
            border: 0.5px solid #1e2e22;
            border-radius: 14px;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;
        }

        .ss-sidebar::-webkit-scrollbar { display: none; }

        .ss-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .ss-brand img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #2de88e;
        }

        .ss-brand span { font-size: 14px; font-weight: 500; color: #e8f5ee; }

        .ss-user-card {
            background: #141c17;
            border: 0.5px solid #1e2e22;
            border-radius: 10px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            flex-shrink: 0;
        }

        .ss-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #2de88e22;
            border: 1.5px solid #2de88e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            color: #2de88e;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .ss-user-name { font-size: 13px; font-weight: 500; color: #e8f5ee; margin: 0; }
        .ss-user-sub  { font-size: 11px; color: #6b8c78; margin: 0; }

        .ss-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 9px;
            font-size: 13px;
            color: #6b8c78;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            flex-shrink: 0;
        }

        .ss-nav-item:hover { background: #1e2e22; color: #e8f5ee; }

        .ss-nav-item.active { background: #2de88e; color: #0a0f0c; font-weight: 500; }
        .ss-nav-item.active i { color: #0a0f0c; }
        .ss-nav-item i { font-size: 16px; }

        .ss-nav-item.logout:hover { background: #e84b2d18; color: #e8836e; }

        .ss-nav-divider {
            border: none;
            border-top: 0.5px solid #1e2e22;
            margin: 4px 0;
            flex-shrink: 0;
        }

        .ss-badge-soon {
            margin-left: auto;
            font-size: 10px;
            color: #6b8c78;
            background: #141c17;
            border: 0.5px solid #1e2e22;
            border-radius: 5px;
            padding: 2px 6px;
        }

        .ss-credits-chip {
            margin-top: 8px;
            background: #2de88e15;
            border: 0.5px solid #2de88e40;
            border-radius: 10px;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .ss-credits-label { font-size: 10px; color: #6b8c78; text-transform: uppercase; letter-spacing: 0.07em; margin: 0 0 2px; }
        .ss-credits-val   { font-size: 22px; font-weight: 500; color: #2de88e; margin: 0; }

        /* ── Centro ── */
        .ss-center {
            display: flex;
            flex-direction: column;
            gap: 12px;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;
        }

        .ss-center::-webkit-scrollbar { display: none; }

        .ss-hero {
            background: #0f1410;
            border: 0.5px solid #1e2e22;
            border-radius: 14px;
            padding: 20px;
            flex-shrink: 0;
        }

        .ss-hero-greeting { font-size: 22px; font-weight: 500; color: #2de88e; margin: 0 0 4px; }
        .ss-hero-sub { font-size: 13px; color: #6b8c78; margin: 0 0 16px; }

        .ss-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #141c17;
            border: 0.5px solid #1e2e22;
            border-radius: 8px;
            padding: 9px 12px;
            text-decoration: none;
        }

        .ss-search i { font-size: 15px; color: #6b8c78; }
        .ss-search span { font-size: 13px; color: #6b8c78; }

        .ss-skills-card {
            background: #0f1410;
            border: 0.5px solid #1e2e22;
            border-radius: 14px;
            padding: 16px;
            flex-shrink: 0;
        }

        .ss-section-label {
            font-size: 11px;
            font-weight: 500;
            color: #2de88e;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin: 0 0 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            justify-content: space-between;
        }

        .ss-section-label a { font-size: 11px; color: #6b8c78; text-decoration: none; font-weight: 400; text-transform: none; letter-spacing: 0; }
        .ss-section-label a:hover { color: #2de88e; }

        .ss-skill-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            background: #141c17;
            border: 0.5px solid #1e2e22;
            margin-bottom: 6px;
            font-size: 13px;
            color: #e8f5ee;
        }

        .ss-skill-item:last-child { margin-bottom: 0; }

        .ss-skill-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: #2de88e15;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ss-skill-icon i { font-size: 14px; color: #2de88e; }
        .ss-skill-level { margin-left: auto; font-size: 11px; color: #6b8c78; }

        .ss-skill-item { cursor: pointer; transition: background 0.15s, border-color 0.15s, color 0.15s; }
        .ss-skill-item:hover { background: #2de88e; border-color: #2de88e; color: #0a0f0c; }
        .ss-skill-item.highlight { background: #2de88e; border-color: #2de88e; color: #0a0f0c; }
        .ss-skill-item:hover .ss-skill-icon, .ss-skill-item.highlight .ss-skill-icon { background: #ffffff22; }
        .ss-skill-item:hover .ss-skill-icon i, .ss-skill-item.highlight .ss-skill-icon i { color: #0a0f0c; }
        .ss-skill-item:hover .ss-skill-level, .ss-skill-item.highlight .ss-skill-level { color: #0a0f0c99; }

        .ss-empty { font-size: 13px; color: #6b8c78; margin: 0 0 8px; }
        .ss-add-link { font-size: 13px; color: #2de88e; text-decoration: none; }
        .ss-add-link:hover { text-decoration: underline; }

        /* ── Columna derecha ── */
        .ss-right {
            display: flex;
            flex-direction: column;
            gap: 12px;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;
        }

        .ss-right::-webkit-scrollbar { display: none; }

        .ss-stats-card {
            background: #0f1410;
            border: 0.5px solid #1e2e22;
            border-radius: 14px;
            padding: 16px;
            flex-shrink: 0;
        }

        .ss-stats-title { font-size: 15px; font-weight: 500; color: #e8f5ee; margin: 0 0 2px; }
        .ss-stats-sub   { font-size: 11px; color: #6b8c78; margin: 0 0 12px; }

        .ss-tabs { display: flex; gap: 4px; margin-bottom: 14px; }

        .ss-tab {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
            border: 0.5px solid #1e2e22;
            color: #6b8c78;
            cursor: pointer;
            background: none;
            font-family: inherit;
            transition: all 0.15s;
        }

        .ss-tab:hover { border-color: #2de88e; color: #2de88e; }
        .ss-tab.active { background: #2de88e; color: #0a0f0c; border-color: #2de88e; font-weight: 500; }

        .ss-activity-label { font-size: 11px; color: #6b8c78; margin: 0 0 8px; }

        .ss-bars { display: flex; align-items: flex-end; gap: 5px; height: 80px; }
        .ss-bar-wrap { display: flex; flex-direction: column; align-items: center; gap: 4px; flex: 1; height: 100%; justify-content: flex-end; }
        .ss-bar { width: 100%; border-radius: 4px 4px 0 0; background: #1e2e22; }
        .ss-bar.on { background: #2de88e; }
        .ss-bar-day { font-size: 9px; color: #6b8c78; }

        .ss-progress-card {
            background: #2de88e;
            border-radius: 14px;
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .ss-progress-label { font-size: 11px; font-weight: 500; color: #0a0f0c; text-transform: uppercase; letter-spacing: 0.07em; margin: 0 0 4px; }

        .ss-logros-card {
            background: #141c17;
            border: 0.5px solid #1e2e22;
            border-radius: 14px;
            padding: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .ss-logros-label { font-size: 11px; color: #6b8c78; text-transform: uppercase; letter-spacing: 0.07em; margin: 0 0 4px; }
        .ss-logros-val   { font-size: 22px; font-weight: 500; color: #e8f5ee; margin: 0; }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <div class="ss-app">

        {{-- ── SIDEBAR ── --}}
        <aside class="ss-sidebar">

            <a href="{{ url('/dashboard') }}" class="ss-brand">
                <img src="{{ asset('images/logo.jpeg') }}" alt="SkillSwap">
                <span>SkillSwap</span>
            </a>

            <div class="ss-user-card">
                <div class="ss-avatar">{{ substr(Auth::user()->name, 0, 2) }}</div>
                <div>
                    <p class="ss-user-name">{{ Auth::user()->name }}</p>
                    <p class="ss-user-sub">{{ Auth::user()->university_id }}</p>
                </div>
            </div>

            <a href="{{ url('/dashboard') }}" class="ss-nav-item active" aria-current="page">
                <i class="ti ti-layout-dashboard" aria-hidden="true"></i> Dashboard
            </a>

            <a href="{{ route('profile.edit') }}" class="ss-nav-item">
                <i class="ti ti-user" aria-hidden="true"></i> Mi perfil
            </a>

            <a href="{{ route('skills.index') }}" class="ss-nav-item">
                <i class="ti ti-books" aria-hidden="true"></i> Mis habilidades
            </a>

            <span class="ss-nav-item" style="cursor:default; opacity:0.6;">
                <i class="ti ti-chart-bar" aria-hidden="true"></i> Estadísticas
                <span class="ss-badge-soon">pronto</span>
            </span>

            <span class="ss-nav-item" style="cursor:default; opacity:0.6;">
                <i class="ti ti-heart" aria-hidden="true"></i> Favoritos
                <span class="ss-badge-soon">pronto</span>
            </span>

            <hr class="ss-nav-divider">

            <div class="ss-credits-chip">
                <div>
                    <p class="ss-credits-label">Créditos</p>
                    <p class="ss-credits-val">{{ Auth::user()->credits ?? 3 }}</p>
                </div>
                <i class="ti ti-coin" style="font-size:24px;color:#2de88e" aria-hidden="true"></i>
            </div>

            <hr class="ss-nav-divider">

            <form method="POST" action="{{ route('logout') }}" style="width:100%;flex-shrink:0;">
                @csrf
                <button type="submit" class="ss-nav-item logout" style="width:100%;">
                    <i class="ti ti-logout" aria-hidden="true"></i> Cerrar sesión
                </button>
            </form>

        </aside>

        {{-- ── CENTRO ── --}}
        <section class="ss-center">

            <div class="ss-hero">
                <p class="ss-hero-greeting">¡Hola, {{ Auth::user()->name }}!</p>
                <p class="ss-hero-sub">Buen día para aprender</p>
                <a href="{{ route('search.index') }}" class="ss-search">
                    <i class="ti ti-search" aria-hidden="true"></i>
                    <span>Buscar habilidades...</span>
                </a>
            </div>

            <div class="ss-skills-card">
                <p class="ss-section-label">
                    <span style="display:flex;align-items:center;gap:6px;">
                        <i class="ti ti-books" aria-hidden="true"></i> Mis habilidades
                    </span>
                    <a href="{{ route('skills.index') }}">Administrar →</a>
                </p>

                @if(Auth::user()->skills->count() > 0)
                    @foreach(Auth::user()->skills as $i => $skill)
                        <div class="ss-skill-item {{ $i === 0 ?  : '' }}"> {{-- despues del ? omití 'highlight' --}} 
                            <div class="ss-skill-icon">
                                <i class="ti ti-sparkles" aria-hidden="true"></i>
                            </div>
                            {{ $skill->name }}
                            <span class="ss-skill-level">{{ $skill->pivot->level }}</span>
                        </div>
                    @endforeach
                @else
                    <p class="ss-empty">Aún no tienes habilidades registradas.</p>
                    <a href="{{ route('skills.create') }}" class="ss-add-link">+ Agregar tu primera habilidad</a>
                @endif
            </div>

        </section>

        {{-- ── COLUMNA DERECHA ── --}}
        <aside class="ss-right">

            <div class="ss-stats-card">
                <p class="ss-stats-title">Estadísticas</p>
                <p class="ss-stats-sub">Esta semana</p>
                <div class="ss-tabs">
                    <button class="ss-tab">Día</button>
                    <button class="ss-tab active">Semana</button>
                    <button class="ss-tab">Mes</button>
                </div>
                <p class="ss-activity-label">Actividad</p>
                <div class="ss-bars">
                    @foreach(['L'=>40,'M'=>60,'X'=>50,'J'=>80,'V'=>90,'S'=>70,'D'=>55] as $day => $h)
                        <div class="ss-bar-wrap">
                            <div class="ss-bar {{ $h >= 70 ? 'on' : '' }}" style="height:{{ $h }}%"></div>
                            <span class="ss-bar-day">{{ $day }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="ss-progress-card">
                <div>
                    <p class="ss-progress-label">Progreso</p>
                    <p style="font-size:11px;color:#0a0f0c99;margin:0;">Habilidades activas</p>
                </div>
                <svg width="70" height="70" viewBox="0 0 70 70" aria-label="Progreso 60%">
                    <circle cx="35" cy="35" r="28" fill="none" stroke="#0a0f0c33" stroke-width="6"/>
                    <circle cx="35" cy="35" r="28" fill="none" stroke="#0a0f0c" stroke-width="6"
                        stroke-dasharray="176" stroke-dashoffset="70" stroke-linecap="round"
                        transform="rotate(-90 35 35)"/>
                    <text x="35" y="40" text-anchor="middle" font-size="14" font-weight="500"
                        fill="#0a0f0c" font-family="inherit">60%</text>
                </svg>
            </div>

            <div class="ss-logros-card">
                <div>
                    <p class="ss-logros-label">Logros</p>
                    <p class="ss-logros-val">{{ Auth::user()->skills->count() * 3 }}+</p>
                </div>
                <i class="ti ti-trophy" style="font-size:26px;color:#2de88e" aria-hidden="true"></i>
            </div>

        </aside>

    </div>

</x-app-layout>
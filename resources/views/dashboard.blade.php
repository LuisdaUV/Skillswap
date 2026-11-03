<x-app-layout>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <style>
        /* ── RESET Y BASE ── */
        *, *::before, *::after { box-sizing: border-box; }
        html, body { 
            overflow-x: hidden; 
            margin: 0; 
            background-color: #F4F6F8; 
            font-family: 'Inter', system-ui, -apple-system, sans-serif; 
            color: #1E293B;
        }

        /* ── VARIABLES BASADAS EN LA PALETA ACADÉMICA ── */
        :root {
            --bg-app: #F4F6F8;             /* Gris muy claro de la imagen */
            --bg-surface: #FFFFFF;         /* Blanco puro para tarjetas */
            --bg-surface-hover: #EBF3FA;   /* Azul ultra claro para hovers */
            --bg-input: #FFFFFF;           /* Fondo de campos de búsqueda */
            
            --border-color: #CBD5E1;       /* Bordes definidos */
            
            --navy-dark: #002B49;          /* Azul Marino Profundo (Navegación / Textos clave) */
            --blue-accent: #005A9C;        /* Azul Institucional (Acentos / Iconos) */
            --yellow-gold: #FFC700;        /* Amarillo / Dorado (Acciones principales / Destacados) */
            --yellow-hover: #E6B200;       /* Amarillo más oscuro para hovers */
            
            --text-main: #0F172A;          /* Texto oscuro principal */
            --text-muted: #475569;         /* Texto secundario */
            
            --danger: #DC2626;             /* Rojo para acciones destructivas */
            --danger-light: #FEE2E2;
        }

        /* ── ESTRUCTURA PRINCIPAL (3 COLUMNAS) ── */
        .ss-app {
            display: grid !important;
            grid-template-columns: 240px 1fr 240px !important;
            gap: 16px !important;
            padding: 16px !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            align-items: start !important;
        }

        @media (max-width: 900px) {
            .ss-app { grid-template-columns: 1fr !important; }
            .ss-right { display: none !important; }
        }

        .ss-sidebar, .ss-center, .ss-right {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* ── SIDEBAR (Navegación Izquierda) ── */
        .ss-sidebar {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px 16px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .ss-brand {
            display: flex; align-items: center; gap: 12px; margin-bottom: 20px; text-decoration: none;
        }
        .ss-brand img {
            width: 38px !important;
            height: 38px !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            border: 2px solid var(--navy-dark) !important;
        }
        .ss-brand span { font-size: 18px; font-weight: 800; color: var(--navy-dark); letter-spacing: -0.5px; }

        .ss-user-card {
            background: var(--bg-app);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px;
            display: flex; align-items: center; gap: 12px; margin-bottom: 12px;
        }

        .ss-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--navy-dark);
            border: 1px solid var(--navy-dark);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #FFFFFF; text-transform: uppercase;
        }

        .ss-user-name { font-size: 14px; font-weight: 700; color: var(--text-main); margin: 0; }
        .ss-user-sub  { font-size: 12px; color: var(--text-muted); margin: 0; }

        .ss-nav-item {
            display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px;
            font-size: 14px; font-weight: 600; color: var(--navy-dark);
            cursor: pointer; background: none; border: none; width: 100%; text-align: left;
            font-family: inherit; text-decoration: none; transition: all 0.2s ease;
        }
        .ss-nav-item:hover { background: var(--bg-surface-hover); color: var(--blue-accent); }
        .ss-nav-item.active { background: var(--navy-dark); color: #FFFFFF; font-weight: 600; }
        .ss-nav-item.active i { color: var(--yellow-gold); }
        .ss-nav-item i { font-size: 18px; color: var(--blue-accent); }
        .ss-nav-item.logout:hover { background: var(--danger-light); color: var(--danger); }
        .ss-nav-item.logout i { color: inherit; }

        .ss-nav-item-disabled { cursor: default; opacity: 0.6; }
        .ss-nav-divider { border: none; border-top: 1px solid var(--border-color); margin: 8px 0; }

        .ss-badge-soon {
            margin-left: auto; font-size: 10px; color: var(--navy-dark); background: var(--yellow-gold);
            border-radius: 4px; padding: 2px 6px; font-weight: 700; text-transform: uppercase;
        }

        .ss-credits-chip {
            background: var(--navy-dark); border: 1px solid var(--navy-dark);
            border-radius: 8px; padding: 14px; display: flex; justify-content: space-between; align-items: center;
        }
        .ss-credits-label { font-size: 11px; font-weight: 700; color: #FFFFFF; text-transform: uppercase; margin: 0 0 2px; }
        .ss-credits-val   { font-size: 24px; font-weight: 800; color: var(--yellow-gold); margin: 0; }
        .ss-credits-icon  { font-size: 26px; color: var(--yellow-gold); }

        /* ── COLUMNA CENTRO ── */
        .ss-hero {
            background: var(--navy-dark); border-radius: 12px;
            padding: 24px; box-shadow: 0 2px 6px rgba(0,0,0,0.06); color: #FFFFFF;
        }
        .ss-hero-greeting { font-size: 24px; font-weight: 800; color: #FFFFFF; margin: 0 0 4px; }
        .ss-hero-sub { font-size: 14px; color: #E2E8F0; margin: 0 0 20px; }

        .ss-search {
            display: flex; align-items: center; gap: 10px; background: var(--bg-input);
            border: 2px solid var(--yellow-gold); border-radius: 8px; padding: 12px 16px; text-decoration: none;
            transition: all 0.2s ease;
        }
        .ss-search:hover { background: #FFFFFF; border-color: #FFFFFF; }
        .ss-search i { font-size: 16px; color: var(--navy-dark); }
        .ss-search span { font-size: 14px; color: var(--text-muted); font-weight: 500; }

        .ss-skills-card {
            background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 12px;
            padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
        .ss-section-label {
            font-size: 13px; font-weight: 800; color: var(--navy-dark); text-transform: uppercase;
            margin: 0 0 16px; display: flex; align-items: center; justify-content: space-between;
        }
        .ss-section-label a { font-size: 13px; color: var(--blue-accent); text-decoration: none; text-transform: none; font-weight: 600; }
        .ss-section-label a:hover { text-decoration: underline; }

        .ss-skill-item {
            display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px;
            background: var(--bg-app); border: 1px solid var(--border-color); margin-bottom: 8px;
            font-size: 14px; font-weight: 600; color: var(--text-main); transition: all 0.2s;
        }
        .ss-skill-item:hover { background: var(--bg-surface-hover); border-color: var(--blue-accent); }
        .ss-skill-icon {
            width: 32px; height: 32px; border-radius: 6px; background: var(--navy-dark);
            display: flex; align-items: center; justify-content: center;
        }
        .ss-skill-icon i { font-size: 16px; color: var(--yellow-gold); }
        .ss-skill-level { margin-left: auto; font-size: 12px; font-weight: 700; color: var(--blue-accent); background: #E0F2FE; padding: 2px 8px; border-radius: 4px; }

        /* ── SECCIÓN SOLICITUDES ── */
        .ss-req-container {
            background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 12px;
            padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
        .ss-req-header {
            display: flex; align-items: center; gap: 10px; margin-bottom: 16px;
            border-bottom: 2px solid var(--bg-app); padding-bottom: 12px;
        }
        .ss-req-title { font-size: 15px; font-weight: 800; color: var(--navy-dark); margin: 0; }

        .ss-req-card {
            background: var(--bg-app); border: 1px solid var(--border-color); border-radius: 10px; padding: 16px; margin-bottom: 12px;
        }
        .ss-req-sender { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
        .ss-req-avatar {
            background: var(--yellow-gold); color: var(--navy-dark); font-weight: 800; width: 38px; height: 38px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px;
        }
        .ss-req-offer-box {
            background: #FFFFFF; border-radius: 8px; padding: 12px; margin-bottom: 14px;
            border-left: 4px solid var(--blue-accent); border-top: 1px solid var(--border-color); border-right: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);
        }
        .ss-req-btn-accept {
            background: var(--yellow-gold); color: var(--navy-dark); font-weight: 700; border: none;
            padding: 8px 14px; border-radius: 6px; cursor: pointer; width: 100%; transition: background 0.2s;
        }
        .ss-req-btn-accept:hover { background: var(--yellow-hover); }
        .ss-req-btn-reject {
            background: transparent; color: var(--danger); font-weight: 700; border: 1px solid var(--danger);
            padding: 8px 14px; border-radius: 6px; cursor: pointer; width: 100%; transition: background 0.2s;
        }
        .ss-req-btn-reject:hover { background: var(--danger-light); }

        /* ── COLUMNA DERECHA ── */
        .ss-stats-card, .ss-logros-card {
            background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 12px;
            padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
        .ss-stats-title { font-size: 16px; font-weight: 800; color: var(--navy-dark); margin: 0 0 4px; }
        .ss-stats-sub   { font-size: 12px; color: var(--text-muted); margin: 0 0 16px; }

        .ss-tabs { display: flex; gap: 6px; margin-bottom: 20px; }
        .ss-tab {
            font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px; border: 1px solid var(--border-color);
            color: var(--text-muted); background: var(--bg-app); cursor: pointer; transition: all 0.2s;
        }
        .ss-tab.active { background: var(--navy-dark); color: #FFFFFF; border-color: var(--navy-dark); }

        .ss-bars { display: flex; align-items: flex-end; gap: 6px; height: 90px; }
        .ss-bar-wrap { display: flex; flex-direction: column; align-items: center; gap: 6px; flex: 1; height: 100%; justify-content: flex-end; }
        .ss-bar { width: 100%; border-radius: 4px 4px 0 0; background: #E2E8F0; }
        .ss-bar.on { background: var(--blue-accent); }
        .ss-bar-day { font-size: 10px; font-weight: 700; color: var(--text-muted); }

        .ss-progress-card {
            background: var(--blue-accent); border-radius: 12px; padding: 20px;
            display: flex; align-items: center; justify-content: space-between; color: #FFFFFF;
        }
    </style>

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

            <a href="{{ url('/dashboard') }}" class="ss-nav-item active">
                <i class="ti ti-layout-dashboard"></i> Dashboard
            </a>

            <a href="{{ route('profile.edit') }}" class="ss-nav-item">
                <i class="ti ti-user"></i> Mi perfil
            </a>

            <a href="{{ route('skills.index') }}" class="ss-nav-item">
                <i class="ti ti-books"></i> Mis habilidades
            </a>

            <span class="ss-nav-item ss-nav-item-disabled">
                <i class="ti ti-chart-bar"></i> Estadísticas
                <span class="ss-badge-soon">pronto</span>
            </span>

            <span class="ss-nav-item ss-nav-item-disabled">
                <i class="ti ti-heart"></i> Favoritos
                <span class="ss-badge-soon">pronto</span>
            </span>

            <hr class="ss-nav-divider">

            <div class="ss-credits-chip">
                <div>
                    <p class="ss-credits-label">Créditos</p>
                    <p class="ss-credits-val">{{ Auth::user()->credits ?? 3 }}</p>
                </div>
                <i class="ti ti-coin ss-credits-icon"></i>
            </div>

            <hr class="ss-nav-divider">

            <form method="POST" action="{{ route('logout') }}" style="width:100%;">
                @csrf
                <button type="submit" class="ss-nav-item logout">
                    <i class="ti ti-logout"></i> Cerrar sesión
                </button>
            </form>

        </aside>

        {{-- ── CENTRO ── --}}
        <section class="ss-center">

            <div class="ss-hero">
                <p class="ss-hero-greeting">¡Hola, {{ Auth::user()->name }}!</p>
                <p class="ss-hero-sub">Buen día para aprender e intercambiar conocimiento</p>
                <a href="{{ route('search.index') }}" class="ss-search">
                    <i class="ti ti-search"></i>
                    <span>Buscar habilidades...</span>
                </a>
            </div>

            <div class="ss-skills-card">
                <p class="ss-section-label">
                    <span><i class="ti ti-books" style="color:var(--blue-accent);"></i> Mis habilidades</span>
                    <a href="{{ route('skills.index') }}">Administrar →</a>
                </p>

                @if(Auth::user()->skills->count() > 0)
                    @foreach(Auth::user()->skills as $skill)
                        <div class="ss-skill-item"> 
                            <div class="ss-skill-icon">
                                <i class="ti ti-sparkles"></i>
                            </div>
                            {{ $skill->name }}
                            <span class="ss-skill-level">{{ $skill->pivot->level }}</span>
                        </div>
                    @endforeach
                @else
                    <p style="font-size:14px;color:var(--text-muted);margin:0 0 8px;">Aún no tienes habilidades registradas.</p>
                    <a href="{{ route('skills.create') }}" style="color:var(--blue-accent);font-weight:600;text-decoration:none;">+ Agregar primera habilidad</a>
                @endif
            </div>

            {{-- Solicitudes Recibidas --}}
            <div class="ss-req-container">
                <div class="ss-req-header">
                    <div style="background:var(--bg-app);width:32px;height:32px;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                        <i class="ti ti-bell-ringing" style="color:var(--navy-dark);font-size:18px;"></i>
                    </div>
                    <p class="ss-req-title">Solicitudes de intercambio recibidas</p>
                </div>

                @if(isset($incomingRequests) && $incomingRequests->count() > 0)
                    @foreach($incomingRequests as $request)
                        <div class="ss-req-card">
                            <div class="ss-req-sender">
                                <div class="ss-req-avatar">
                                    {{ substr($request->sender->name, 0, 2) }}
                                </div>
                                <div>
                                    <p style="font-size:14px;margin:0;font-weight:600;color:var(--navy-dark);">
                                        {{ $request->sender->name }} te propone un trato
                                    </p>
                                    <p style="font-size:12px;color:var(--text-muted);margin:0;">
                                        Código: {{ $request->sender->university_id }}
                                    </p>
                                </div>
                            </div>

                            <div class="ss-req-offer-box">
                                <p style="font-size:13px;color:var(--text-main);margin:0;line-height:1.5;">
                                    Quiere aprender tu habilidad de <strong style="color:var(--navy-dark);">{{ $request->requestedSkill->name }}</strong> 
                                    y te ofrece a cambio su conocimiento en <strong style="color:var(--blue-accent);">{{ $request->offeredSkill->name }}</strong>.
                                </p>

                                @if($request->meet_date && $request->meet_time)
                                    <div style="display:flex;align-items:center;gap:8px;margin-top:10px;font-size:12px;color:var(--text-muted);background:var(--bg-app);padding:8px 12px;border-radius:6px;">
                                        <i class="ti ti-calendar-event" style="color:var(--blue-accent);font-size:16px;"></i>
                                        <span>Propone el <strong>{{ \Carbon\Carbon::parse($request->meet_date)->format('d/m/Y') }}</strong> a las <strong>{{ \Carbon\Carbon::parse($request->meet_time)->format('h:i A') }}</strong></span>
                                    </div>
                                @endif
                            </div>

                            <div style="display:flex;gap:10px;">
                                <form action="{{ route('exchanges.accept', $request->id) }}" method="POST" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="ss-req-btn-accept">
                                        <i class="ti ti-check"></i> Aceptar
                                    </button>
                                </form>
                                <form action="{{ route('exchanges.reject', $request->id) }}" method="POST" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="ss-req-btn-reject">
                                        <i class="ti ti-x"></i> Rechazar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p style="font-size:13px;color:var(--text-muted);margin:0;">No tienes solicitudes de intercambio pendientes.</p>
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
                <div class="ss-bars">
                    @foreach(['L'=>40,'M'=>60,'X'=>50,'J'=>80,'V'=>90,'S'=>70,'D'=>55] as $day => $h)
                        <div class="ss-bar-wrap">
                            <div class="ss-bar {{ $h >= 70 ? 'on' : '' }}" @style(['height' => $h . '%'])></div>
                            <span class="ss-bar-day">{{ $day }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="ss-progress-card">
                <div>
                    <p style="font-size:12px;font-weight:800;margin:0 0 4px;text-transform:uppercase;">Progreso</p>
                    <p style="font-size:12px;opacity:0.9;margin:0;">Habilidades activas</p>
                </div>
                <svg width="60" height="60" viewBox="0 0 70 70">
                    <circle cx="35" cy="35" r="28" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="6"/>
                    <circle cx="35" cy="35" r="28" fill="none" stroke="#FFC700" stroke-width="6"
                        stroke-dasharray="176" stroke-dashoffset="70" stroke-linecap="round"
                        transform="rotate(-90 35 35)"/>
                    <text x="35" y="40" text-anchor="middle" font-size="14" font-weight="800" fill="#FFFFFF">60%</text>
                </svg>
            </div>

            <div class="ss-logros-card" style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <p style="font-size:11px;font-weight:800;color:var(--text-muted);margin:0 0 4px;text-transform:uppercase;">Logros</p>
                    <p style="font-size:24px;font-weight:800;color:var(--navy-dark);margin:0;">{{ Auth::user()->skills->count() * 3 }}+</p>
                </div>
                <i class="ti ti-trophy" style="font-size:28px;color:var(--yellow-gold)"></i>
            </div>

        </aside>

    </div>

</x-app-layout>
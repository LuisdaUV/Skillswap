<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillSwap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        /* ── VARIABLES BASADAS EN LA PALETA ACADÉMICA ── */
        :root {
            --bg-app: #F4F6F8;             /* Gris claro institucional */
            --bg-surface: #FFFFFF;         /* Blanco limpio */
            --bg-surface-hover: #EBF3FA;   /* Azul ultra claro para hovers */
            --border-color: #CBD5E1;       /* Bordes nítidos */
            
            --navy-dark: #002B49;          /* Azul Marino Profundo */
            --blue-accent: #005A9C;        /* Azul Institucional */
            --yellow-gold: #FFC700;        /* Amarillo / Dorado Escolar */
            --yellow-hover: #E6B200;       /* Hover amarillo */
            
            --text-main: #0F172A;          /* Texto oscuro principal */
            --text-muted: #64748B;         /* Texto secundario */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; color: var(--text-main); }
        
        .page { 
            background: var(--bg-app); 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            padding: 0; 
        }

        /* ── BARRA SUPERIOR / NAVEGACIÓN ── */
        .nav { 
            display: flex; 
            justify-content: flex-end; 
            gap: 12px; 
            padding: 1.5rem 2rem; 
        }

        .btn-nav { 
            background: transparent; 
            border: 1px solid var(--border-color); 
            color: var(--navy-dark); 
            padding: 8px 20px; 
            border-radius: 8px; 
            font-size: 14px; 
            font-weight: 600;
            cursor: pointer; 
            text-decoration: none; 
            display: inline-block; 
            transition: all 0.2s ease; 
        }

        .btn-nav:hover { 
            border-color: var(--blue-accent); 
            color: var(--blue-accent); 
            background: var(--bg-surface-hover);
        }

        .btn-nav.primary { 
            background: var(--yellow-gold); 
            border-color: var(--yellow-gold); 
            color: var(--navy-dark); 
            font-weight: 700; 
        }

        .btn-nav.primary:hover { 
            background: var(--yellow-hover); 
            border-color: var(--yellow-hover);
        }

        /* ── SECCIÓN PRINCIPAL / TARJETA ── */
        .main { 
            flex: 1; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            padding: 2rem; 
        }

        .card { 
            background: var(--bg-surface); 
            border: 1px solid var(--border-color); 
            border-radius: 16px; 
            max-width: 920px; 
            width: 100%; 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            overflow: hidden; 
            box-shadow: 0 4px 20px rgba(0, 43, 73, 0.06);
        }

        @media (max-width: 768px) {
            .card { grid-template-columns: 1fr; }
        }

        /* ── COLUMNA IZQUIERDA ── */
        .card-left { 
            padding: 3rem; 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
        }

        .logo-row { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            margin-bottom: 2rem; 
        }

        .logo-circle { 
            width: 40px; 
            height: 40px; 
            background: var(--navy-dark); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }

        .logo-circle svg { 
            width: 22px; 
            height: 22px; 
            fill: var(--yellow-gold); 
        }

        .logo-name { 
            color: var(--navy-dark); 
            font-size: 20px; 
            font-weight: 800; 
            letter-spacing: -0.5px;
        }

        .tagline { 
            color: var(--navy-dark); 
            font-size: 28px; 
            font-weight: 800; 
            line-height: 1.25; 
            margin-bottom: 1rem; 
            letter-spacing: -0.5px;
        }

        .desc { 
            color: var(--text-muted); 
            font-size: 14px; 
            line-height: 1.7; 
            margin-bottom: 2rem; 
        }

        .features { 
            list-style: none; 
            display: flex; 
            flex-direction: column; 
            gap: 12px; 
            margin-bottom: 2.5rem; 
        }

        .features li { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            color: var(--text-main); 
            font-size: 14px; 
            font-weight: 500;
        }

        .dot { 
            width: 8px; 
            height: 8px; 
            background: var(--yellow-gold); 
            border: 1px solid var(--navy-dark);
            border-radius: 50%; 
            flex-shrink: 0; 
        }

        .actions { 
            display: flex; 
            flex-direction: column; 
            gap: 12px; 
        }

        .btn-primary { 
            background: var(--yellow-gold); 
            color: var(--navy-dark); 
            border: none; 
            padding: 14px 24px; 
            border-radius: 8px; 
            font-size: 15px; 
            font-weight: 700; 
            cursor: pointer; 
            text-align: center; 
            text-decoration: none; 
            display: block; 
            transition: background 0.2s ease; 
        }

        .btn-primary:hover { 
            background: var(--yellow-hover); 
        }

        .btn-secondary { 
            background: transparent; 
            color: var(--navy-dark); 
            border: 1px solid var(--border-color); 
            padding: 13px 24px; 
            border-radius: 8px; 
            font-size: 14px; 
            font-weight: 600;
            cursor: pointer; 
            text-align: center; 
            text-decoration: none; 
            display: block; 
            transition: all 0.2s ease; 
        }

        .btn-secondary:hover { 
            border-color: var(--blue-accent); 
            color: var(--blue-accent); 
            background: var(--bg-surface-hover);
        }

        /* ── COLUMNA DERECHA ── */
        .card-right { 
            background: var(--bg-app); 
            padding: 3rem; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            border-left: 1px solid var(--border-color); 
        }

        .links-title { 
            color: var(--navy-dark); 
            font-size: 12px; 
            font-weight: 800;
            text-transform: uppercase; 
            letter-spacing: 1px; 
            margin-bottom: 1.5rem; 
        }

        .link-item { 
            display: flex; 
            align-items: flex-start; 
            gap: 14px; 
            padding: 16px 0; 
            border-bottom: 1px solid var(--border-color); 
        }

        .link-item:last-child { border-bottom: none; }

        .link-icon { 
            width: 38px; 
            height: 38px; 
            background: var(--navy-dark); 
            border-radius: 8px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0; 
            color: var(--yellow-gold); 
            font-size: 18px; 
        }

        .link-info { flex: 1; }

        .link-info a { 
            color: var(--navy-dark); 
            font-size: 14px; 
            font-weight: 700; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 6px; 
            transition: color 0.2s ease;
        }

        .link-info a:hover { color: var(--blue-accent); }

        .link-info a span.arrow { 
            color: var(--blue-accent); 
            font-size: 12px; 
        }

        .link-info p { 
            color: var(--text-muted); 
            font-size: 12px; 
            margin-top: 4px; 
            line-height: 1.5; 
        }

        .footer { 
            padding: 1.5rem 2rem; 
            text-align: center; 
            color: var(--text-muted); 
            font-size: 13px; 
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="page">
    <nav class="nav">
        <a href="{{ route('login') }}" class="btn-nav">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="btn-nav primary">Registrarse</a>
    </nav>

    <main class="main">
        <div class="card">
            <div class="card-left">
                <div>
                    <div class="logo-row">
                        <div class="logo-circle">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SkillSwap" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb;">
                        </div>
                        <span class="logo-name">SkillSwap</span>
                    </div>
                    <p class="tagline">Aprende enseñando,<br>enseña aprendiendo.</p>
                    <p class="desc">Conecta con compañeros de tu universidad e intercambia habilidades de forma gratuita. Una comunidad donde el conocimiento no tiene precio.</p>
                    <ul class="features">
                        <li><span class="dot"></span> Intercambio de habilidades sin costo</li>
                        <li><span class="dot"></span> Comunidad universitaria verificada</li>
                        <li><span class="dot"></span> Sistema de créditos justo</li>
                    </ul>
                </div>
                <div class="actions">
                    <a href="{{ route('register') }}" class="btn-primary">Comenzar ahora</a>
                    <a href="{{ route('login') }}" class="btn-secondary">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </div>

            <div class="card-right">
                <p class="links-title">Para empezar</p>
                <div class="link-item">
                    <div class="link-icon"><i class="ti ti-book"></i></div>
                    <div class="link-info">
                        <a href="https://laravel.com/docs" target="_blank">Documentación <span class="arrow">↗</span></a>
                        <p>Guía completa para configurar y usar la plataforma.</p>
                    </div>
                </div>
                <div class="link-item">
                    <div class="link-icon"><i class="ti ti-video"></i></div>
                    <div class="link-info">
                        <a href="https://laracasts.com" target="_blank">Video tutoriales <span class="arrow">↗</span></a>
                        <p>Aprende con tutoriales paso a paso en Laracasts.</p>
                    </div>
                </div>
                <div class="link-item">
                    <div class="link-icon"><i class="ti ti-users"></i></div>
                    <div class="link-info">
                        <a href="https://laravel.com/community" target="_blank">Comunidad <span class="arrow">↗</span></a>
                        <p>Únete al foro y conecta con otros desarrolladores.</p>
                    </div>
                </div>
                <div class="link-item">
                    <div class="link-icon"><i class="ti ti-rocket"></i></div>
                    <div class="link-info">
                        <a href="https://forge.laravel.com" target="_blank">Desplegar ahora <span class="arrow">↗</span></a>
                        <p>Lleva tu aplicación a producción en minutos.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">SkillSwap © 2026</footer>
</div>

</body>
</html>
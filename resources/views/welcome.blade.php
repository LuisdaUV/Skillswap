<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillSwap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: sans-serif; }
        .page { background: #0d0d0d; min-height: 100vh; display: flex; flex-direction: column; padding: 0; }
        .nav { display: flex; justify-content: flex-end; gap: 12px; padding: 1.5rem 2rem; }
        .btn-nav { background: transparent; border: 1px solid #2a2a2a; color: #e0e0e0; padding: 8px 20px; border-radius: 8px; font-size: 14px; cursor: pointer; text-decoration: none; display: inline-block; transition: border-color 0.2s; }
        .btn-nav:hover { border-color: #00e07a; color: #00e07a; }
        .btn-nav.primary { background: #00e07a; border-color: #00e07a; color: #0d0d0d; font-weight: 600; }
        .btn-nav.primary:hover { background: #00c96d; }
        .main { flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .card { background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 16px; max-width: 900px; width: 100%; display: grid; grid-template-columns: 1fr 1fr; overflow: hidden; }
        .card-left { padding: 3rem; display: flex; flex-direction: column; justify-content: space-between; }
        .logo-row { display: flex; align-items: center; gap: 10px; margin-bottom: 2rem; }
        .logo-circle { width: 40px; height: 40px; background: #00e07a; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .logo-circle svg { width: 22px; height: 22px; fill: #0d0d0d; }
        .logo-name { color: #e0e0e0; font-size: 18px; font-weight: 500; }
        .tagline { color: #00e07a; font-size: 26px; font-weight: 600; line-height: 1.3; margin-bottom: 1rem; }
        .desc { color: #888; font-size: 14px; line-height: 1.7; margin-bottom: 2rem; }
        .features { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 2.5rem; }
        .features li { display: flex; align-items: center; gap: 10px; color: #ccc; font-size: 14px; }
        .dot { width: 8px; height: 8px; background: #00e07a; border-radius: 50%; flex-shrink: 0; }
        .actions { display: flex; flex-direction: column; gap: 10px; }
        .btn-primary { background: #00e07a; color: #0d0d0d; border: none; padding: 13px 24px; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; text-align: center; text-decoration: none; display: block; transition: background 0.2s; }
        .btn-primary:hover { background: #00c96d; }
        .btn-secondary { background: transparent; color: #888; border: 1px solid #2a2a2a; padding: 12px 24px; border-radius: 8px; font-size: 14px; cursor: pointer; text-align: center; text-decoration: none; display: block; transition: border-color 0.2s, color 0.2s; }
        .btn-secondary:hover { border-color: #00e07a; color: #00e07a; }
        .card-right { background: #111; padding: 3rem; display: flex; flex-direction: column; justify-content: center; border-left: 1px solid #2a2a2a; }
        .links-title { color: #555; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.5rem; }
        .link-item { display: flex; align-items: flex-start; gap: 14px; padding: 16px 0; border-bottom: 1px solid #1e1e1e; }
        .link-item:last-child { border-bottom: none; }
        .link-icon { width: 36px; height: 36px; background: #1e1e1e; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #00e07a; font-size: 16px; }
        .link-info { flex: 1; }
        .link-info a { color: #e0e0e0; font-size: 14px; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 6px; }
        .link-info a:hover { color: #00e07a; }
        .link-info a span.arrow { color: #555; font-size: 12px; }
        .link-info p { color: #555; font-size: 12px; margin-top: 3px; line-height: 1.5; }
        .footer { padding: 1rem 2rem; text-align: center; color: #333; font-size: 12px; }
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
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                            </svg>
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
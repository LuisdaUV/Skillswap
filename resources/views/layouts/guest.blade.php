<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SkillSwap') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* ── VARIABLES PALETA ACADÉMICA ── */
            :root {
                --bg-app: #F4F6F8;             /* Gris claro de fondo */
                --bg-surface: #FFFFFF;         /* Blanco puro para paneles */
                --border-color: #CBD5E1;       /* Bordes definidos */
                
                --navy-dark: #002B49;          /* Azul Marino Profundo */
                --blue-accent: #005A9C;        /* Azul Institucional */
                --yellow-gold: #FFC700;        /* Amarillo / Dorado Escolar */
                
                --text-main: #0F172A;          /* Texto principal */
                --text-muted: #64748B;         /* Texto secundario */
            }

            *, *::before, *::after { box-sizing: border-box; }

            body {
                margin: 0;
                min-height: 100vh;
                background: var(--bg-app);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Figtree', system-ui, -apple-system, sans-serif;
                padding: 24px 16px;
                color: var(--text-main);
            }

            .gs-wrapper {
                display: grid;
                grid-template-columns: 1fr 1fr;
                width: 100%;
                max-width: 920px;
                min-height: 540px;
                border-radius: 16px;
                overflow: hidden;
                border: 1px solid var(--border-color);
                background: var(--bg-surface);
                box-shadow: 0 4px 20px rgba(0, 43, 73, 0.06);
            }

            @media (max-width: 640px) {
                .gs-wrapper { grid-template-columns: 1fr; }
                .gs-brand-panel { display: none; }
            }

            /* ── PANEL IZQUIERDO: BRANDING ── */
            .gs-brand-panel {
                background: var(--navy-dark);
                padding: 40px 36px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                color: #FFFFFF;
            }

            .gs-logo {
                display: flex;
                align-items: center;
                gap: 12px;
                text-decoration: none;
            }

            .gs-logo img {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid var(--yellow-gold);
            }

            .gs-logo-text { 
                font-size: 20px; 
                font-weight: 800; 
                color: #FFFFFF; 
                letter-spacing: -0.5px;
            }

            .gs-brand-body { 
                flex: 1; 
                display: flex; 
                flex-direction: column; 
                justify-content: center; 
            }

            .gs-tagline {
                font-size: 28px;
                font-weight: 800;
                color: #FFFFFF;
                line-height: 1.25;
                margin: 0 0 12px;
                letter-spacing: -0.5px;
            }

            .gs-tagline-sub { 
                font-size: 14px; 
                color: #E2E8F0; 
                margin: 0; 
                line-height: 1.6; 
            }

            .gs-features { 
                display: flex; 
                flex-direction: column; 
                gap: 12px; 
                margin-top: 32px; 
            }

            .gs-feature { 
                display: flex; 
                align-items: center; 
                gap: 10px; 
                font-size: 13px; 
                font-weight: 500;
                color: #F1F5F9; 
            }

            .gs-feature-dot { 
                width: 8px; 
                height: 8px; 
                border-radius: 50%; 
                background: var(--yellow-gold); 
                flex-shrink: 0; 
            }

            .gs-brand-footer { 
                font-size: 12px; 
                color: #94A3B8; 
                font-weight: 500;
            }

            /* ── PANEL DERECHO: FORMULARIO ── */
            .gs-form-panel {
                background: var(--bg-surface);
                padding: 40px 36px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="gs-wrapper">

            {{-- Panel izquierdo: branding --}}
            <div class="gs-brand-panel">
                <a href="/" class="gs-logo">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="SkillSwap">
                    <span class="gs-logo-text">SkillSwap</span>
                </a>

                <div class="gs-brand-body">
                    <p class="gs-tagline">Aprende enseñando,<br>enseña aprendiendo.</p>
                    <p class="gs-tagline-sub">Conecta con compañeros de tu universidad e intercambia habilidades de forma gratuita.</p>
                    <div class="gs-features">
                        <div class="gs-feature"><span class="gs-feature-dot"></span> Intercambio de habilidades sin costo</div>
                        <div class="gs-feature"><span class="gs-feature-dot"></span> Comunidad universitaria verificada</div>
                        <div class="gs-feature"><span class="gs-feature-dot"></span> Sistema de créditos justo</div>
                    </div>
                </div>

                <p class="gs-brand-footer">SkillSwap &copy; {{ date('Y') }}</p>
            </div>

            {{-- Panel derecho: formulario (login o register) --}}
            <div class="gs-form-panel">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
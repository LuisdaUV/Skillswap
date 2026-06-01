<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SkillSwap') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            *, *::before, *::after { box-sizing: border-box; }

            body {
                margin: 0;
                min-height: 100vh;
                background: #0a0f0c;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Figtree', sans-serif;
                padding: 24px 16px;
            }

            .gs-wrapper {
                display: grid;
                grid-template-columns: 1fr 1fr;
                width: 100%;
                max-width: 920px;
                min-height: 540px;
                border-radius: 18px;
                overflow: hidden;
                border: 0.5px solid #1e2e22;
            }

            @media (max-width: 640px) {
                .gs-wrapper { grid-template-columns: 1fr; }
                .gs-brand-panel { display: none; }
            }

            /* Panel izquierdo con branding */
            .gs-brand-panel {
                background: #0f1410;
                padding: 40px 36px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                border-right: 0.5px solid #1e2e22;
            }

            .gs-logo {
                display: flex;
                align-items: center;
                gap: 10px;
                text-decoration: none;
            }

            .gs-logo img {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                object-fit: cover;
                border: 1.5px solid #2de88e;
            }

            .gs-logo-text {
                font-size: 16px;
                font-weight: 500;
                color: #e8f5ee;
            }

            .gs-brand-body { flex: 1; display: flex; flex-direction: column; justify-content: center; }

            .gs-tagline {
                font-size: 28px;
                font-weight: 500;
                color: #2de88e;
                line-height: 1.25;
                margin: 0 0 12px;
            }

            .gs-tagline-sub {
                font-size: 13px;
                color: #6b8c78;
                margin: 0;
                line-height: 1.6;
            }

            .gs-features {
                display: flex;
                flex-direction: column;
                gap: 10px;
                margin-top: 32px;
            }

            .gs-feature {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 13px;
                color: #6b8c78;
            }

            .gs-feature-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: #2de88e;
                flex-shrink: 0;
            }

            .gs-brand-footer {
                font-size: 11px;
                color: #3a4e40;
            }

            /* Panel derecho con formulario */
            .gs-form-panel {
                background: #0a0f0c;
                padding: 40px 36px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            /* Slots del formulario */
            {{ $slot }}
        </style>
    </head>
    <body>
        <div class="gs-wrapper">
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

            <div class="gs-form-panel">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
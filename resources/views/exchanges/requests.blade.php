<x-app-layout>
    <style>
        .requests-page {
            max-width: 960px;
            margin: 0 auto;
            padding: 24px 16px 40px;
            color: #002B49;
            font-size: 16px;
        }

        .requests-back {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            color: #005A9C;
            font-weight: 700;
        }

        .requests-header {
            margin: 12px 0 24px;
            padding: 24px;
            border-radius: 16px;
            background: #002B49;
            color: #FFFFFF;
        }

        .requests-header h1 {
            margin: 0;
            font-size: clamp(28px, 5vw, 36px);
            font-weight: 800;
        }

        .requests-section { margin: 24px 0; }
        .requests-section h2 { margin-bottom: 12px; font-size: 24px; font-weight: 800; }

        .requests-card, .requests-notice {
            margin-bottom: 12px;
            padding: 16px 20px;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            background: #FFFFFF;
        }

        .requests-title, .requests-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .requests-title { justify-content: space-between; }
        .requests-title h3 { margin: 0; font-size: 20px; font-weight: 800; }
        .requests-card p { margin: 6px 0; }
        .requests-meta { color: #475569; }

        .requests-status {
            padding: 4px 10px;
            border-radius: 8px;
            background: #EBF3FA;
            color: #005A9C;
            font-size: 14px;
            font-weight: 700;
        }

        .requests-actions { margin-top: 14px; }

        .requests-actions button {
            min-height: 44px;
            padding: 8px 16px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            color: #002B49;
            background: #FFFFFF;
            font-weight: 700;
            cursor: pointer;
        }

        .requests-actions .requests-accept {
            border-color: #FFC700;
            background: #FFC700;
        }
    </style>

    <div class="requests-page">
        <a href="{{ route('dashboard') }}" class="requests-back">← Volver al inicio</a>

        <header class="requests-header">
            <h1>Solicitudes</h1>
        </header>

        @if (session('success'))
            <p class="requests-notice" role="status">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="requests-notice" role="alert">{{ session('error') }}</p>
        @endif

        @foreach (['Recibidas' => $incomingRequests, 'Enviadas' => $sentRequests] as $title => $requests)
            @php
                $isIncoming = $title === 'Recibidas';
            @endphp

            <section class="requests-section">
                <h2>{{ $title }}</h2>

                @forelse ($requests as $exchange)
                    @php
                        $partner = $isIncoming ? $exchange->sender : $exchange->receiver;
                        $status = match ($exchange->status) {
                            'pendiente' => 'Pendiente',
                            'aceptado' => 'Aceptada',
                            'rechazado' => 'Rechazada',
                            'completado' => 'Completada',
                            'cancelado' => 'Cancelada',
                            default => 'Sin estado',
                        };
                    @endphp

                    <article class="requests-card">
                        <div class="requests-title">
                            <h3>{{ $partner?->name ?? 'Usuario no disponible' }}</h3>
                            <span class="requests-status">{{ $status }}</span>
                        </div>

                        <p><strong>{{ $exchange->requestedSkill?->name ?? 'Habilidad no disponible' }}</strong></p>

                        <p class="requests-meta">
                            @if ($exchange->mode === 'creditos')
                                1 crédito
                            @else
                                Intercambio directo · {{ $exchange->offeredSkill?->name ?? 'Habilidad no disponible' }}
                            @endif
                        </p>

                        @if ($exchange->meet_date && $exchange->meet_time)
                            <p class="requests-meta">
                                {{ \Illuminate\Support\Carbon::parse($exchange->meet_date)->format('d/m/Y') }}
                                · {{ \Illuminate\Support\Carbon::parse($exchange->meet_time)->format('g:i a') }}
                            </p>
                        @endif

                        @if ($isIncoming)
                            <div class="requests-actions">
                                <form method="POST" action="{{ route('exchanges.accept', $exchange) }}">
                                    @csrf
                                    <button type="submit" class="requests-accept">Aceptar</button>
                                </form>

                                <form method="POST" action="{{ route('exchanges.reject', $exchange) }}">
                                    @csrf
                                    <button type="submit">Rechazar</button>
                                </form>
                            </div>
                        @endif
                    </article>
                @empty
                    <p class="requests-card">{{ $isIncoming ? 'No tienes solicitudes pendientes.' : 'Aún no has enviado solicitudes.' }}</p>
                @endforelse
            </section>
        @endforeach
    </div>
</x-app-layout>
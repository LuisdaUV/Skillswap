<x-app-layout>
    <style>
        .sessions-page {
            max-width: 960px;
            margin: 0 auto;
            padding: 24px 16px 40px;
            color: #002B49;
            font-size: 16px;
        }

        .sessions-back {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            color: #005A9C;
            font-weight: 700;
        }

        .sessions-header {
            margin: 12px 0 24px;
            padding: 24px;
            border-radius: 16px;
            background: #002B49;
            color: #FFFFFF;
        }

        .sessions-header h1 {
            margin: 0;
            font-size: clamp(28px, 5vw, 36px);
            font-weight: 800;
        }

        .sessions-links {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .sessions-links a {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            color: #005A9C;
            font-weight: 700;
        }

        .sessions-page .ss-req-container, .sessions-notice {
            margin: 16px 0;
            padding: 16px 20px;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            background: #FFFFFF;
        }

        .sessions-page .ss-req-title {
            font-size: 20px;
            font-weight: 800;
        }

        .sessions-page .ss-req-header .ss-req-title {
            font-size: 24px;
        }

        .sessions-page .ss-req-card {
            margin-top: 12px;
            padding: 16px;
            border-radius: 10px;
            background: #F4F6F8;
        }

        .sessions-page select, .sessions-page textarea {
            display: block;
            width: 100%;
            margin: 4px 0 12px;
            padding: 8px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            background: #FFFFFF;
        }

        .sessions-page button {
            min-height: 44px;
            padding: 8px 16px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            background: #FFFFFF;
            color: #002B49;
            font-weight: 700;
            cursor: pointer;
        }

        .sessions-page .ss-req-btn-accept {
            border-color: #FFC700;
            background: #FFC700;
        }
    </style>

    <div class="sessions-page">
        <a href="{{ route('dashboard') }}" class="sessions-back">← Volver al inicio</a>

        <header class="sessions-header">
            <h1>Sesiones</h1>
        </header>

        <nav class="sessions-links" aria-label="Secciones de sesiones">
            <a href="#sesiones-pendientes">Pendientes</a>
            <a href="#historial-sesiones">Historial</a>
        </nav>

        @foreach (['session_notice', 'report_notice'] as $notice)
            @if (session($notice))
                <p class="sessions-notice" role="status">{{ session($notice) }}</p>
            @endif
        @endforeach

        @if ($errors->sessionReport->any())
            <ul class="sessions-notice" role="alert">
                @foreach ($errors->sessionReport->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        @foreach ([
    'sesiones-pendientes' => ['Pendientes', $pendingSessions],
    'historial-sesiones' => ['Historial', $sessionHistory],
] as $sectionId => [$title, $sessions])
    @php
        $isPending = $sectionId === 'sesiones-pendientes';
    @endphp

    <section id="{{ $sectionId }}" class="ss-req-container">
        <div class="ss-req-header">
            <h2 class="ss-req-title">{{ $title }}</h2>
        </div>

        @forelse ($sessions as $exchange)
            @php
                $isSender = (int) $exchange->sender_id === (int) auth()->id();
                $partner = $isSender ? $exchange->receiver : $exchange->sender;
                $alreadyConfirmed = $isSender
                    ? $exchange->sender_completed_at
                    : $exchange->receiver_completed_at;

                $scheduledAt = ($exchange->meet_date && $exchange->meet_time)
                    ? \Illuminate\Support\Carbon::parse(
                        $exchange->meet_date . ' ' . $exchange->meet_time,
                        'America/Bogota'
                    )
                    : null;
            @endphp

            <article class="ss-req-card">
                <h3 class="ss-req-title">
                    {{ $exchange->requestedSkill?->name ?? 'Habilidad no disponible' }}
                </h3>

                <p>
                    {{ $partner?->name ?? 'Usuario no disponible' }}
                    · {{ $exchange->mode === 'creditos' ? '1 crédito' : 'Intercambio directo' }}
                </p>

                @if ($exchange->mode !== 'creditos' && $exchange->offeredSkill)
                    <p>Habilidad ofrecida: {{ $exchange->offeredSkill->name }}</p>
                @endif

                <p>{{ $scheduledAt?->format('d/m/Y · g:i a') ?? 'Sin fecha acordada' }}</p>

                @if ($isPending)
                    @if ($alreadyConfirmed)
                        <p>Ya confirmaste. Falta la confirmación de tu compañero.</p>
                    @elseif (!$scheduledAt)
                        <p>La sesión necesita una fecha y hora para confirmar.</p>
                    @elseif ($scheduledAt->isFuture())
                        <p>Podrás confirmar cuando llegue la hora acordada.</p>
                    @else
                        <form method="POST" action="{{ route('exchanges.confirm-completion', $exchange) }}">
                            @csrf
                            <button type="submit" class="ss-req-btn-accept">
                                Confirmar sesión realizada
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('exchanges.cancel', $exchange) }}"
                        onsubmit="return window.confirm('¿Quieres cancelar esta sesión?');">
                        @csrf
                        <button type="submit">Cancelar sesión</button>
                    </form>
                @else
                    <p><strong>{{ $exchange->status === 'completado' ? 'Completada' : 'Cancelada' }}</strong></p>
                @endif

                @include('partials.session-report-form', ['reportSession' => $exchange])
            </article>
        @empty
            <p>{{ $isPending ? 'No tienes sesiones pendientes.' : 'Aún no tienes sesiones completadas o canceladas.' }}</p>
        @endforelse
    </section>
@endforeach
    </div>
</x-app-layout>
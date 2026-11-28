<x-app-layout>
    <style>
        .credits-page {
            max-width: 960px;
            margin: 0 auto;
            padding: 24px 16px 40px;
            color: #002B49;
            font-size: 16px;
        }

        .credits-back {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            color: #005A9C;
            font-weight: 700;
        }

        .credits-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin: 12px 0 24px;
            padding: 24px;
            border-radius: 16px;
            background: #002B49;
            color: #FFFFFF;
        }

        .credits-header h1 {
            margin: 0;
            font-size: clamp(28px, 5vw, 36px);
            font-weight: 800;
        }

        .credits-balance {
            margin: 0;
        }

        .credits-balance strong {
            display: block;
            color: #FFC700;
            font-size: 32px;
        }

        .credits-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .credits-row,
        .credits-empty {
            padding: 16px 20px;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            background: #FFFFFF;
        }

        .credits-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .credits-row p {
            margin: 0;
            overflow-wrap: anywhere;
        }

        .credits-person {
            font-size: 18px;
            font-weight: 700;
        }

        .credits-meta {
            color: #475569;
            font-size: 14px;
        }

        .credits-amount {
            flex-shrink: 0;
            color: #005A9C;
            font-size: 24px;
            font-weight: 800;
        }

        .credits-pagination {
            margin-top: 20px;
        }
    </style>

    <div class="credits-page">
        <a href="{{ route('dashboard') }}" class="credits-back">← Volver al inicio</a>

        <header class="credits-header">
            <h1>Mis movimientos</h1>
            <p class="credits-balance">
                Saldo actual
                <strong>{{ auth()->user()->credits }} cr.</strong>
            </p>
        </header>

        @if ($creditMovements->isEmpty())
            <p class="credits-empty">Aún no tienes movimientos de créditos.</p>
        @else
            <ul class="credits-list">
                @foreach ($creditMovements as $movement)
                    @php
                        $spent = (int) $movement->payer_id === (int) auth()->id();
                        $partner = $spent ? $movement->recipient_name : $movement->payer_name;
                    @endphp

                    <li class="credits-row">
                        <div>
                            <p class="credits-person">
                                {{ $spent ? 'Pagado a' : 'Recibido de' }}
                                {{ $partner ?? 'Cuenta eliminada' }}
                            </p>
                            <p class="credits-meta">
                                {{ $movement->exchange_id ? 'Sesión #' . $movement->exchange_id : 'Sesión eliminada' }}
                                · {{ \Illuminate\Support\Carbon::parse($movement->created_at, config('app.timezone'))
                                    ->setTimezone('America/Bogota')->format('d/m/Y, g:i a') }}
                            </p>
                        </div>

                        <strong class="credits-amount">
                            {{ $spent ? '−' : '+' }}{{ $movement->amount }} cr.
                        </strong>
                    </li>
                @endforeach
            </ul>
        @endif

        @if ($creditMovements->hasPages())
            <div class="credits-pagination">
                {{ $creditMovements->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
<x-app-layout>
    <style>
        .reports-page {
            --navy: #002b49;
            --blue: #005a9c;
            --gold: #ffc700;
            --muted: #475569;
            --border: #cbd5e1;
            --background: #f4f6f8;
            max-width: 960px;
            margin: 0 auto;
            padding: 24px 16px 40px;
            color: #1e293b;
        }

        .reports-back {
            display: inline-block;
            margin-bottom: 16px;
            color: var(--blue);
            font-weight: 700;
        }

        .reports-header {
            padding: 24px;
            border-top: 4px solid var(--gold);
            border-radius: 16px;
            background: var(--navy);
            color: #fff;
        }

        .reports-header h1 {
            margin: 0;
            font-size: clamp(1.4rem, 4vw, 2rem);
            font-weight: 800;
            line-height: 1.2;
        }

        .reports-header p {
            margin: 8px 0 0;
            color: #e2e8f0;
        }

        .reports-card, .reports-notice {
            margin-top: 16px;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: #fff;
        }

        .reports-card h2 {
            margin: 0 0 14px;
            color: var(--navy);
            font-weight: 800;
        }

        .reports-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
            margin: 0;
        }

        .reports-details dt, .reports-description-label {
            color: var(--muted);
            font-size: .875rem;
            font-weight: 700;
        }

        .reports-details dd {
            margin: 4px 0 0;
            overflow-wrap: anywhere;
        }

        .reports-description {
            margin: 16px 0;
            padding: 12px 16px;
            border-left: 4px solid var(--blue);
            border-radius: 8px;
            background: var(--background);
        }

        .reports-description p {
            margin: 4px 0 0;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .reports-notice {
            border-left: 4px solid var(--gold);
            color: var(--navy);
            font-weight: 700;
        }

        .reports-discard {
            padding: 8px 14px;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            background: #fff;
            color: #991b1b;
            font-weight: 700;
            cursor: pointer;
        }

        .reports-discard:hover {
            background: #fef2f2;
        }

        .reports-back:focus-visible,
        .reports-discard:focus-visible {
            outline: 2px solid var(--blue);
            outline-offset: 3px;
        }

        .reports-pagination {
            margin-top: 20px;
        }
    </style>

    <div class="reports-page">
        <a href="{{ route('dashboard') }}" class="reports-back">← Volver al panel</a>

        <header class="reports-header">
            <h1>Reportes pendientes</h1>
            <p>{{ $reports->total() }} {{ $reports->total() === 1 ? 'reporte por revisar' : 'reportes por revisar' }}</p>
        </header>

        @if (session('report_status'))
            <p class="reports-notice" role="status">{{ session('report_status') }}</p>
        @endif

        @forelse ($reports as $report)
            <article class="reports-card">
                <h2>
                    Reporte #{{ $report->id }} ·
                    {{ match ($report->reason) {
                        'insultos' => 'Insultos o lenguaje soez',
                        'ciberacoso' => 'Ciberacoso',
                        'suplantacion' => 'Suplantación de identidad',
                        default => 'Otro incumplimiento',
                    } }}
                </h2>

                <dl class="reports-details">
                    <div>
                        <dt>Enviado por</dt>
                        <dd>{{ $report->reporter_name ?? 'Cuenta eliminada' }}</dd>
                    </div>
                    <div>
                        <dt>Cuenta reportada</dt>
                        <dd>{{ $report->reported_name ?? 'Cuenta eliminada' }}</dd>
                    </div>
                    <div>
                        <dt>Sesión</dt>
                        <dd>{{ $report->exchange_id ?? 'Ya no está disponible' }}</dd>
                    </div>
                </dl>

                <div class="reports-description">
                    <span class="reports-description-label">Descripción</span>
                    <p>{{ $report->description }}</p>
                </div>

                <form method="POST"
                    action="{{ route('admin.reports.discard', $report->id) }}"
                    onsubmit="return window.confirm('¿Quieres descartar este reporte?');">
                    @csrf
                    <button type="submit" class="reports-discard">Descartar reporte</button>
                </form>
                <form method="POST"
    action="{{ route('admin.reports.sanction', $report->id) }}"
    onsubmit="return window.confirm('¿Aplicar la sanción? La cuenta perderá el acceso y sus intercambios abiertos serán cancelados.');"
    style="margin-top: 10px;">
    @csrf

    <button type="submit" class="reports-discard">
        Aplicar sanción
    </button>
</form>
            </article>
        @empty
            <p class="reports-card">No hay reportes pendientes de revisión.</p>
        @endforelse

        @if ($reports->hasPages())
            <div class="reports-pagination">
                {{ $reports->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
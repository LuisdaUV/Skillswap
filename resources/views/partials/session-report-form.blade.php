<details style="margin-top: 12px;">
    <summary>Reportar sesión</summary>

    <form method="POST" action="{{ route('exchanges.report', $reportSession) }}">
        @csrf

        <label for="report-reason-{{ $reportSession->id }}">Motivo</label>
        <select id="report-reason-{{ $reportSession->id }}" name="reason" required>
            <option value="">Selecciona un motivo</option>
            <option value="insultos">Insultos o lenguaje soez</option>
            <option value="ciberacoso">Ciberacoso</option>
            <option value="suplantacion">Suplantación de identidad</option>
            <option value="otro">Otro incumplimiento</option>
        </select>

        <label for="report-description-{{ $reportSession->id }}">¿Qué ocurrió?</label>
        <textarea id="report-description-{{ $reportSession->id }}"
            name="description" rows="3" maxlength="1000" required></textarea>

        <button type="submit" class="ss-req-btn-reject">Enviar reporte</button>
    </form>
</details>
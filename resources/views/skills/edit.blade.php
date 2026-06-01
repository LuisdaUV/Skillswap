<x-app-layout>
<style>
*, *::before, *::after { box-sizing: border-box; }

.sk-page { padding: 24px 20px; max-width: 560px; margin: 0 auto; }

.sk-card {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    padding: 24px;
}

.sk-page-title {
    font-size: 18px;
    font-weight: 500;
    color: #2de88e;
    margin: 0 0 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-info-box {
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 9px;
    padding: 12px 14px;
    margin-bottom: 20px;
}

.sk-info-row {
    font-size: 13px;
    color: #6b8c78;
    margin: 0 0 4px;
    display: flex;
    gap: 6px;
}

.sk-info-row:last-child { margin: 0; }
.sk-info-row strong { color: #e8f5ee; font-weight: 500; }

.sk-field { margin-bottom: 16px; }

.sk-label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    color: #6b8c78;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin-bottom: 6px;
}

.sk-select {
    display: block;
    width: 100%;
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 9px;
    padding: 10px 12px;
    font-size: 13px;
    color: #e8f5ee;
    font-family: inherit;
    outline: none;
    transition: border-color 0.15s;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b8c78' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 32px;
}

.sk-select:focus { border-color: #2de88e; }
.sk-select option { background: #141c17; color: #e8f5ee; }

.sk-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 0.5px solid #1e2e22;
}

.sk-cancel {
    font-size: 13px;
    color: #6b8c78;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.15s;
}

.sk-cancel:hover { color: #e8f5ee; }

.sk-btn {
    background: #2de88e;
    color: #0a0f0c;
    border: none;
    border-radius: 9px;
    padding: 9px 18px;
    font-size: 13px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: opacity 0.15s;
}

.sk-btn:hover { opacity: 0.88; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">
    <div class="sk-card">

        <p class="sk-page-title">
            <i class="ti ti-edit" aria-hidden="true"></i>
            Editar habilidad
        </p>

        <div class="sk-info-box">
            <div class="sk-info-row">
                <span>Habilidad:</span>
                <strong>{{ $skill->name }}</strong>
            </div>
            @if($skill->category)
                <div class="sk-info-row">
                    <span>Categoría:</span>
                    <strong>{{ $skill->category }}</strong>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('skills.update', $skill->id) }}">
            @csrf
            @method('PUT')

            <div class="sk-field">
                <label for="level" class="sk-label">Actualizar nivel</label>
                <select name="level" id="level" class="sk-select" required>
                    <option value="principiante" {{ $level == 'principiante' ? 'selected' : '' }}>Principiante</option>
                    <option value="intermedio"   {{ $level == 'intermedio'   ? 'selected' : '' }}>Intermedio</option>
                    <option value="avanzado"     {{ $level == 'avanzado'     ? 'selected' : '' }}>Avanzado</option>
                    <option value="experto"      {{ $level == 'experto'      ? 'selected' : '' }}>Experto</option>
                </select>
            </div>

            <div class="sk-actions">
                <a href="{{ route('skills.index') }}" class="sk-cancel">
                    <i class="ti ti-arrow-left" style="font-size:13px" aria-hidden="true"></i> Cancelar
                </a>
                <button type="submit" class="sk-btn">
                    <i class="ti ti-device-floppy" style="font-size:14px" aria-hidden="true"></i>
                    Actualizar nivel
                </button>
            </div>
        </form>

    </div>
</div>
</x-app-layout>
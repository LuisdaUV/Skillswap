<x-app-layout>
<style>
/* ── VARIABLES PALETA ACADÉMICA ── */
:root {
    --bg-app: #F4F6F8;             /* Gris claro institucional */
    --bg-surface: #FFFFFF;         /* Blanco puro para tarjetas */
    --bg-surface-hover: #EBF3FA;   /* Azul ultra claro para hovers */
    --border-color: #CBD5E1;       /* Bordes nítidos */
    
    --navy-dark: #002B49;          /* Azul Marino Profundo */
    --blue-accent: #005A9C;        /* Azul Institucional */
    --yellow-gold: #FFC700;        /* Amarillo / Dorado Escolar */
    --yellow-hover: #E6B200;       /* Hover amarillo */
    
    --text-main: #0F172A;          /* Texto principal */
    --text-muted: #64748B;         /* Texto secundario */
}

*, *::before, *::after { box-sizing: border-box; }

.sk-page { 
    padding: 24px 20px; 
    max-width: 560px; 
    margin: 0 auto; 
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: var(--text-main);
}

.sk-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.04);
}

.sk-page-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--navy-dark);
    margin: 0 0 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-page-title i {
    color: var(--blue-accent);
    font-size: 20px;
}

.sk-info-box {
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 14px 16px;
    margin-bottom: 20px;
}

.sk-info-row {
    font-size: 14px;
    color: var(--text-muted);
    margin: 0 0 6px;
    display: flex;
    gap: 8px;
}

.sk-info-row:last-child { margin: 0; }
.sk-info-row strong { color: var(--navy-dark); font-weight: 700; }

.sk-field { margin-bottom: 18px; }

.sk-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 6px;
}

.sk-select {
    display: block;
    width: 100%;
    background: #FFFFFF;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    color: var(--text-main);
    font-family: inherit;
    outline: none;
    transition: all 0.2s ease;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23005A9C' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    box-sizing: border-box;
    height: 42px;
    cursor: pointer;
}

.sk-select:focus { 
    border-color: var(--blue-accent); 
    box-shadow: 0 0 0 3px rgba(0, 90, 156, 0.15);
}

.sk-select option { background: #FFFFFF; color: var(--text-main); }

.sk-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
}

.sk-cancel {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s ease;
}

.sk-cancel:hover { color: var(--navy-dark); }

.sk-btn {
    background: var(--yellow-gold);
    color: var(--navy-dark);
    border: none;
    border-radius: 8px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background-color 0.2s ease;
}

.sk-btn:hover { background: var(--yellow-hover); }
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
                    <option value="principiante" {{ strtolower($level) == 'principiante' ? 'selected' : '' }}>Principiante</option>
                    <option value="intermedio"   {{ strtolower($level) == 'intermedio'   ? 'selected' : '' }}>Intermedio</option>
                    <option value="experto"      {{ strtolower($level) == 'experto'      ? 'selected' : '' }}>Experto</option>
                </select>
            </div>

            <div class="sk-actions">
                <a href="{{ route('skills.index') }}" class="sk-cancel">
                    <i class="ti ti-arrow-left" style="font-size:15px" aria-hidden="true"></i> Cancelar
                </a>
                <button type="submit" class="sk-btn">
                    <i class="ti ti-device-floppy" style="font-size:16px" aria-hidden="true"></i>
                    Actualizar nivel
                </button>
            </div>
        </form>

    </div>
</div>
</x-app-layout>
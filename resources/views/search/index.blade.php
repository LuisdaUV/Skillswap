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
    max-width: 900px; 
    margin: 0 auto; 
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: var(--text-main);
}

.sk-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
    box-shadow: 0 2px 6px rgba(0, 43, 73, 0.04);
}

.sk-section-label {
    font-size: 12px;
    font-weight: 800;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0 0 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ── FORMULARIO DE BÚSQUEDA ── */
.sk-search-grid {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 12px;
    align-items: end;
}

@media (max-width: 640px) {
    .sk-search-grid { grid-template-columns: 1fr; }
}

.sk-field-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: var(--navy-dark);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 6px;
}

.sk-input, .sk-select {
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
    box-sizing: border-box;
    height: 42px;
}

.sk-input::placeholder { color: #94A3B8; }
.sk-input:focus, .sk-select:focus { 
    border-color: var(--blue-accent); 
    box-shadow: 0 0 0 3px rgba(0, 90, 156, 0.15);
}

.sk-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23005A9C' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
}

.sk-select option { background: #FFFFFF; color: var(--text-main); }

.sk-btn {
    background: var(--yellow-gold);
    color: var(--navy-dark);
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    transition: background-color 0.2s ease;
    height: 42px;
}

.sk-btn:hover { background: var(--yellow-hover); }

/* ── TAGS POPULARES ── */
.sk-tags { display: flex; flex-wrap: wrap; gap: 8px; }

.sk-tag {
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    color: var(--text-main);
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 99px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
}

.sk-tag:hover { 
    border-color: var(--blue-accent); 
    color: var(--blue-accent); 
    background: var(--bg-surface-hover);
}

.sk-tag-count { 
    background: var(--blue-accent); 
    color: #FFFFFF; 
    font-size: 11px; 
    font-weight: 700;
    padding: 1px 7px;
    border-radius: 12px;
}

/* ── CATEGORÍAS ── */
.sk-cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 10px;
}

.sk-cat-item {
    background: var(--bg-app);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    padding: 16px 12px;
    text-align: center;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    color: var(--navy-dark);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.sk-cat-item:hover { 
    border-color: var(--blue-accent); 
    color: var(--blue-accent); 
    background: var(--bg-surface-hover);
    transform: translateY(-2px);
}

.sk-cat-item i { font-size: 22px; color: var(--blue-accent); }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">

    {{-- Encabezado superior --}}
    <div style="background: var(--navy-dark); border-radius: 12px; padding: 14px 20px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0, 43, 73, 0.08);">
        <h2 style="color: #FFFFFF; font-size: 16px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class="ti ti-search" style="color: var(--yellow-gold); font-size: 20px;"></i> Buscar compañeros
        </h2>

        <a href="{{ route('dashboard') }}" style="border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: #FFFFFF; padding: 6px 14px; border-radius: 8px; text-decoration: none; display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; transition: all 0.2s ease;">
            <i class="ti ti-home" style="font-size: 15px;"></i> Inicio
        </a>
    </div>

    {{-- Formulario --}}
    <div class="sk-card">
        <p class="sk-section-label">
            <i class="ti ti-filter" aria-hidden="true" style="color: var(--blue-accent);"></i> Filtrar búsqueda
        </p>
        <form method="GET" action="{{ route('search.skills') }}">
            <div class="sk-search-grid">
                <div>
                    <label class="sk-field-label" for="query">Habilidad</label>
                    <input type="text" name="query" id="query"
                        placeholder="Ej: Programación, Inglés..."
                        value="{{ request('query') }}"
                        class="sk-input">
                </div>
                <div>
                    <label class="sk-field-label" for="category">Categoría</label>
                    <select name="category" id="category" class="sk-select">
                        <option value="">Todas las categorías</option>
                        <option value="tecnologia"  {{ request('category')=='tecnologia' ? 'selected':'' }}>Tecnología</option>
                        <option value="idiomas"     {{ request('category')=='idiomas'    ? 'selected':'' }}>Idiomas</option>
                        <option value="ciencias"    {{ request('category')=='ciencias'   ? 'selected':'' }}>Ciencias</option>
                        <option value="arte"        {{ request('category')=='arte'       ? 'selected':'' }}>Arte y Diseño</option>
                        <option value="musica"      {{ request('category')=='musica'     ? 'selected':'' }}>Música</option>
                        <option value="deporte"     {{ request('category')=='deporte'    ? 'selected':'' }}>Deporte</option>
                        <option value="otros"       {{ request('category')=='otros'      ? 'selected':'' }}>Otros</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="sk-btn">
                        <i class="ti ti-search" style="font-size:16px" aria-hidden="true"></i>
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Habilidades populares --}}
    <div class="sk-card">
        <p class="sk-section-label">
            <i class="ti ti-trending-up" aria-hidden="true" style="color: var(--blue-accent);"></i> Habilidades más buscadas
        </p>
        <div class="sk-tags">
            @foreach($popularSkills as $skill)
                <a href="{{ route('search.skills', ['query' => $skill->name]) }}" class="sk-tag">
                    {{ $skill->name }}
                    <span class="sk-tag-count">{{ $skill->users_count }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Categorías --}}
    <div class="sk-card">
        <p class="sk-section-label">
            <i class="ti ti-layout-grid" aria-hidden="true" style="color: var(--blue-accent);"></i> Explorar por categoría
        </p>
        <div class="sk-cat-grid">
            <a href="{{ route('search.skills', ['category' => 'tecnologia']) }}" class="sk-cat-item">
                <i class="ti ti-device-laptop" aria-hidden="true"></i> Tecnología
            </a>
            <a href="{{ route('search.skills', ['category' => 'idiomas']) }}" class="sk-cat-item">
                <i class="ti ti-world" aria-hidden="true"></i> Idiomas
            </a>
            <a href="{{ route('search.skills', ['category' => 'ciencias']) }}" class="sk-cat-item">
                <i class="ti ti-atom" aria-hidden="true"></i> Ciencias
            </a>
            <a href="{{ route('search.skills', ['category' => 'arte']) }}" class="sk-cat-item">
                <i class="ti ti-palette" aria-hidden="true"></i> Arte
            </a>
            <a href="{{ route('search.skills', ['category' => 'musica']) }}" class="sk-cat-item">
                <i class="ti ti-music" aria-hidden="true"></i> Música
            </a>
            <a href="{{ route('search.skills', ['category' => 'deporte']) }}" class="sk-cat-item">
                <i class="ti ti-ball-football" aria-hidden="true"></i> Deporte
            </a>
            <a href="{{ route('search.skills', ['category' => 'otros']) }}" class="sk-cat-item">
                <i class="ti ti-books" aria-hidden="true"></i> Otros
            </a>
        </div>
    </div>

</div>
</x-app-layout>
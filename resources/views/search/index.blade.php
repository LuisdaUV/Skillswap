<x-app-layout>
<style>
*, *::before, *::after { box-sizing: border-box; }

.sk-page { padding: 24px 20px; max-width: 900px; margin: 0 auto; }

.sk-page-title {
    font-size: 18px;
    font-weight: 500;
    color: #2de88e;
    margin: 0 0 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sk-card {
    background: #0f1410;
    border: 0.5px solid #1e2e22;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 12px;
}

.sk-section-label {
    font-size: 11px;
    font-weight: 500;
    color: #2de88e;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin: 0 0 14px;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Formulario de búsqueda */
.sk-search-grid {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 10px;
    align-items: end;
}

@media (max-width: 640px) {
    .sk-search-grid { grid-template-columns: 1fr; }
}

.sk-field-label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    color: #6b8c78;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin-bottom: 6px;
}

.sk-input, .sk-select {
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
}

.sk-input::placeholder { color: #6b8c78; }
.sk-input:focus, .sk-select:focus { border-color: #2de88e; }

.sk-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b8c78' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 32px;
}

.sk-select option { background: #141c17; color: #e8f5ee; }

.sk-btn {
    background: #2de88e;
    color: #0a0f0c;
    border: none;
    border-radius: 9px;
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    transition: opacity 0.15s;
    height: 40px;
}

.sk-btn:hover { opacity: 0.88; }

/* Tags populares */
.sk-tags { display: flex; flex-wrap: wrap; gap: 6px; }

.sk-tag {
    background: #141c17;
    border: 0.5px solid #1e2e22;
    color: #c8e8d4;
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 99px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: border-color 0.15s, color 0.15s;
}

.sk-tag:hover { border-color: #2de88e; color: #2de88e; }
.sk-tag-count { color: #6b8c78; font-size: 11px; }

/* Categorías */
.sk-cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 8px;
}

.sk-cat-item {
    background: #141c17;
    border: 0.5px solid #1e2e22;
    border-radius: 10px;
    padding: 14px 12px;
    text-align: center;
    text-decoration: none;
    font-size: 13px;
    color: #6b8c78;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    transition: border-color 0.15s, color 0.15s;
}

.sk-cat-item:hover { border-color: #2de88e; color: #2de88e; }
.sk-cat-item i { font-size: 20px; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="sk-page">



    <div class="bg-[#111312] border border-gray-800 rounded-xl p-3 flex justify-between items-center mb-6 shadow-lg">
    <h2 class="text-[#00e676] text-base font-bold flex items-center pl-2">
        <span class="mr-2"></span> Buscar compañeros
    </h2>

    <a href="{{ route('dashboard') }}" class="border border-gray-700 bg-[#1a1d1b] text-gray-300 hover:text-[#00e676] hover:border-[#00e676] px-3 py-1.5 rounded-lg transition-all duration-300 flex items-center text-xs font-bold shadow-sm mr-1">
        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        Inicio
    </a>
</div>

    {{-- Formulario --}}
    <div class="sk-card">
        <p class="sk-section-label">
            <i class="ti ti-filter" aria-hidden="true"></i> Filtrar búsqueda
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
                        <i class="ti ti-search" style="font-size:14px" aria-hidden="true"></i>
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Habilidades populares --}}
    <div class="sk-card">
        <p class="sk-section-label">
            <i class="ti ti-trending-up" aria-hidden="true"></i> Habilidades más buscadas
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
            <i class="ti ti-layout-grid" aria-hidden="true"></i> Explorar por categoría
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
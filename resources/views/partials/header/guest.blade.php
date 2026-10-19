<header class="sticky top-0 z-40 border-b border-black/5 bg-[#f8f6f2]/95 backdrop-blur">
    <div class="mx-auto flex min-h-[4.5rem] max-w-7xl items-center justify-between gap-5 px-5 sm:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3 rounded focus:outline-none focus:ring-2 focus:ring-[#a96242]" aria-label="Estilo Vivo, inicio">
            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#292722] font-serif text-lg text-white" aria-hidden="true">EV</span>
            <span class="font-serif text-xl font-semibold tracking-tight text-[#292722]">Estilo Vivo</span>
        </a>

        <nav class="hidden items-center gap-7 text-sm md:flex" aria-label="Navegación principal">
            <a href="{{ route('home') }}#inicio" class="text-[#5f5a51] transition hover:text-[#a96242]">Inicio</a>
            <a href="{{ route('home') }}#quienes-somos" class="text-[#5f5a51] transition hover:text-[#a96242]">El equipo</a>
            <a href="{{ route('home') }}#servicios" class="text-[#5f5a51] transition hover:text-[#a96242]">Servicios</a>
            <a href="{{ route('galeria.index') }}" class="text-[#5f5a51] transition hover:text-[#a96242]">Galería</a>
            <a href="{{ route('home') }}#ubicacion" class="text-[#5f5a51] transition hover:text-[#a96242]">Dónde estamos</a>
            <a href="{{ route('login') }}" class="rounded-full bg-[#a96242] px-5 py-3 font-semibold text-white transition hover:bg-[#914e33]">Pide cita</a>
        </nav>

        <div class="flex items-center gap-2 md:hidden">
            <button type="button" aria-label="Mostrar búsqueda" aria-expanded="false" aria-controls="searchBox"
                onclick="const box = document.getElementById('searchBox'); const open = box.classList.toggle('hidden'); this.setAttribute('aria-expanded', String(!open));"
                class="grid h-10 w-10 place-items-center rounded-full text-[#514c44] hover:bg-black/5 focus:outline-none focus:ring-2 focus:ring-[#a96242]">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" stroke-width="1.7"></circle>
                    <path stroke-linecap="round" stroke-width="1.7" d="m16 16 4 4"></path>
                </svg>
            </button>
            <button type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobileMenu"
                onclick="const menu = document.getElementById('mobileMenu'); const open = menu.classList.toggle('hidden'); this.setAttribute('aria-expanded', String(!open)); this.setAttribute('aria-label', open ? 'Abrir menú' : 'Cerrar menú');"
                class="grid h-10 w-10 place-items-center rounded-full text-[#514c44] hover:bg-black/5 focus:outline-none focus:ring-2 focus:ring-[#a96242]">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-width="1.7" d="M4 7h16M4 12h16M4 17h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="searchBox" class="hidden border-t border-black/5 px-5 py-4 md:hidden">
        <form action="{{ route('search') }}" method="GET" class="mx-auto max-w-7xl">
            <label for="site-search" class="sr-only">Buscar en Estilo Vivo</label>
            <input id="site-search" type="search" name="query" placeholder="Buscar..." class="w-full rounded-full border-black/15 bg-white px-5 py-3 text-sm focus:border-[#a96242] focus:ring-[#a96242]">
        </form>
    </div>

    <nav id="mobileMenu" class="hidden border-t border-black/5 bg-[#f8f6f2] px-6 py-4 md:hidden" aria-label="Navegación móvil">
        <div class="mx-auto flex max-w-7xl flex-col gap-1 text-sm">
            <a href="{{ route('home') }}#inicio" class="rounded-lg px-3 py-3 hover:bg-black/5">Inicio</a>
            <a href="{{ route('home') }}#quienes-somos" class="rounded-lg px-3 py-3 hover:bg-black/5">El equipo</a>
            <a href="{{ route('home') }}#servicios" class="rounded-lg px-3 py-3 hover:bg-black/5">Servicios</a>
            <a href="{{ route('galeria.index') }}" class="rounded-lg px-3 py-3 hover:bg-black/5">Galería</a>
            <a href="{{ route('home') }}#ubicacion" class="rounded-lg px-3 py-3 hover:bg-black/5">Dónde estamos</a>
            <a href="{{ route('login') }}" class="mt-2 rounded-full bg-[#a96242] px-5 py-3 text-center font-semibold text-white">Pide cita</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-3 hover:bg-black/5">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="rounded-lg px-3 py-3 hover:bg-black/5">Crear cuenta</a>
        </div>
    </nav>
</header>

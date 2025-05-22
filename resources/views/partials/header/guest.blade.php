<!-- Header para visitantes no autenticados -->
<header class="bg-white shadow-md px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-orange-600">Estilo Vivo</h1>

        <!-- Íconos móviles -->
        <div class="flex items-center space-x-4 md:hidden">
            <!-- Lupa -->
            <button onclick="document.getElementById('searchBox').classList.toggle('hidden')"
                    class="text-gray-600 hover:text-orange-600 focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>

            <!-- Botón hamburguesa -->
            <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                    class="text-gray-600 hover:text-orange-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Navegación escritorio -->
        <nav class="hidden md:flex items-center space-x-6 text-sm">
            <a href="#inicio" class="text-gray-700 hover:text-orange-600">Inicio</a>
            <a href="#quienes-somos" class="text-gray-700 hover:text-orange-600">Quiénes somos</a>
            <a href="#servicios" class="text-gray-700 hover:text-orange-600">Servicios</a>
            <a href="{{ route('galeria.index') }}" class="text-gray-700 hover:text-orange-600">Galería</a>
            <a href="#ubicacion" class="text-gray-700 hover:text-orange-600">Ubicación</a>
            <a href="{{ route('login') }}" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">Cita previa</a>
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600">Inicia sesión</a>
            <a href="{{ route('register') }}" class="text-gray-700 hover:text-orange-600">Regístrate</a>
        </nav>
    </div>

    <!-- Buscador desplegable -->
    <div id="searchBox" class="hidden px-4 mt-2 md:mt-0 md:px-0">
        <form action="{{ route('search') }}" method="GET" class="max-w-md mx-auto">
            <div class="relative">
                <input type="text" name="query"
                       placeholder="Buscar..."
                       class="w-full border border-gray-300 rounded-full px-4 py-2 pl-10 shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-400 text-sm transition" />
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
            </div>
        </form>
    </div>

    <!-- Menú móvil -->
    <div id="mobileMenu" class="hidden md:hidden mt-4 px-6 space-y-3">
        <a href="#inicio" class="block text-gray-700 hover:text-orange-600">Inicio</a>
        <a href="#quienes-somos" class="block text-gray-700 hover:text-orange-600">Quiénes somos</a>
        <a href="#servicios" class="block text-gray-700 hover:text-orange-600">Servicios</a>
        <a href="{{ route('galeria.index') }}" class="block text-gray-700 hover:text-orange-600">Galería</a>
        <a href="#ubicacion" class="block text-gray-700 hover:text-orange-600">Ubicación</a>
        <a href="{{ route('login') }}" class="block text-orange-600 font-medium">Cita previa</a>
        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-orange-600">Inicia sesión</a>
        <a href="{{ route('register') }}" class="block text-gray-700 hover:text-orange-600">Regístrate</a>
    </div>
</header>

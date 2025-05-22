<!-- Header para usuarios autenticados -->
<header class="bg-white shadow-md px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-orange-600">Estilo Vivo</h1>

        <!-- Navegación -->
        <nav class="hidden md:flex items-center space-x-6 text-sm">
            <a href="#inicio" class="text-gray-700 hover:text-orange-600">Inicio</a>
            <a href="#servicios" class="text-gray-700 hover:text-orange-600">Servicios</a>
            <a href="{{ route('galeria.index') }}" class="text-gray-700 hover:text-orange-600">Galería</a>
            <a href="#ubicacion" class="text-gray-700 hover:text-orange-600">Ubicación</a>
            <a href="{{ route('citas.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">Nueva cita</a>
        </nav>

        <!-- Avatar con dropdown -->
        <div class="relative ml-4">
            <button onclick="document.getElementById('userDropdown').classList.toggle('hidden')" class="focus:outline-none">
                <div class="w-10 h-10 bg-orange-200 text-orange-800 font-semibold rounded-full flex items-center justify-center shadow">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </button>

            <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-md z-50">
                <a href="{{ route('citas.mis') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                    Mis citas
                </a>

                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">Mis cortes</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">Mi perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
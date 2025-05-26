<!-- Header para peluqueros autenticados -->
<header class="bg-white shadow-md px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-orange-600">Estilo Vivo</h1>

        <!-- Navegación (solo visible en escritorio) -->
        <nav class="hidden md:flex items-center space-x-6 text-sm">
            <a href="{{ route('agenda.index') }}" class="text-gray-700 hover:text-orange-600">Agenda</a>
            <a href="{{ route('galeria.create') }}" class="text-gray-700 hover:text-orange-600">Publicar Foto</a>
        </nav>

        <!-- Avatar con dropdown (visible en todos los tamaños) -->
        <div class="relative ml-4">
            <button onclick="document.getElementById('peluqueroDropdown').classList.toggle('hidden')" class="focus:outline-none">
                <div class="w-10 h-10 bg-orange-200 text-orange-800 font-semibold rounded-full flex items-center justify-center shadow">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </button>

            <!-- Dropdown con links (incluye también los de navegación para móviles) -->
            <div id="peluqueroDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded shadow-md z-50">
                <!-- Solo visible en móvil -->
                <div class="block md:hidden border-b border-gray-200">
                    <a href="{{ route('agenda.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">Agenda</a>
                    <a href="{{ route('galeria.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">Publicar Foto</a>
                </div>

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

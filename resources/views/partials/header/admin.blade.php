<!-- Header para administrador -->
<header class="bg-white shadow-md px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <!-- Logo del sitio -->
        <h1 class="text-2xl font-bold text-orange-600">Estilo Vivo</h1>

        <!-- Navegación visible en escritorio (oculta en móvil) -->
        <nav class="hidden md:flex items-center space-x-6 text-sm">
            <!-- Enlace al panel principal -->
            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-orange-600">Inicio</a>

            <!-- Ver todos los peluqueros registrados -->
            <a href="{{ route('admin.peluquero.index') }}" class="text-gray-700 hover:text-orange-600">Ver peluqueros</a>

            <!-- Acceder al formulario para registrar un peluquero -->
            <a href="{{ route('admin.peluquero.create') }}" class="text-gray-700 hover:text-orange-600">Registrar peluquero</a>
        </nav>

        <!-- Avatar del usuario logueado con dropdown -->
        <div class="relative ml-4">
            <!-- Botón redondo con inicial del nombre del admin -->
            <button onclick="
                document.getElementById('adminDropdown').classList.toggle('hidden');
                console.log('Menú desplegable del admin abierto'); // 🔍 Log para depuración
            " class="focus:outline-none">
                <div class="w-10 h-10 bg-orange-200 text-orange-800 font-semibold rounded-full flex items-center justify-center shadow">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </button>

            <!-- Menú desplegable con opciones -->
            <div id="adminDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-md z-50">
                <!-- Acceso al perfil -->
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                    Mi perfil
                </a>

                <!-- Botón para cerrar sesión -->
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

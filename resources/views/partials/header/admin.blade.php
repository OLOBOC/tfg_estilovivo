<!-- Header para administrador -->
<header class="bg-white shadow-md px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <!-- Logo que redirige al inicio (welcome) -->
        <a href="{{ url('/') }}" class="text-2xl font-bold text-orange-600">Estilo Vivo</a>


        <!-- Menú de navegación visible solo en escritorio -->
        <nav class="hidden md:flex items-center space-x-6 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-orange-600">Inicio</a>
            <a href="{{ route('admin.peluquero.index') }}" class="text-gray-700 hover:text-orange-600">Ver peluqueros</a>
            <a href="{{ route('admin.peluquero.create') }}" class="text-gray-700 hover:text-orange-600">Registrar peluquero</a>
        </nav>

        <!-- Avatar del usuario administrador con menú desplegable -->
        <div class="relative ml-4">
            <!-- Botón que muestra el menú del administrador -->
            <button onclick="
                document.getElementById('adminDropdown').classList.toggle('hidden');
                console.log('Menú desplegable del admin abierto');
            " class="focus:outline-none">
                <div class="w-10 h-10 bg-orange-200 text-orange-800 font-semibold rounded-full flex items-center justify-center shadow">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </button>

            <!-- Menú desplegable del usuario -->
            <div id="adminDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-md z-50">
                <!-- Enlace al perfil -->
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:text-orange-600">Inicio</a>
                <a href="{{ route('admin.peluquero.index') }}" class="block px-4 py-2 text-gray-700 hover:text-orange-600">Ver peluqueros</a>
                <a href="{{ route('admin.peluquero.create') }}" class="block px-4 py-2 text-gray-700 hover:text-orange-600">Registrar peluquero</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                    Mi perfil</a>
                

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
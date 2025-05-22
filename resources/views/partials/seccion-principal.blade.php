<div class="bg-white rounded-2xl shadow-2xl px-8 py-10 max-w-xl mx-auto text-center relative">

    <!-- Botón de cerrar -->
    <button onclick="cerrarModal()" class="absolute top-3 right-3 text-gray-400 hover:text-red-600 text-xl font-bold">&times;</button>

    <!-- Título principal -->
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Bienvenido a <span class="text-orange-600">Estilo Vivo</span></h2>

    <!-- Descripción -->
    <p class="text-gray-600 text-base mb-6">Reserva tu cita para un corte de cabello con nuestros peluqueros expertos.</p>

    <!-- Imagen -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('build/img/portada.png') }}" alt="Estilo Vivo" class="rounded-xl w-48 h-48 object-cover shadow">
    </div>

    <!-- Botón principal -->
    <a href="{{ route('register') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg text-base transition">
        Registrarse
    </a>

    <!-- Enlace inicio de sesión -->
    <div class="mt-4">
        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-orange-600 transition">Iniciar sesión</a>
    </div>
</div>

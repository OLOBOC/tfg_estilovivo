<div class="bg-white rounded-3xl shadow-2xl px-8 py-10 max-w-lg mx-auto text-center relative animate-fade-in">
    <!-- Botón de cerrar -->
<button onclick="cerrarModal()" class="absolute top-3 right-3 text-gray-400 hover:text-red-600 text-2xl font-bold transition">&times;</button>


    <!-- Título -->
    <h2 class="text-3xl font-bold text-gray-800 mb-3">Bienvenido a <span class="text-orange-600">Estilo Vivo</span></h2>

    <!-- Descripción -->
    <p class="text-gray-600 text-base leading-relaxed mb-6">Reserva tu cita con nuestros peluqueros expertos y vive una experiencia de estilo única.</p>

    <!-- Imagen -->
    <div class="flex justify-center mb-6">
        <img src="/img/portada.png" alt="Estilo Vivo" class="rounded-xl w-70 h-48 object-cover shadow-md">
    </div>

    <!-- Botón principal -->
    <a href="{{ route('register') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg text-base transition duration-200">
        Registrarse
    </a>

    <!-- Enlace inicio de sesión -->
    <p class="mt-4 text-sm text-gray-600">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-orange-600 hover:underline">Inicia sesión</a>
    </p>
</div>

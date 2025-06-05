<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between text-sm text-gray-600">

        <!-- enlaces -->
        <div class="flex space-x-4 mb-2 sm:mb-0">
            <a href="{{ url('/#inicio') }}" class="text-gray-700 hover:text-orange-600">Inicio</a>
            <a href="{{ url('/#servicios') }}" class="text-gray-700 hover:text-orange-600">Servicios</a>
            <a href="{{ route('galeria.index') }}" class="text-gray-700 hover:text-orange-600">Galería</a>
            <a href="{{ url('/#ubicacion') }}" class="text-gray-700 hover:text-orange-600">Ubicación</a>
        </div>

        <!-- derechos -->
        <div class="text-center sm:text-right">
            <p>&copy; {{ date('Y') }} Estilo Vivo. Todos los derechos reservados.</p>
        </div>

    </div>
</footer>

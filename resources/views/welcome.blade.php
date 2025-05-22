<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estilo Vivo</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-800 font-sans">

    <!-- Header -->
    @auth
    @include('partials.header.auth')
    @else
    @include('partials.header.guest')
    @endauth

    <!-- Hero principal -->
    <section id="inicio" class="bg-gradient-to-b from-orange-100 to-white text-center py-20 px-6">
        <h2 class="text-4xl md:text-5xl font-bold mb-4">Tu estilo, nuestra pasión</h2>
        <p class="text-xl text-gray-600 mb-6">Expertos en cortes, coloración y estilo moderno para ti.</p>
        <a href="{{ route('citas.create') }}"
            class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">Cita previa</a>
    </section>

    <!-- Quiénes somos -->
    <section id="quienes-somos" class="max-w-5xl mx-auto px-6 py-16">
        <h3 class="text-3xl font-bold text-center mb-6">Quiénes somos</h3>
        <p class="text-lg text-gray-700 text-center max-w-3xl mx-auto">
            Somos un equipo de estilistas apasionados por la belleza y el bienestar de nuestros clientes. Con años de experiencia, ofrecemos atención personalizada y las últimas tendencias en peluquería y estética.
        </p>
    </section>

    <!-- Servicios -->
    <section id="servicios" class="bg-orange-50 py-16 px-6">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-3xl font-bold text-center mb-10">Nuestros servicios</h3>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Corte de cabello</h4>
                    <p class="text-gray-600">Para hombres, mujeres y niños. Adaptado a tu estilo.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Coloración</h4>
                    <p class="text-gray-600">Tintes, mechas, balayage y más técnicas profesionales.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Tratamientos</h4>
                    <p class="text-gray-600">Nutritivos, hidratantes y anticaída para todo tipo de cabello.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ubicación -->
    <section id="ubicacion" class="bg-orange-50 py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-3xl font-bold mb-6">¿Dónde estamos?</h3>
            <p class="text-gray-700 mb-4">Calle Estilo 123, Ciudad, País</p>
            <iframe class="w-full h-64 rounded-lg shadow"
                src="https://www.google.com/maps/embed?pb=..."
                allowfullscreen></iframe>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 text-center py-6 text-sm text-gray-600">
        &copy; {{ date('Y') }} Estilo Vivo. Todos los derechos reservados.
    </footer>

    <!-- Modal emergente con sección principal SOLO para invitados -->
@guest
<style>
    .modal-fade {
        transition: opacity 0.3s ease;
    }
    .modal-hidden {
        opacity: 0;
        pointer-events: none;
    }
    .modal-visible {
        opacity: 1;
        pointer-events: auto;
    }
</style>

<div id="modal-principal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-[9999] modal-fade modal-hidden">
    <div class="transform scale-95 transition-all duration-300 ease-in-out" id="modal-content">
        @include('partials.seccion-principal')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Mostrar siempre el modal al usuario invitado
        const modal = document.getElementById('modal-principal');
        const content = document.getElementById('modal-content');

        if (modal) {
            console.log("Mostrando modal principal a usuario invitado");
            modal.classList.remove('modal-hidden');
            modal.classList.add('modal-visible');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');

            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    cerrarModal();
                }
            });
        } else {
            console.log("No se ha mostrado el modal (no es invitado)");
        }

        function cerrarModal() {
            modal.classList.remove('modal-visible');
            modal.classList.add('modal-hidden');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
        }
    });
</script>
@endguest

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estilo Vivo</title>
    @vite('resources/css/app.css')
    <style>
        .modal-fade {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .modal-hidden {
            opacity: 0;
            pointer-events: none;
            transform: scale(0.95);
        }

        .modal-visible {
            opacity: 1;
            pointer-events: auto;
            transform: scale(1);
        }
    </style>
</head>

<body class="bg-white text-gray-800 font-sans">

 <!-- Header según el rol -->
@auth
    @php
        $rol = Auth::user()->rol;
    @endphp

    @if ($rol === 'admin')
        @include('partials.header.admin') {{-- Header para administrador --}}
    @else
        @include('partials.header.auth') {{-- Cliente o peluquero autenticado --}}
    @endif
@else
    @include('partials.header.guest') {{-- Visitante no autenticado --}}
@endauth





    <!-- Hero principal -->
    <section id="inicio" class="bg-gradient-to-b from-orange-100 to-white text-center py-20 px-6">
        <h2 class="text-4xl md:text-5xl font-bold mb-4">Tu estilo, nuestra pasión</h2>
        <p class="text-xl text-gray-600 mb-6">Expertos en cortes, coloración y estilo moderno para ti.</p>
        <a href="{{ route('citas.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">Cita previa</a>
    </section>

   @if (isset($mensaje))
    <script>
        // Mostrar el mensaje en la consola del navegador
        console.log("{{ $mensaje }}");
    </script>
@endif


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

    <!-- Modal para invitados (una vez) -->
   @guest
<div id="modal-backdrop" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-[9999]" style="display: none;">
    <div id="modal-principal" class="modal-fade modal-hidden">
        @include('partials.seccion-principal')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Verificamos si el modal ya se ha mostrado antes
        if (!localStorage.getItem('modalEstiloVivoVisto')) {
            console.log("Mostrando modal a invitado nuevo");

            const backdrop = document.getElementById('modal-backdrop');
            const modal = document.getElementById('modal-principal');

            if (backdrop && modal) {
                // Mostrar el modal
                backdrop.style.display = 'flex';
                setTimeout(() => {
                    modal.classList.remove('modal-hidden');
                    modal.classList.add('modal-visible');
                }, 10);

                // Guardamos que ya se mostró
                localStorage.setItem('modalEstiloVivoVisto', 'true');

                // Permite cerrar clicando fuera
                backdrop.addEventListener('click', (e) => {
                    if (e.target === backdrop) {
                        modal.classList.remove('modal-visible');
                        modal.classList.add('modal-hidden');
                        setTimeout(() => backdrop.style.display = 'none', 300);
                    }
                });
            }
        } else {
            console.log("Modal ya fue visto por este invitado");
        }
    });

    // Función para cerrar desde el botón (usa class en el botón HTML)
    function cerrarModal() {
        const modal = document.getElementById('modal-principal');
        const backdrop = document.getElementById('modal-backdrop');

        modal.classList.remove('modal-visible');
        modal.classList.add('modal-hidden');
        setTimeout(() => backdrop.style.display = 'none', 300);
    }
</script>
@endguest


</body>

</html>
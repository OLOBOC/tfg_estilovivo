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
    @include('partials.header.admin')
    @elseif ($rol === 'peluquero')
    @include('partials.header.peluquero') {{-- Nuevo header para peluqueros --}}
    @else
    @include('partials.header.auth')
    @endif
    @else
    @include('partials.header.guest')
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
    @include('partials.Inicio.quienes-somos')
    <script>
        console.log("seccion quienes somos cargada")
    </script>


    <!-- Servicios -->
    <section id="servicios" class="bg-orange-50 py-16 px-6">
        @include('partials.Inicio.servicios')

    </section>

    <!-- Ubicación -->
    @include('partials.Inicio.mapa.ubicacion')

    <!-- Footer -->
    @include('partials.footer.footer')

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
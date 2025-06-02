<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda diaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <style>
        .flecha-dia {
            font-size: 2rem;
            font-weight: bold;
            padding: 0 1rem;
            line-height: 1;
        }

        /* animacion fade-slide */
        .fade-slide {
            transition: all 0.2s ease;
            transform: translateY(-5px);
            opacity: 0;
        }

        .fade-slide.show {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
</head>
<body class="bg-orange-50 font-sans min-h-screen text-gray-800 flex flex-col">

    {{-- header dinamico --}}
    @auth
        @php $rol = Auth::user()->rol; @endphp

        @if ($rol === 'admin')
            @include('partials.header.admin')
        @elseif ($rol === 'peluquero')
            @include('partials.header.peluquero')
        @else
            @include('partials.header.auth')
        @endif
    @else
        @include('partials.header.guest')
    @endauth

    {{-- logica de fechas --}}
    @php
        use Carbon\Carbon;

        $fechaActual = Carbon::parse(request('fecha', now()));
        $fechaAnterior = $fechaActual->copy()->subDay()->toDateString();
        $fechaSiguiente = $fechaActual->copy()->addDay()->toDateString();

        $horas = collect(range(8, 20))->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00');
    @endphp

    {{-- contenedor principal --}}
    <div class="w-full max-w-4xl mx-auto mt-6 sm:mt-10 p-4 sm:p-6 bg-white rounded-lg shadow min-h-[80vh]">

        {{-- navegacion por dias --}}
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('agenda.index', ['fecha' => $fechaAnterior]) }}"
               class="flecha-dia text-orange-600 hover:text-orange-800">‹</a>

            <h1 class="text-base sm:text-2xl font-bold text-orange-600 text-center flex-1">
                {{ $fechaActual->translatedFormat('l, d \d\e F Y') }}
            </h1>

            <a href="{{ route('agenda.index', ['fecha' => $fechaSiguiente]) }}"
               class="flecha-dia text-orange-600 hover:text-orange-800">›</a>
        </div>

        <script>
            console.log("Mostrando agenda del dia: {{ $fechaActual->toDateString() }}");
        </script>

        {{-- agenda por hora --}}
        <div class="divide-y border-t">
            @foreach ($horas as $horaStr)
                @php
                    $cita = $citas->firstWhere('hora', $horaStr);
                @endphp

                <div class="flex flex-col sm:grid sm:grid-cols-12 gap-4 py-4 px-2 sm:px-4 hover:bg-orange-50">

                    {{-- hora --}}
                    <div class="sm:col-span-2 font-semibold text-gray-600 text-sm sm:text-base">
                        {{ $horaStr }}h
                    </div>

                    {{-- detalles cliente --}}
                    <div class="sm:col-span-8 space-y-1 text-sm text-gray-700">
                        @if ($cita)
                            <p><strong>Cliente:</strong> {{ $cita->cliente->name ?? 'Desconocido' }}</p>
                            <p><strong>Email:</strong> {{ $cita->cliente->email ?? '-' }}</p>

                            @if (!empty($cita->servicios))
                                <p class="mt-2 font-medium text-gray-800">Servicios:</p>
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach ($cita->servicios as $servicio)
                                        <li>{{ ucwords(str_replace('_', ' ', $servicio)) }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        @else
                            <p class="text-gray-400 italic">Hora libre</p>
                        @endif
                    </div>

                    {{-- dropdown de acciones --}}
                    <div class="sm:col-span-2 relative">
                        @if ($cita)
                            {{-- boton que activa el menu --}}
                            <button onclick="toggleDropdown({{ $cita->id }})"
                                    class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition text-sm w-full sm:w-auto">
                                Ver info 
                            </button>

                            {{-- menu oculto por defecto --}}
                            <div id="dropdown-{{ $cita->id }}"
                                 class="hidden fade-slide absolute right-0 mt-2 w-52 bg-white border border-gray-200 rounded shadow z-10">

                              <a href="{{ route('clientes.cortes', $cita->cliente->id) }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">Ver anteriores</a>

                              <a href="{{ route('clientes.cortes.create', $cita->cliente->id) }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">Publicar nuevo</a> 
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- script para manejar los dropdowns --}}
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`dropdown-${id}`);
            const isHidden = dropdown.classList.contains('hidden');

            // cerrar todos los demas
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('show');
            });

            // mostrar u ocultar el actual
            if (isHidden) {
                dropdown.classList.remove('hidden');
                setTimeout(() => dropdown.classList.add('show'), 10); // animacion
                console.log("menu desplegado para cita id:", id);
            } else {
                dropdown.classList.remove('show');
                setTimeout(() => dropdown.classList.add('hidden'), 150);
            }
        }

        // cerrar si haces click fuera
        document.addEventListener('click', function (e) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
                if (!drop.contains(e.target) && !e.target.closest('button')) {
                    drop.classList.remove('show');
                    setTimeout(() => drop.classList.add('hidden'), 150);
                }
            });
        });
    </script>

</body>
</html>

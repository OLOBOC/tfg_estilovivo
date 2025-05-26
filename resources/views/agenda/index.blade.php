<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agenda diaria</title>
    @vite('resources/css/app.css')

    <style>
        /* Estilo para las flechas de navegación */
        .flecha-dia {
            font-size: 2rem;
            font-weight: bold;
            padding: 0 1rem;
            line-height: 1;
        }
    </style>
</head>

<body class="bg-orange-50 font-sans min-h-screen text-gray-800 flex flex-col">

    {{-- Cargar el header según el rol del usuario --}}
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

    {{-- Lógica para fechas y horas del día --}}
    @php
        use Carbon\Carbon;

        $fechaActual = Carbon::parse(request('fecha', now()));
        $fechaAnterior = $fechaActual->copy()->subDay()->toDateString();
        $fechaSiguiente = $fechaActual->copy()->addDay()->toDateString();

        $horas = collect(range(8, 20))->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00');
    @endphp

    {{-- Contenedor principal de la agenda --}}
    <div class="w-full max-w-4xl mx-auto mt-6 sm:mt-10 p-4 sm:p-6 bg-white rounded-lg shadow min-h-[80vh]">

        {{-- Navegación por días --}}
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('agenda.index', ['fecha' => $fechaAnterior]) }}"
               class="flecha-dia text-orange-600 hover:text-orange-800">‹</a>

            <h1 class="text-xl sm:text-2xl font-bold text-orange-600 text-center">
                {{ $fechaActual->translatedFormat('l, d \d\e F Y') }}
            </h1>

            <a href="{{ route('agenda.index', ['fecha' => $fechaSiguiente]) }}"
               class="flecha-dia text-orange-600 hover:text-orange-800">›</a>
        </div>

        {{-- Mensaje para consola (depuración de fecha) --}}
        <script>
            console.log("Mostrando agenda del día: {{ $fechaActual->toDateString() }}");
        </script>

        {{-- Fila por cada hora del día --}}
        <div class="divide-y border-t">
            @foreach ($horas as $horaStr)
                @php
                    $cita = $citas->firstWhere('hora', $horaStr);
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-start py-4 px-2 sm:px-4 hover:bg-orange-50">

                    {{-- Columna: hora --}}
                    <div class="sm:col-span-2 font-semibold text-gray-600">
                        {{ $horaStr }}h
                    </div>

                    {{-- Columna: contenido (cliente o libre) --}}
                    <div class="sm:col-span-8 space-y-1 text-sm text-gray-700">
                        @if ($cita)
                            <p><strong>Cliente:</strong> {{ $cita->cliente->name ?? 'Desconocido' }}</p>
                            <p><strong>Email:</strong> {{ $cita->cliente->email ?? '-' }}</p>
                        @else
                            <p class="text-gray-400 italic">Hora libre</p>
                        @endif
                    </div>

                    {{-- Columna: botón de acción --}}
                    <div class="sm:col-span-2">
                        @if ($cita)
                            <a href="{{ route('citas.show', ['cita' => $cita->id]) }}"
                               class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition text-sm block text-center w-full sm:w-auto">
                                Ver info
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>

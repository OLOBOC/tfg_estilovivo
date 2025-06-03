<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- necesario para responsive -->
    <title>Calendario de Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .calendar-day:hover {
            background-color: #fde68a;
        }

        .selected-day {
            background-color: #f97316 !important;
            color: white !important;
        }

        .selected-hora {
            background-color: #f97316 !important;
            color: white !important;
        }
    </style>
    {{-- script js de citas --}}
    @vite('resources/js/components/citas.js')
</head>


<body class="bg-orange-50 min-h-screen font-sans">

    <!-- header reutilizable -->
    @include('partials.header.auth')

    <!-- contenido principal -->
    <main class="p-4 sm:p-8 max-w-3xl mx-auto w-full">
        <h1 class="text-2xl sm:text-3xl font-bold text-orange-600 mb-6 text-center">Reserva tu Cita</h1>

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center text-sm sm:text-base">
            {{ session('error') }}
        </div>
        @endif

        <!-- Navegación de meses -->
        <div class="flex items-center justify-between mb-4">
            <button id="prevMonth" class="text-orange-600 hover:underline text-sm sm:text-base">&larr; Anterior</button>
            <h2 id="monthYear" class="text-base sm:text-xl font-semibold text-gray-800"></h2>
            <button id="nextMonth" class="text-orange-600 hover:underline text-sm sm:text-base">Siguiente &rarr;</button>
        </div>

        <!-- Cabecera del calendario -->
        <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-600 text-xs sm:text-sm mb-1">
            <div>Lun</div>
            <div>Mar</div>
            <div>Mié</div>
            <div>Jue</div>
            <div>Vie</div>
            <div>Sáb</div>
            <div>Dom</div>
        </div>

        <!-- Días del calendario -->
        <div id="calendar" class="grid grid-cols-7 gap-2 mb-6"></div>

        <!-- Horas disponibles -->
        <div id="horas-container" class="hidden mb-6">
            <h2 class="text-base sm:text-lg font-semibold mb-2 text-gray-800">Horas disponibles para <span id="selected-date"></span></h2>
            <div id="horas" class="grid grid-cols-2 sm:grid-cols-3 gap-2"></div>
        </div>

        <!-- Selector de peluquero -->
        <div id="peluquero-container" class="hidden mb-4">
            <label for="peluquero" class="block font-medium text-gray-700 mb-1">Selecciona peluquero:</label>
            <select id="peluquero" class="w-full border rounded px-4 py-2 text-sm">
                <option value="">-- Elige --</option>
                @foreach ($peluqueros as $peluquero)
                <option value="{{ $peluquero->id }}">{{ $peluquero->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Servicios disponibles -->
        <div id="servicios-container" class="hidden mb-6">
            <label class="block font-medium text-gray-700 mb-2">Selecciona servicios:</label>
            <div id="lista-servicios" class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-sm">
                @php
                $serviciosDisponibles = [
                'Corte', 'Lavado', 'Peinado', 'Tinte',
                'Mechas', 'Moldeado', 'Alisado',
                'Barba', 'Maquillaje', 'Manicura', 'Pedicura', 'Recogido', 'Extensiones'
                ];
                @endphp
                @foreach ($serviciosDisponibles as $servicio)
                <label class="flex items-center">
                    <input type="checkbox"
                        class="checkbox-servicio mr-2"
                        value="{{ strtolower(str_replace(' ', '_', $servicio)) }}">
                    {{ $servicio }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- Confirmar cita -->
        <div id="confirmar-container" class="hidden text-center">
            <button id="confirmarBtn" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 transition">
                Confirmar cita
            </button>
        </div>
    </main>

    <!-- Formulario oculto para envío -->
    <form id="formCita" method="POST" action="{{ route('citas.store') }}">
        @csrf
        <input type="hidden" name="fecha" id="input-fecha">
        <input type="hidden" name="hora" id="input-hora">
        <input type="hidden" name="peluquero_id" id="input-peluquero">
        <div id="servicios-hidden"></div>
    </form>


</body>

</html>
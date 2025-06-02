<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- necesario para responsive -->
    <title>Calendario de Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .calendar-day:hover { background-color: #fde68a; }
        .selected-day { background-color: #f97316 !important; color: white !important; }
        .selected-hora { background-color: #f97316 !important; color: white !important; }
    </style>
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
            <div>Lun</div><div>Mar</div><div>Mié</div><div>Jue</div><div>Vie</div><div>Sáb</div><div>Dom</div>
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

    <!-- scripts -->
    <script>
        const calendar = document.getElementById('calendar');
        const monthYear = document.getElementById('monthYear');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');
        const horasDiv = document.getElementById('horas');
        const horasContainer = document.getElementById('horas-container');
        const peluqueroContainer = document.getElementById('peluquero-container');
        const serviciosContainer = document.getElementById('servicios-container');
        const confirmarContainer = document.getElementById('confirmar-container');
        const selectedDateText = document.getElementById('selected-date');
        const peluqueroSelect = document.getElementById('peluquero');
        const inputFecha = document.getElementById('input-fecha');
        const inputHora = document.getElementById('input-hora');
        const inputPeluquero = document.getElementById('input-peluquero');
        const confirmarBtn = document.getElementById('confirmarBtn');
        const serviciosHidden = document.getElementById('servicios-hidden');
        const horasDisponibles = ["10:00", "11:00", "12:00", "15:00", "16:00", "17:00"];
        let currentDate = new Date();
        let citaSeleccionada = { fecha: null, hora: null, peluquero: null };

        function renderCalendario(date = new Date()) {
            calendar.innerHTML = "";
            const year = date.getFullYear();
            const month = date.getMonth();
            const today = new Date(new Date().setHours(0, 0, 0, 0));
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            let firstWeekday = firstDay.getDay();
            firstWeekday = firstWeekday === 0 ? 6 : firstWeekday - 1;

            monthYear.textContent = `${date.toLocaleString("es-ES", { month: "long" }).toUpperCase()} ${year}`;

            for (let i = 0; i < firstWeekday; i++) {
                calendar.appendChild(document.createElement("div"));
            }

            for (let d = 1; d <= lastDay.getDate(); d++) {
                const thisDate = new Date(year, month, d);
                const btn = document.createElement("button");
                btn.textContent = d;
                btn.className = "calendar-day text-gray-700 bg-white p-3 rounded shadow text-sm";

                if (thisDate < today) {
                    btn.classList.add("opacity-40", "cursor-not-allowed");
                    btn.disabled = true;
                } else {
                    btn.classList.add("hover:bg-orange-100");
                    btn.onclick = () => seleccionarDia(thisDate, btn);
                }

                calendar.appendChild(btn);
            }
        }

        function seleccionarDia(fecha, btn) {
            citaSeleccionada.fecha = fecha.toISOString().split('T')[0];
            selectedDateText.textContent = citaSeleccionada.fecha;
            inputFecha.value = citaSeleccionada.fecha;

            document.querySelectorAll('.calendar-day').forEach(b => b.classList.remove('selected-day'));
            btn.classList.add('selected-day');

            horasDiv.innerHTML = '';
            horasContainer.classList.remove('hidden');
            peluqueroContainer.classList.remove('hidden');
            serviciosContainer.classList.remove('hidden');
            confirmarContainer.classList.add('hidden');
        }

        function seleccionarHora(horaBtn, hora) {
            citaSeleccionada.hora = hora;
            inputHora.value = hora;

            document.querySelectorAll('.hora-btn').forEach(btn => btn.classList.remove('selected-hora'));
            horaBtn.classList.add('selected-hora');

            confirmarContainer.classList.remove('hidden');
        }

        peluqueroSelect.addEventListener('change', () => {
            if (peluqueroSelect.value && citaSeleccionada.fecha) {
                citaSeleccionada.peluquero = peluqueroSelect.value;
                inputPeluquero.value = peluqueroSelect.value;

                fetch(`/horas-ocupadas?fecha=${citaSeleccionada.fecha}&peluquero_id=${citaSeleccionada.peluquero}`)
                    .then(res => res.json())
                    .then(ocupadas => {
                        horasDiv.innerHTML = '';
                        let hayDisponibles = false;
                        horasDisponibles.forEach(hora => {
                            if (!ocupadas.includes(hora)) {
                                const horaBtn = document.createElement('button');
                                horaBtn.textContent = hora;
                                horaBtn.className = "hora-btn px-4 py-2 bg-gray-100 rounded hover:bg-orange-200";
                                horaBtn.onclick = () => seleccionarHora(horaBtn, hora);
                                horasDiv.appendChild(horaBtn);
                                hayDisponibles = true;
                            }
                        });
                        if (!hayDisponibles) {
                            horasDiv.innerHTML = '<p class="text-gray-500 col-span-3 text-center">No hay horas disponibles para este día.</p>';
                        }
                        confirmarContainer.classList.add('hidden');
                    });
            } else {
                confirmarContainer.classList.add('hidden');
            }
        });

        confirmarBtn.addEventListener('click', function () {
            serviciosHidden.innerHTML = '';
            const seleccionados = document.querySelectorAll('.checkbox-servicio:checked');
            seleccionados.forEach((checkbox) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'servicios[]';
                input.value = checkbox.value;
                serviciosHidden.appendChild(input);
            });
            document.getElementById('formCita').submit();
        });

        prevMonthBtn.onclick = () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendario(currentDate);
        };

        nextMonthBtn.onclick = () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendario(currentDate);
        };

        renderCalendario(currentDate);
    </script>
</body>
</html>

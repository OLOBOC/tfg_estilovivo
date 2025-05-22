<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .calendar-day:hover { background-color: #fde68a; }
        .selected-day { background-color: #f97316 !important; color: white !important; }
        .selected-hora { background-color: #f97316 !important; color: white !important; }
    </style>
</head>
<body class="bg-orange-50 min-h-screen flex flex-col items-center p-10 font-sans">

<h1 class="text-3xl font-bold text-orange-600 mb-6">Reserva tu Cita</h1>

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
        {{ session('error') }}
    </div>
@endif

<!-- Navegación de Meses -->
<div class="flex items-center justify-between w-full max-w-2xl mb-4">
    <button id="prevMonth" class="text-orange-600 hover:underline">&larr; Anterior</button>
    <h2 id="monthYear" class="text-xl font-semibold text-gray-800"></h2>
    <button id="nextMonth" class="text-orange-600 hover:underline">Siguiente &rarr;</button>
</div>

<!-- Cabecera del Calendario (Lunes a Domingo) -->
<div class="grid grid-cols-7 gap-2 text-center w-full max-w-2xl mb-2 font-semibold text-gray-600">
    <div>Lun</div><div>Mar</div><div>Mié</div><div>Jue</div><div>Vie</div><div>Sáb</div><div>Dom</div>
</div>

<!-- Días del Calendario -->
<div id="calendar" class="grid grid-cols-7 gap-2 w-full max-w-2xl mb-8"></div>

<!-- Horas -->
<div id="horas-container" class="mb-6 hidden w-full max-w-md">
    <h2 class="text-xl font-semibold mb-2 text-gray-800">Horas disponibles para <span id="selected-date"></span></h2>
    <div id="horas" class="grid grid-cols-3 gap-2"></div>
</div>

<!-- Peluquero -->
<div id="peluquero-container" class="mb-4 hidden w-full max-w-md">
    <label for="peluquero" class="block font-medium text-gray-700 mb-1">Selecciona peluquero:</label>
    <select id="peluquero" class="w-full border rounded px-4 py-2">
        <option value="">-- Elige --</option>
        @foreach ($peluqueros as $peluquero)
            <option value="{{ $peluquero->id }}">{{ $peluquero->name }}</option>
        @endforeach
    </select>
</div>

<!-- Servicios -->
<div id="servicios-container" class="mb-6 hidden w-full max-w-md">
    <label class="block font-medium text-gray-700 mb-2">Selecciona servicios:</label>
    <div class="grid grid-cols-2 gap-2">
        <label><input type="checkbox" name="servicios[]" value="corte" class="mr-2">Corte</label>
        <label><input type="checkbox" name="servicios[]" value="lavado" class="mr-2">Lavado</label>
        <label><input type="checkbox" name="servicios[]" value="peinado" class="mr-2">Peinado</label>
        <label><input type="checkbox" name="servicios[]" value="tinte" class="mr-2">Tinte</label>
        <label><input type="checkbox" name="servicios[]" value="tratamiento" class="mr-2">Tratamiento capilar</label>
    </div>
</div>

<!-- Confirmar -->
<div id="confirmar-container" class="text-center hidden">
    <button id="confirmarBtn" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 transition">
        Confirmar cita
    </button>
</div>

<!-- Formulario oculto para enviar a Laravel -->
<form id="formCita" method="POST" action="{{ route('citas.store') }}">
    @csrf
    <input type="hidden" name="fecha" id="input-fecha">
    <input type="hidden" name="hora" id="input-hora">
    <input type="hidden" name="peluquero_id" id="input-peluquero">
</form>

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

    const horasDisponibles = ["10:00", "11:00", "12:00", "15:00", "16:00", "17:00"];
    let currentDate = new Date();

    let citaSeleccionada = {
        fecha: null,
        hora: null,
        peluquero: null
    };

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
            btn.className = "calendar-day text-gray-700 bg-white p-3 rounded shadow";

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

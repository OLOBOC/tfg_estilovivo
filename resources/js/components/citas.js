document.addEventListener('DOMContentLoaded', () => {
    // variables principales del calendario y formulario
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
        citaSeleccionada.fecha = fecha.toLocaleDateString('fr-CA');
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
});

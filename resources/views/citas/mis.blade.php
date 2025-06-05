<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Citas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- para responsive real -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-50 min-h-screen font-sans">

    <!-- header reutilizable -->
    @include('partials.header.auth')

    <!-- contenido principal -->
    <main class="p-4 sm:p-8">
        <h1 class="text-2xl sm:text-4xl font-extrabold text-orange-600 mb-6 text-center">Mis Citas</h1>

        <!-- mensaje de exito si existe -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center text-base">
            {{ session('success') }}
        </div>
        @endif

        <!-- contenedor general -->
        <div class="max-w-2xl mx-auto space-y-10">

            <!-- citas futuras -->
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Próximas citas</h2>

                @php
                $futurasCitas = $citas->where('fecha', '>=', now()->format('Y-m-d'))
                ->map(fn($cita) => [
                'id' => $cita->id,
                'fecha' => $cita->fecha,
                'hora' => $cita->hora,
                ])->values();
                @endphp

                @forelse ($citas->where('fecha', '>=', now()->format('Y-m-d')) as $cita)
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow space-y-4">
                    <div class="space-y-1 text-base text-gray-800">
                        <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
                        <p><strong>Hora:</strong> {{ $cita->hora }}</p>
                        <p><strong>Peluquero:</strong> {{ $cita->peluquero->name ?? 'No asignado' }}</p>

                        <!-- mostrar servicios como etiquetas -->
                        <p><strong>Servicios:</strong></p>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach (explode(',', $cita->servicio) as $servicio)
                            <span class="bg-orange-200 text-orange-800 text-xs font-medium px-2 py-1 rounded">
                                {{ ucfirst(trim(str_replace('_', ' ', $servicio))) }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-3">
                        <p class="text-sm text-gray-600 font-medium mb-1">Quedan:</p>
                        <div class="flex justify-between text-gray-800 text-sm sm:text-base" id="contador-{{ $cita->id }}">
                            <div class="text-center">
                                <div class="countdown font-mono text-xl"><span class="dias">--</span></div>
                                <div>días</div>
                            </div>
                            <div class="text-center">
                                <div class="countdown font-mono text-xl"><span class="horas">--</span></div>
                                <div>horas</div>
                            </div>
                            <div class="text-center">
                                <div class="countdown font-mono text-xl"><span class="min">--</span></div>
                                <div>min</div>
                            </div>
                            <div class="text-center">
                                <div class="countdown font-mono text-xl"><span class="seg">--</span></div>
                                <div>seg</div>
                            </div>
                        </div>
                    </div>

                    <!-- formulario de cancelacion -->
                    <form method="POST" action="{{ route('citas.destroy') }}" class="text-right">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $cita->id }}">
                        <button type="submit" class="text-red-600 hover:underline font-semibold text-sm sm:text-base">Cancelar</button>
                    </form>
                </div>
                @empty
                <p class="text-gray-600 text-center">No tienes citas futuras.</p>
                @endforelse
            </div>

            <!-- historial de citas -->
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Historial de citas</h2>

                @forelse ($citas->where('fecha', '<', now()->format('Y-m-d')) as $cita)
                    <div class="bg-gray-100 p-4 sm:p-6 rounded-lg shadow space-y-3 sm:flex sm:items-center sm:justify-between">
                        <div class="text-base text-gray-800">
                            <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
                            <p><strong>Hora:</strong> {{ $cita->hora }}</p>
                            <p><strong>Peluquero:</strong> {{ $cita->peluquero->name ?? 'No asignado' }}</p>

                            <!-- mostrar servicios como etiquetas -->
                            <p><strong>Servicio:</strong></p>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach (explode(',', $cita->servicio) as $servicio)
                                <span class="bg-gray-300 text-gray-800 text-xs font-medium px-2 py-1 rounded">
                                    {{ ucfirst(trim(str_replace('_', ' ', $servicio))) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-600 text-center">No tienes citas anteriores.</p>
                    @endforelse
            </div>
        </div>
    </main>
    <!-- Footer -->
    @include('partials.footer.footer')

    <!-- script contador -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const citas = @json($futurasCitas);

            citas.forEach(cita => {
                const container = document.getElementById(`contador-${cita.id}`);
                if (!container) return;

                const target = new Date(`${cita.fecha}T${cita.hora}:00`);

                function actualizar() {
                    const ahora = new Date();
                    let diff = target - ahora;

                    if (diff <= 0) {
                        container.innerHTML = '<p class="text-sm text-red-600">¡Es hora de tu cita!</p>';
                        return;
                    }

                    const dias = Math.floor(diff / (1000 * 60 * 60 * 24));
                    diff %= 1000 * 60 * 60 * 24;
                    const horas = Math.floor(diff / (1000 * 60 * 60));
                    diff %= 1000 * 60 * 60;
                    const minutos = Math.floor(diff / (1000 * 60));
                    diff %= 1000 * 60;
                    const segundos = Math.floor(diff / 1000);

                    container.querySelector('.dias').textContent = dias;
                    container.querySelector('.horas').textContent = horas;
                    container.querySelector('.min').textContent = minutos;
                    container.querySelector('.seg').textContent = segundos;

                    setTimeout(actualizar, 1000);
                }

                actualizar();
            });
        });
    </script>
</body>

</html>
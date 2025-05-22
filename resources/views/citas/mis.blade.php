<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen font-sans">
    @include('partials.header.auth')

    <main class="p-4 sm:p-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-orange-600 mb-6 text-center">Mis Citas</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Citas futuras -->
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
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow flex flex-col sm:flex-row justify-between gap-y-4 sm:gap-y-0 sm:items-center">
                        <div>
                            <p class="text-sm sm:text-base"><strong>Fecha:</strong> {{ $cita->fecha }}</p>
                            <p class="text-sm sm:text-base"><strong>Hora:</strong> {{ $cita->hora }}</p>
                            <p class="text-sm sm:text-base"><strong>Peluquero:</strong> {{ $cita->peluquero->name ?? 'No asignado' }}</p>

                            <p class="mt-3 text-sm text-gray-600 font-medium">Quedan:</p>
                            <div class="flex gap-4 text-center text-gray-800 text-sm sm:text-base" id="contador-{{ $cita->id }}">
                                <div><span class="countdown font-mono text-xl"><span class="dias">--</span></span><br>días</div>
                                <div><span class="countdown font-mono text-xl"><span class="horas">--</span></span><br>horas</div>
                                <div><span class="countdown font-mono text-xl"><span class="min">--</span></span><br>min</div>
                                <div><span class="countdown font-mono text-xl"><span class="seg">--</span></span><br>seg</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('citas.destroy') }}" class="text-right">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $cita->id }}">
                            <button type="submit" class="text-red-600 hover:underline font-semibold text-sm sm:text-base">Cancelar</button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-600">No tienes citas futuras.</p>
                @endforelse
            </div>

            <!-- Citas pasadas -->
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mt-6 mb-4">Historial de citas</h2>
                @forelse ($citas->where('fecha', '<', now()->format('Y-m-d')) as $cita)
                    <div class="bg-gray-100 p-4 sm:p-6 rounded-lg shadow flex flex-col sm:flex-row justify-between gap-y-4 sm:gap-y-0 sm:items-center">
                        <div>
                            <p class="text-sm sm:text-base"><strong>Fecha:</strong> {{ $cita->fecha }}</p>
                            <p class="text-sm sm:text-base"><strong>Hora:</strong> {{ $cita->hora }}</p>
                            <p class="text-sm sm:text-base"><strong>Peluquero:</strong> {{ $cita->peluquero->name ?? 'No asignado' }}</p>
                        </div>
                        <a href="{{ route('citas.info', $cita->id) }}" class="text-blue-600 hover:underline font-semibold text-sm sm:text-base text-right sm:text-left">Info</a>
                    </div>
                @empty
                    <p class="text-gray-600">No tienes citas anteriores.</p>
                @endforelse
            </div>
        </div>
    </main>

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen p-8 font-sans">
    <h1 class="text-3xl font-bold text-orange-600 mb-6 text-center">Mis Citas</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto">
        @forelse ($citas as $cita)
            <div class="bg-white p-4 rounded shadow mb-4">
                <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
                <p><strong>Hora:</strong> {{ $cita->hora }}</p>
                <p><strong>Peluquero:</strong> {{ $cita->peluquero->name ?? 'No asignado' }}</p>
            </div>
        @empty
            <p class="text-gray-700 text-center">No tienes citas reservadas.</p>
        @endforelse
    </div>
</body>
</html>

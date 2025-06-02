<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cortes anteriores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 text-gray-800 min-h-screen">

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

    <main class="max-w-5xl mx-auto px-4 py-10">

        {{-- titulo --}}
        <h2 class="text-3xl font-bold text-orange-700 mb-8 text-center">
            Cortes anteriores de {{ $cliente->name }}
        </h2>

        {{-- listado de cortes --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($cortes as $corte)
                @php
                    $descripcion = $corte->descripcion ?? 'sin descripcion';
                    $esTinte = str_contains(strtolower($descripcion), 'tinte');
                @endphp

                <div class="bg-white shadow rounded overflow-hidden">
                    <img src="{{ $corte->imagen }}" alt="foto del corte" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <p class="{{ $esTinte ? 'font-bold text-purple-700' : 'text-gray-800' }}">
                            {{ $descripcion }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">Registrado el {{ $corte->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-600">no hay cortes anteriores registrados</p>
            @endforelse
        </div>

        {{-- volver --}}
        <div class="text-center mt-10">
            <a href="{{ url()->previous() }}"
               class="bg-gray-300 text-gray-800 px-5 py-2 rounded hover:bg-gray-400 transition">
                volver
            </a>
        </div>

    </main>

</body>
</html>

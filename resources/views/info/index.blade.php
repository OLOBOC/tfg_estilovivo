<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Cortes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 text-gray-800 min-h-screen">

    {{-- header dinamico --}}
    @auth
        @php $rol = Auth::user()->rol; @endphp

        @if ($rol === 'cliente')
            @include('partials.header.auth')
        @elseif ($rol === 'peluquero')
            @include('partials.header.peluquero')
        @else
            @include('partials.header.admin')
        @endif
    @else
        @include('partials.header.guest')
    @endauth

    <main class="max-w-5xl mx-auto px-4 py-10">

        <h2 class="text-3xl font-bold text-orange-700 mb-8 text-center">Mis Cortes</h2>

        {{-- galeria de cortes del cliente --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($cortes as $corte)
                @php
                    $desc = $corte->descripcion ?? 'sin descripcion';
                    $esTinte = str_contains(strtolower($desc), 'tinte');
                @endphp

                <div class="bg-white shadow rounded overflow-hidden">
                    <img src="{{ $corte->imagen }}" alt="foto del corte" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <p class="{{ $esTinte ? 'font-bold text-purple-700' : 'text-gray-800' }}">
                            {{ $desc }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            registrado el {{ $corte->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-600">no tienes cortes registrados</p>
            @endforelse
        </div>

    </main>

</body>
</html>

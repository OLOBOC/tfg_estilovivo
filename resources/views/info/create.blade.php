<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicar nuevo corte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 text-gray-800 min-h-screen">

    {{-- header dinamico segun el rol del usuario --}}
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

    {{-- contenedor principal --}}
    <main class="max-w-xl mx-auto px-4 py-10">

        {{-- titulo --}}
        <h2 class="text-3xl font-bold text-orange-700 mb-6 text-center">
            Nuevo corte para {{ $cliente->name }}
        </h2>

        {{-- formulario para subir corte --}}
        <form method="POST"
              action="{{ route('clientes.cortes.guardar', $cliente->id) }}"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded shadow space-y-6"
              onsubmit="console.log('enviando corte nuevo para cliente id: {{ $cliente->id }}')">
              
            @csrf

            {{-- campo imagen obligatoria --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">imagen del corte</label>
                <input type="file" name="imagen" required
                       class="w-full border border-gray-300 p-2 rounded bg-white">
                @error('imagen')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- descripcion opcional --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">descripcion (opcional)</label>
                <textarea name="descripcion" rows="3"
                          class="w-full border border-gray-300 p-2 rounded bg-white">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- boton de envio --}}
            <button type="submit"
                    class="bg-orange-600 text-white px-5 py-2 rounded hover:bg-orange-700 transition w-full font-semibold">
                publicar corte
            </button>
        </form>

        {{-- volver a la pagina anterior --}}
        <div class="mt-6 text-center">
            <a href="{{ url()->previous() }}"
               class="inline-block bg-gray-300 text-gray-800 px-5 py-2 rounded hover:bg-gray-400 transition">
                volver
            </a>
        </div>

    </main>

</body>
</html>

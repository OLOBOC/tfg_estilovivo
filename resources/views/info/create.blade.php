<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicar Nuevo Corte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 text-gray-800 min-h-screen relative">

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

    {{-- toast de exito --}}
    @if (session('success'))
        <div id="toast"
            class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade">
            {{ session('success') }}
        </div>
        <script>
            console.log("mensaje recibido: '{{ session('success') }}'")
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) toast.style.display = 'none';
            }, 3000);
        </script>
    @endif

    {{-- contenido principal --}}
    <main class="max-w-xl mx-auto px-4 py-10">

        {{-- titulo --}}
        <h2 class="text-3xl font-bold text-orange-700 mb-6 text-center">
            Publicar Nuevo Corte para {{ ucfirst($cliente->name) }}
        </h2>

        {{-- formulario --}}
        <form method="POST"
              action="{{ route('clientes.cortes.guardar', $cliente->id) }}"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded shadow space-y-6"
              onsubmit="console.log('enviando corte nuevo para cliente id: {{ $cliente->id }}')">

            @csrf

            {{-- campo imagen --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Imagen del Corte</label>
                <input type="file" name="imagen" required
                       class="w-full border border-gray-300 p-2 rounded bg-white">
                @error('imagen')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            

            {{-- descripcion --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción (opcional)</label>
                <textarea name="descripcion" rows="3"
                          class="w-full border border-gray-300 p-2 rounded bg-white">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- boton --}}
            <button type="submit"
                    class="bg-orange-600 text-white px-5 py-2 rounded hover:bg-orange-700 transition w-full font-semibold">
                Publicar Corte
            </button>
        </form>

        {{-- volver --}}
        <div class="mt-6 text-center">
            <a href="{{ url()->previous() }}"
               class="inline-block bg-gray-300 text-gray-800 px-5 py-2 rounded hover:bg-gray-400 transition">
                Volver
            </a>
        </div>

    </main>

</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar corte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-50 text-gray-800 min-h-screen">

    {{-- header segun el rol --}}
    @auth
    @php $rol = Auth::user()->rol; @endphp

    @if ($rol === 'peluquero')
    @include('partials.header.peluquero')
    @elseif ($rol === 'admin')
    @include('partials.header.admin')
    @else
    @include('partials.header.auth')
    @endif
    @else
    @include('partials.header.guest')
    @endauth

    <main class="max-w-xl mx-auto px-4 py-10">

        <h2 class="text-3xl font-bold text-orange-700 mb-6 text-center">Editar corte</h2>

        {{-- formulario --}}
        <form method="POST"
            action="{{ route('cortes.update', $corte->id) }}"
            enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow space-y-6"
            onsubmit="console.log('enviando actualizacion de corte id: {{ $corte->id }}')">

            @csrf
            @method('PUT')

            {{-- imagen actual --}}
            <div>
                <p class="text-sm text-gray-700 mb-1">Imagen actual:</p>
                <img src="{{ asset($corte->imagen) }}" alt="imagen actual"
                    class="w-full h-52 object-cover rounded border mb-2">
            </div>

            {{-- subir nueva imagen (opcional) --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nueva imagen (opcional)</label>
                <input type="file" name="imagen" class="w-full border border-gray-300 p-2 rounded bg-white">
                @error('imagen')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- descripcion --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">Descripcion</label>
                <textarea name="descripcion" rows="3"
                    class="w-full border border-gray-300 p-2 rounded bg-white">{{ old('descripcion', $corte->descripcion) }}</textarea>
                @error('descripcion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- boton --}}
            <button type="submit"
                class="bg-orange-600 text-white px-5 py-2 rounded hover:bg-orange-700 transition w-full font-semibold">
                Actualizar corte
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
    <!-- Footer -->
    @include('partials.footer.footer')
</body>

</html>
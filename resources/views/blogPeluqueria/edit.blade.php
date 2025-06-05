<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar publicación</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-100 font-sans">

  {{-- Header --}}
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

  <main class="flex justify-center items-start min-h-screen py-10 px-4">
    @auth
    @if ($rol === 'peluquero' || $rol === 'admin')
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-xl">
      <h2 class="text-3xl font-bold text-orange-600 text-center mb-6">Editar publicación</h2>

      @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        <script>
          console.log("Errores de validación en formulario de edición");
        </script>
      </div>
      @endif

      <form action="{{ route('galeria.update', $galeria->id) }}" method="POST" enctype="multipart/form-data"
        onsubmit="console.log('Editando publicación...')">
        @csrf
        @method('PUT')

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Imagen actual</label>
          <img src="{{ asset($galeria->imagen) }}" alt="Imagen actual" class="w-full h-64 object-cover rounded border mb-2">
          <input type="file" name="imagen" accept="image/*"
            class="block w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm">
          <p class="text-xs text-gray-500 mt-1">Deja vacío para mantener la imagen actual.</p>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
          <select name="servicio" required
            class="block w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm">
            <option value="">Selecciona un servicio</option>
            <option value="Corte" {{ $galeria->servicio == 'Corte' ? 'selected' : '' }}>Corte</option>
            <option value="Peinado" {{ $galeria->servicio == 'Peinado' ? 'selected' : '' }}>Peinado</option>
            <option value="Tinte" {{ $galeria->servicio == 'Tinte' ? 'selected' : '' }}>Tinte</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del estilo</label>
          <input type="text" name="nombre_estilo" required
            value="{{ old('nombre_estilo', $galeria->nombre_estilo) }}"
            class="block w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm">
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
          <textarea name="descripcion" rows="3" required
            class="block w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm">{{ old('descripcion', $galeria->descripcion) }}</textarea>
        </div>

        <div class="text-center">
          <button type="submit"
            class="bg-orange-500 text-white px-6 py-2 rounded-full font-semibold hover:bg-orange-600 transition">
            Guardar cambios
          </button>
        </div>
      </form>
    </div>
    @else
    <p class="text-center text-gray-600">No tienes permiso para editar esta publicación.</p>
    <script>
      console.log("Acceso denegado a edición");
    </script>
    @endif
    @endauth
  </main>

</body>

</html>
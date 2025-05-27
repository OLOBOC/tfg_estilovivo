<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Publicaciones guardadas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-100 font-sans">
  <div class="max-w-6xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-orange-600 mb-6 text-center">Tus publicaciones guardadas</h2>

    @if($galeria->isEmpty())
      <p class="text-center text-gray-600">No has guardado ninguna publicación todavía.</p>
    @else
      <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($galeria as $item)
          <div class="bg-white rounded-lg shadow p-4">
            <img src="{{ asset($item->imagen) }}" alt="{{ $item->nombre_estilo }}" class="w-full h-48 object-cover rounded mb-4">
            <h3 class="text-lg font-semibold text-orange-600">{{ $item->nombre_estilo }}</h3>
            <p class="text-sm text-gray-600">{{ $item->servicio }}</p>
            <p class="text-sm mt-2">{{ $item->descripcion }}</p>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</body>
</html>
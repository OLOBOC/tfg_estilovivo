<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Publicaciones guardadas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-100 font-sans">

{{-- Header según el rol --}}
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

<div class="max-w-6xl mx-auto px-4 py-10">
  <h2 class="text-3xl font-bold text-orange-600 mb-6 text-center">Tus publicaciones guardadas</h2>

  @if($galeria->isEmpty())
    <p class="text-center text-gray-600">No has guardado ninguna publicación todavía.</p>
  @else
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
      @foreach($galeria as $item)
        <div class="relative bg-white rounded-xl shadow-md overflow-hidden">
          <img src="{{ asset($item->imagen) }}" alt="{{ $item->nombre_estilo }}" class="w-full h-48 object-cover rounded-t">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-orange-600">{{ $item->nombre_estilo }}</h3>
            <p class="text-sm text-gray-600">{{ $item->servicio }}</p>
            <p class="text-sm text-gray-700 mt-2">{{ $item->descripcion }}</p>

            {{-- Botón para quitar de guardadas --}}
            <form action="{{ route('galeria.guardar', $item->id) }}" method="POST" class="mt-3 text-right">
              @csrf
              <button type="submit" class="text-red-600 text-xs font-medium hover:underline">
                Quitar de guardadas
              </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>

</body>
</html>

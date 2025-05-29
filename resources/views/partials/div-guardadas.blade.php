<div class="bg-white rounded-3xl shadow-lg w-full max-w-6xl h-[800px] overflow-y-scroll scrollbar-thin scrollbar-thumb-orange-300 scrollbar-track-orange-100 px-6 py-4">


      {{-- Navegación entre pestañas --}}
      @include('partials.pestañas-galeria')


      {{-- Filtro de servicios --}}
      @include('partials.filtro-servicio', ['onchange' => 'filtrarGuardadas()'])





      @if($galeria->isEmpty())
      <p class="text-center text-gray-600">No has guardado ninguna publicacion todavia.</p>
      @else
      <div id="grid-guardadas" class="grid grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($galeria as $item)
        <div class="relative bg-white rounded-xl shadow-md overflow-hidden cursor-pointer servicio-item"
          data-servicio="{{ $item->servicio }}"
          onclick="abrirModal('{{ asset($item->imagen) }}', '{{ $item->nombre_estilo }}', '{{ $item->servicio }}', '{{ $item->descripcion }}', {{ $item->id }})">
          <img src="{{ asset($item->imagen) }}" alt="{{ $item->nombre_estilo }}" class="w-full h-48 object-cover rounded-t">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-orange-600">{{ $item->nombre_estilo }}</h3>
            <p class="text-sm text-gray-600">{{ $item->servicio }}</p>
            <p class="text-sm text-gray-700 mt-2">{{ $item->descripcion }}</p>

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
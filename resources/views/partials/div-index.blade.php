<div class="bg-white rounded-3xl shadow-lg w-full max-w-6xl h-[800px] overflow-y-scroll scrollbar-thin scrollbar-thumb-orange-300 scrollbar-track-orange-100 px-6 py-4">



    {{-- Navegación entre pestañas --}}
    @include('partials.pestañas-galeria')


    {{-- Filtro de servicios --}}
    @include('partials.filtro-servicio', ['onchange' => 'filtrarPorServicio()'])


    {{-- Cargando contenido --}}
    <div id="spinner" class="flex justify-center items-center h-64">
        <div class="spinner border-4 border-gray-300 border-t-orange-500 rounded-full w-12 h-12 animate-spin"></div>
    </div>

    {{-- Galería principal --}}
    <div id="galeria" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-6 hidden">
        @foreach($galeria as $item)
        <div class="relative group overflow-hidden rounded-lg shadow-md cursor-pointer servicio-item"
            data-servicio="{{ $item->servicio }}"
            onclick="openModal('{{ asset($item->imagen) }}', '{{ $item->nombre_estilo }}', '{{ $item->servicio }}', '{{ $item->descripcion }}', {{ $item->id }})">
            <img src="{{ asset($item->imagen) }}" alt="{{ $item->nombre_estilo }}" class="w-full h-[250px] object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute bottom-0 bg-black bg-opacity-70 text-white text-xs p-2 w-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <p class="font-semibold">{{ $item->servicio }}: {{ $item->nombre_estilo }}</p>
                <p>{{ $item->descripcion }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
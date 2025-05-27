<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galería Estilo Vivo</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

<div class="flex justify-center py-10">
  <div class="bg-white rounded-3xl shadow-lg w-full max-w-6xl h-[800px] overflow-y-scroll scrollbar-thin scrollbar-thumb-orange-300 scrollbar-track-orange-100 px-6 py-4">
    
    <h2 class="text-3xl font-bold text-center text-orange-600 mb-4">Explora Estilo Vivo</h2>

    {{-- Pestañas de navegación --}}
    <div class="flex justify-center mt-2 space-x-8 text-sm font-medium text-gray-600">
      <button onclick="mostrarPublicaciones()" id="btn-publicaciones" class="border-b-2 border-orange-600 text-orange-600 px-2 pb-1">PUBLICACIONES</button>
      <button onclick="window.location.href='{{ route('galeria.guardadas') }}'" id="btn-guardadas" class="hover:text-orange-600">GUARDADAS</button>
    </div>

    {{-- Filtro de servicio --}}
    <div class="mt-4 text-center">
      <label for="servicioFiltro" class="text-sm font-medium text-gray-700 mr-2">Filtrar por servicio:</label>
      <select id="servicioFiltro" onchange="filtrarPorServicio()" class="py-1 px-3 border border-gray-300 rounded-lg">
        <option value="todos">Todos</option>
        <option value="Corte">Corte</option>
        <option value="Peinado">Peinado</option>
        <option value="Tinte">Tinte</option>
      </select>
    </div>

    {{-- Spinner mientras carga --}}
    <div id="spinner" class="flex justify-center items-center h-64">
      <div class="spinner border-4 border-gray-300 border-t-orange-500 rounded-full w-12 h-12 animate-spin"></div>
    </div>

    {{-- Galería de publicaciones --}}
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
</div>

{{-- Modal para ver/editar/eliminar/guardar publicación --}}
<div id="modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden" onclick="closeModalOutside(event)">
  <div id="modal-content" class="relative bg-white rounded-lg p-4 shadow-2xl max-w-md w-full">
    <button onclick="closeModal()" class="absolute top-2 right-2 bg-gray-200 rounded-full p-1 hover:bg-gray-300">
      <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    <img id="modal-img" src="" class="w-full rounded-md mb-4">
    <h3 id="modal-title" class="text-xl font-semibold text-orange-600 mb-1"></h3>
    <p id="modal-service" class="text-sm text-gray-500 mb-1"></p>
    <p id="modal-description" class="text-sm text-gray-700"></p>

    {{-- Botón para clientes: guardar publicación --}}
    @auth
      @if (Auth::user()->rol === 'cliente')
        <form method="POST" action="{{ route('galeria.guardar', '__ID__') }}" id="guardarForm" class="mt-4 text-center">
          @csrf
          <button type="submit"
                  class="text-orange-600 text-sm font-semibold hover:underline">
            Guardar publicación
          </button>
        </form>
      @endif

      {{-- Botones para admin o peluquero --}}
      @if (Auth::user()->rol === 'admin' || Auth::user()->rol === 'peluquero')
        <div class="mt-6 text-center space-y-2">
          <a id="editLink" href="#" class="text-blue-600 text-sm font-semibold hover:underline">Editar publicación</a>
          <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta imagen?')"
                    class="text-red-600 text-sm font-semibold hover:underline">
              Eliminar publicación
            </button>
          </form>
        </div>
      @endif
    @endauth
  </div>
</div>

{{-- Scripts --}}
<script>
  // Mostrar la galería cuando la página termine de cargar
  window.addEventListener('load', () => {
    document.getElementById('spinner').classList.add('hidden');
    document.getElementById('galeria').classList.remove('hidden');
    console.log("Galería mostrada");
  });

  // Mostrar solo la galería (PUBLICACIONES)
  function mostrarPublicaciones() {
    document.getElementById('galeria').classList.remove('hidden');
    console.log("Clic en pestaña PUBLICACIONES");
  }

  // Abrir modal con datos de la publicación
  function openModal(src, nombre, servicio, descripcion, id) {
    document.getElementById('modal-img').src = src;
    document.getElementById('modal-title').textContent = nombre;
    document.getElementById('modal-service').textContent = servicio;
    document.getElementById('modal-description').textContent = descripcion;

    const deleteForm = document.getElementById('deleteForm');
    if (deleteForm) {
      deleteForm.action = `/galeria/${id}`;
      console.log("Formulario delete configurado para ID:", id);
    }

    const editLink = document.getElementById('editLink');
    if (editLink) {
      editLink.href = `/galeria/${id}/edit`;
      console.log("Enlace de edición configurado para ID:", id);
    }

    const guardarForm = document.getElementById('guardarForm');
    if (guardarForm) {
      guardarForm.action = `/galeria/${id}/guardar`;
      console.log("Formulario de guardar configurado para ID:", id);
    }

    document.getElementById('modal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    console.log("Modal cerrado");
  }

  function closeModalOutside(event) {
    const modalContent = document.getElementById('modal-content');
    if (!modalContent.contains(event.target)) {
      closeModal();
    }
  }

  // Filtro por tipo de servicio
  function filtrarPorServicio() {
    const filtro = document.getElementById('servicioFiltro').value;
    const items = document.querySelectorAll('.servicio-item');

    items.forEach(item => {
      const tipo = item.getAttribute('data-servicio');
      const visible = (filtro === 'todos' || tipo === filtro);
      item.classList.toggle('hidden', !visible);
    });

    console.log("Filtro aplicado:", filtro);
  }
</script>


</body>
</html>

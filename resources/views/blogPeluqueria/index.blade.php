<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galería Estilo Vivo</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-orange-100 font-sans">

  {{-- Header dinámico según rol --}}
  @auth
    @php $rol = Auth::user()->rol; @endphp
    @include('partials.header.' . ($rol === 'admin' ? 'admin' : ($rol === 'peluquero' ? 'peluquero' : 'auth')))
  @else
    @include('partials.header.guest')
  @endauth

  <div class="flex justify-center py-10">
    <div class="bg-white rounded-3xl shadow-lg w-full max-w-6xl h-[800px] overflow-y-scroll scrollbar-thin scrollbar-thumb-orange-300 scrollbar-track-orange-100 px-6 py-4">

      <h2 class="text-3xl font-bold text-center text-orange-600 mb-4">Explora Estilo Vivo</h2>

      {{-- Navegación entre pestañas --}}
      <div class="flex justify-center mt-2 space-x-8 text-sm font-medium text-gray-600">
        <button onclick="mostrarPublicaciones()" id="btn-publicaciones" class="border-b-2 border-orange-600 text-orange-600 px-2 pb-1">PUBLICACIONES</button>
        <button onclick="window.location.href='{{ route('galeria.guardadas') }}'" id="btn-guardadas" class="hover:text-orange-600">GUARDADAS</button>
      </div>

      {{-- Filtro de servicios --}}
      <div class="mt-4 text-center">
        <label for="servicioFiltro" class="text-sm font-medium text-gray-700 mr-2">Filtrar por servicio:</label>
        <select id="servicioFiltro" onchange="filtrarPorServicio()" class="py-1 px-3 border border-gray-300 rounded-lg">
          <option value="todos">Todos</option>
          <option value="Corte">Corte</option>
          <option value="Peinado">Peinado</option>
          <option value="Tinte">Tinte</option>
        </select>
      </div>

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
  </div>

  {{-- Modal con detalles y botón guardar --}}
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden" onclick="closeModalOutside(event)">
    <div id="modal-content" class="relative bg-white rounded-lg p-4 shadow-2xl max-w-md w-full">
      <button onclick="closeModal()" class="absolute top-2 right-2 bg-gray-200 rounded-full p-1 hover:bg-gray-300">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <img id="modal-img" src="" class="max-w-full max-h-[70vh] mx-auto object-contain rounded-md mb-4">
      <h3 id="modal-title" class="text-xl font-semibold text-orange-600 mb-1"></h3>
      <p id="modal-service" class="text-sm text-gray-500 mb-1"></p>
      <p id="modal-description" class="text-sm text-gray-700"></p>

      {{-- Botón de corazón solo para clientes --}}
      @auth
        @if (Auth::user()->rol === 'cliente')
          <script>
            window.publicacionesGuardadas = {!! json_encode(Auth::user()->guardadas->pluck('id')) !!};
          </script>
          <div class="flex justify-center mt-4">
            <button id="btn-corazon" data-id="" onclick="toggleHeart(this)" class="p-2 rounded-full" title="Guardar publicación">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-300 transition-colors duration-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.014-4.5-4.5-4.5-1.657 0-3.09.896-3.878 2.223A4.494 
                  4.494 0 0 0 6.75 3.75 4.5 4.5 0 0 0 3 8.25c0 7.043 9 12 
                  9 12s9-4.957 9-12z"/>
              </svg>
            </button>
          </div>
        @endif

        {{-- Para admin o peluquero --}}
        @if (Auth::user()->rol === 'admin' || Auth::user()->rol === 'peluquero')
          <div class="mt-6 text-center space-y-2">
            <a id="editLink" href="#" class="text-blue-600 text-sm font-semibold hover:underline">Editar publicación</a>
            <form id="deleteForm" method="POST" action="">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta imagen?')" class="text-red-600 text-sm font-semibold hover:underline">
                Eliminar publicación
              </button>
            </form>
          </div>
        @endif
      @endauth
    </div>
  </div>

  {{-- Toast para mostrar mensajes --}}
  <div id="toast" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-orange-600 text-white text-sm px-4 py-2 rounded-xl shadow-lg opacity-0 transition-opacity duration-300 z-50">
    <span id="toast-text"></span>
  </div>

  {{-- Script para mostrar la galería al cargar --}}
  <script>
    window.addEventListener('load', () => {
      const spinner = document.getElementById('spinner');
      const galeria = document.getElementById('galeria');
      if (spinner && galeria) {
        spinner.classList.add('hidden');
        galeria.classList.remove('hidden');
        console.log("galeria mostrada");
      }
    });

    function mostrarPublicaciones() {
      document.getElementById('galeria').classList.remove('hidden');
    }

    function openModal(src, nombre, servicio, descripcion, id) {
      document.getElementById('modal-img').src = src;
      document.getElementById('modal-title').textContent = nombre;
      document.getElementById('modal-service').textContent = servicio;
      document.getElementById('modal-description').textContent = descripcion;

      const btnCorazon = document.getElementById('btn-corazon');
      if (btnCorazon) {
        btnCorazon.setAttribute('data-id', id);
        const svg = btnCorazon.querySelector('svg');
        const guardadas = window.publicacionesGuardadas || [];
        if (guardadas.includes(id)) {
          svg.classList.remove('text-gray-300');
          svg.classList.add('text-red-500');
        } else {
          svg.classList.remove('text-red-500');
          svg.classList.add('text-gray-300');
        }
      }

      const deleteForm = document.getElementById('deleteForm');
      if (deleteForm) deleteForm.action = `/galeria/${id}`;

      const editLink = document.getElementById('editLink');
      if (editLink) editLink.href = `/galeria/${id}/edit`;

      document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }

    function closeModalOutside(event) {
      const modalContent = document.getElementById('modal-content');
      if (!modalContent.contains(event.target)) closeModal();
    }

    function filtrarPorServicio() {
      const filtro = document.getElementById('servicioFiltro').value;
      const items = document.querySelectorAll('.servicio-item');
      items.forEach(item => {
        const tipo = item.getAttribute('data-servicio');
        item.classList.toggle('hidden', !(filtro === 'todos' || tipo === filtro));
      });
    }
  </script>

</body>
</html>
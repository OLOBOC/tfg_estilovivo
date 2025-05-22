<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galería Estilo Vivo</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-100 font-sans">

  <div class="flex justify-center py-10">
    <div class="bg-white rounded-3xl shadow-lg w-full max-w-6xl h-[800px] overflow-y-scroll scrollbar-thin scrollbar-thumb-orange-300 scrollbar-track-orange-100 px-6 py-4">
      
      <div class="sticky top-0 bg-white z-10 pb-4 border-b border-gray-200">
        <h2 class="text-3xl font-bold text-center text-orange-600">Explora Estilo Vivo</h2>
        <div class="flex justify-center mt-2 space-x-8 text-sm font-medium text-gray-600">
          <button class="border-b-2 border-orange-600 text-orange-600 px-2 pb-1">PUBLICACIONES</button>
          <button class="hover:text-orange-600">VIDEOS</button>
          <button class="hover:text-orange-600">GUARDADAS</button>
          <button class="hover:text-orange-600">ETIQUETADAS</button>
        </div>
        
        <!-- Filtro de servicio -->
        <div class="mt-4 text-center">
          <label for="servicioFiltro" class="text-sm font-medium text-gray-700 mr-2">Filtrar por servicio:</label>
          <select id="servicioFiltro" onchange="filtrarPorServicio()" class="py-1 px-3 border border-gray-300 rounded-lg">
            <option value="todos">Todos</option>
            <option value="Corte">Corte</option>
            <option value="Peinado">Peinado</option>
            <option value="Tinte">Tinte</option>
          </select>
@auth
  @if(Auth::user()->role === 'admin' || Auth::user()->role === 'peluquero')
    <div class="text-center mt-4">
      <a href="{{ route('galeria.create') }}"
         class="inline-block bg-orange-500 text-white px-5 py-2 rounded-lg hover:bg-orange-600 transition">
        + Subir nuevo estilo
      </a>
    </div>
  @endif
@endauth

        </div>
      </div>

      <!-- Galería dinámica estilo Instagram -->
      <div id="galeria" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-6">
        @foreach($galeria as $item)
          <div class="relative group overflow-hidden rounded-lg shadow-md cursor-pointer servicio-item"
               data-servicio="{{ $item->servicio }}"
               onclick="openModal('{{ asset($item->imagen) }}', '{{ $item->nombre_estilo }}', '{{ $item->servicio }}', '{{ $item->descripcion }}')">
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

  <!-- Modal para ampliar imagen con información -->
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
    </div>
  </div>

  <!-- JS Modal + Filtro -->
  <script>
    function openModal(src, nombre, servicio, descripcion) {
      document.getElementById('modal-img').src = src;
      document.getElementById('modal-title').textContent = nombre;
      document.getElementById('modal-service').textContent = servicio;
      document.getElementById('modal-description').textContent = descripcion;
      document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }

    function closeModalOutside(event) {
      const modalContent = document.getElementById('modal-content');
      if (!modalContent.contains(event.target)) {
        closeModal();
      }
    }

    function filtrarPorServicio() {
      const filtro = document.getElementById('servicioFiltro').value;
      const items = document.querySelectorAll('.servicio-item');

      items.forEach(item => {
        const tipo = item.getAttribute('data-servicio');
        if (filtro === 'todos' || tipo === filtro) {
          item.classList.remove('hidden');
        } else {
          item.classList.add('hidden');
        }
      });
    }
  </script>

</body>
</html>

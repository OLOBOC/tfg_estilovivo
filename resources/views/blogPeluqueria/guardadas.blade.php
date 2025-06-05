<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>publicaciones guardadas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-100 font-sans">

  {{-- header dinamico --}}
  @auth
  @php $rol = Auth::user()->rol; @endphp
  @include('partials.header.' . ($rol === 'admin' ? 'admin' : ($rol === 'peluquero' ? 'peluquero' : 'auth')))
  @else
  @include('partials.header.guest')
  @endauth

  {{-- contenedor blanco con sombra como index --}}
  <div class="flex justify-center py-10">

    @include('partials.div-guardadas')

  </div>

  {{-- modal con imagen grande y boton quitar --}}
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden" onclick="cerrarModalFuera(event)">
    <div id="modal-contenido" class="relative bg-white p-4 rounded-lg shadow-xl w-[90%] sm:max-w-md">
      <button onclick="cerrarModal()" class="absolute top-2 right-2 bg-gray-200 p-1 rounded-full hover:bg-gray-300">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <img id="modal-img" src="" class="max-w-full max-h-[70vh] mx-auto object-contain rounded-md mb-4">
      <h3 id="modal-titulo" class="text-xl font-semibold text-orange-600 mb-1"></h3>
      <p id="modal-servicio" class="text-sm text-gray-500 mb-1"></p>
      <p id="modal-desc" class="text-sm text-gray-700"></p>
      <form id="form-quitar-modal" method="POST" action="">
        @csrf
        <button type="submit" class="block w-full text-center text-red-600 text-sm font-medium hover:underline mt-4">
          quitar de guardadas
        </button>
      </form>
    </div>
  </div>
  <!-- Footer -->
  @include('partials.footer.footer')

  {{-- script de filtro y modal --}}
  <script>
    function filtrarGuardadas() {
      const filtro = document.getElementById('servicioFiltro').value
      const items = document.querySelectorAll('.servicio-item')

      items.forEach(item => {
        const tipo = item.getAttribute('data-servicio')
        const mostrar = (filtro === 'todos' || tipo === filtro)
        item.classList.toggle('hidden', !mostrar)
      })

      console.log("filtro aplicado:", filtro)
    }

    function abrirModal(src, titulo, servicio, descripcion, id) {
      document.getElementById('modal-img').src = src
      document.getElementById('modal-titulo').textContent = titulo
      document.getElementById('modal-servicio').textContent = servicio
      document.getElementById('modal-desc').textContent = descripcion
      document.getElementById('form-quitar-modal').action = `/galeria/${id}/guardar`
      document.getElementById('modal').classList.remove('hidden')
    }

    function cerrarModal() {
      document.getElementById('modal').classList.add('hidden')
    }

    function cerrarModalFuera(event) {
      const contenido = document.getElementById('modal-contenido')
      if (!contenido.contains(event.target)) cerrarModal()
    }
  </script>

</body>

</html>
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
    @include('partials.div-index')

  </div>

  {{-- Modal con detalles y botón guardar --}}
  @include('partials.modal-publicacion')


  {{-- Toast para mostrar mensajes --}}
  <div id="toast" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-orange-600 text-white text-sm px-4 py-2 rounded-xl shadow-lg opacity-0 transition-opacity duration-300 z-50">
    <span id="toast-text"></span>
  </div>
  <!-- Footer -->
  @include('partials.footer.footer')

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
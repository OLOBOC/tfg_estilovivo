{{-- partials/modal-publicacion.blade.php --}}
<div id="modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden" onclick="closeModalOutside(event)">
    <div id="modal-content" class="relative bg-white rounded-lg p-4 shadow-2xl max-w-md w-full">
      <button onclick="closeModal()" class="absolute top-2 right-2 bg-gray-200 rounded-full p-1 hover:bg-gray-300">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <img id="modal-img"
     src="{{ asset('img/portada.png') }}"
     alt="Vista ampliada del servicio"
     class="max-w-full max-h-[70vh] mx-auto object-contain rounded-md mb-4">


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
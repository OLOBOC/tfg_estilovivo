<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Publicar nuevo estilo</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-100 font-sans">

  {{-- Header según rol --}}
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

  <main class="flex justify-center items-start min-h-screen py-10 px-4">
    @auth
    @if ($rol === 'peluquero')
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-xl text-center">

      {{-- Interfaz inicial tipo Instagram --}}
      <div id="promptUpload" class="cursor-pointer border-2 border-dashed border-orange-400 rounded-xl p-8 hover:bg-orange-50 transition"
        onclick="document.getElementById('imagenInput').click(); console.log('Seleccionando imagen...')">
        <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" alt="Subir" class="w-24 h-24 mx-auto mb-4 opacity-70">
        <p class="text-lg text-gray-600">¿Quieres subir una imagen?</p>
      </div>

      {{-- Mensajes de éxito --}}
      @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-6">
        {{ session('success') }}
        <script>
          console.log("Imagen subida correctamente");
        </script>
      </div>
      @endif

      {{-- Errores --}}
      @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-6 text-left">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        <script>
          console.log("Error de validación al subir estilo");
        </script>
      </div>
      @endif

      {{-- Formulario oculto --}}
      <form id="uploadForm" action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-4 mt-6 hidden text-left"
        onsubmit="console.log('Enviando imagen...')">
        @csrf

        {{-- Input real de imagen --}}
        <input type="file" name="imagen" id="imagenInput" accept="image/*" class="hidden" required onchange="vistaPrevia(event)">

        {{-- Vista previa --}}
        <div id="previewContainer" class="hidden">
          <p class="text-sm text-gray-600 mb-1">Vista previa:</p>
          <img id="previewImg" src="#" alt="Vista previa" class="w-full h-64 object-cover rounded-lg border border-gray-300 shadow mb-4">
        </div>

        {{-- Campos adicionales --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
          <select name="servicio" required
            class="block w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm">
            <option value="">Selecciona un servicio</option>
            <option value="Corte">Corte</option>
            <option value="Peinado">Peinado</option>
            <option value="Tinte">Tinte</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del estilo</label>
          <input type="text" name="nombre_estilo" required
            class="block w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
          <textarea name="descripcion" rows="3" required
            class="block w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm"></textarea>
        </div>

        <div class="text-center pt-4">
          <button type="submit"
            class="bg-orange-500 text-white px-6 py-2 rounded-full font-semibold hover:bg-orange-600 transition">
            Publicar estilo
          </button>
        </div>
      </form>
    </div>
    @else
    <div class="text-center text-gray-600 text-lg">
      Solo los peluqueros pueden subir contenido a la galería.
      <script>
        console.log("Acceso denegado: no eres peluquero");
      </script>
    </div>
    @endif
    @endauth
  </main>
  

  <script>
    function vistaPrevia(event) {
      const fileInput = event.target;
      const previewImg = document.getElementById('previewImg');
      const previewContainer = document.getElementById('previewContainer');
      const uploadForm = document.getElementById('uploadForm');
      const promptUpload = document.getElementById('promptUpload');

      if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewContainer.classList.remove('hidden');
          uploadForm.classList.remove('hidden');
          promptUpload.classList.add('hidden');
          console.log("Vista previa generada y formulario desplegado");
        };
        reader.readAsDataURL(fileInput.files[0]);
      } else {
        console.log("No se seleccionó imagen");
      }
    }
  </script>
</body>

</html>
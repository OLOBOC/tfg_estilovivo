<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Subir Imagen a Galería</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-100 font-sans py-10">

  <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-center text-orange-600 mb-6">Subir nuevo estilo</h2>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Imagen</label>
        <input type="file" name="imagen" accept="image/*" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Servicio</label>
        <select name="servicio" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
          <option value="">Selecciona un servicio</option>
          <option value="Corte">Corte</option>
          <option value="Peinado">Peinado</option>
          <option value="Tinte">Tinte</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Nombre del Estilo</label>
        <input type="text" name="nombre_estilo" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea name="descripcion" rows="3" required
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition">
          Subir imagen
        </button>
      </div>
    </form>
  </div>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Peluquero</title>
    {{-- carga estilos de tailwind desde vite --}}
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1"> {{-- hace que sea responsive --}}
</head>
<body class="bg-orange-50 min-h-screen font-sans text-gray-800">

    {{-- header del panel admin --}}
    @include('partials.header.admin')

    {{-- contenedor principal del formulario --}}
    <div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8 bg-white p-6 sm:p-8 rounded shadow">
        <h2 class="text-xl sm:text-2xl font-bold text-orange-600 mb-6">Registrar nuevo peluquero</h2>

        {{-- mostrar mensaje de exito si existe --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
                <script>console.log("✅ peluquero registrado correctamente");</script>
            </div>
        @endif

        {{-- mostrar errores de validacion si los hay --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <script>console.log("❌ errores en el formulario de peluquero");</script>
            </div>
        @endif

        {{-- formulario de registro --}}
        <form action="{{ route('admin.peluquero.store') }}" method="POST" class="space-y-6"
              onsubmit="console.log('📤 enviando formulario de registro de peluquero...')">
            @csrf

            {{-- campo: nombre --}}
            <div>
                <label class="block font-semibold mb-1">nombre</label>
                <input type="text" name="name" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-sm"
                       placeholder="ej: juan martinez" />
            </div>

            {{-- campo: email --}}
            <div>
                <label class="block font-semibold mb-1">email</label>
                <input type="email" name="email" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-sm"
                       placeholder="ejemplo@correo.com" />
            </div>

            {{-- campo: contraseña --}}
            <div>
                <label class="block font-semibold mb-1">contraseña</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-sm"
                       placeholder="minimo 6 caracteres" />
            </div>

            {{-- boton de enviar --}}
            <div class="text-right">
                <button type="submit"
                        class="w-full sm:w-auto bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 transition">
                    registrar
                </button>
            </div>
        </form>
    </div>

</body>
</html>

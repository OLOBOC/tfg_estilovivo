<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Peluquero</title>
    {{-- Carga estilos de Tailwind desde Vite --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-orange-50 min-h-screen font-sans text-gray-800">

    {{-- Header del panel admin --}}
    @include('partials.header.admin')

    {{-- Contenedor principal del formulario --}}
    <div class="max-w-3xl mx-auto mt-12 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold text-orange-600 mb-6">Registrar nuevo peluquero</h2>

        {{-- Mostrar mensaje de éxito si existe --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
                <script>console.log("✅ Peluquero registrado correctamente");</script>
            </div>
        @endif

        {{-- Mostrar errores de validación si los hay --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <script>console.log("❌ Errores en el formulario de peluquero");</script>
            </div>
        @endif

        {{-- Formulario de registro --}}
        <form action="{{ route('admin.peluquero.store') }}" method="POST" class="space-y-6"
              onsubmit="console.log('📤 Enviando formulario de registro de peluquero...')">
            @csrf

            {{-- Campo: Nombre --}}
            <div>
                <label class="block font-semibold mb-1">Nombre</label>
                <input type="text" name="name" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-sm"
                       placeholder="Ej: Juan Martínez" />
            </div>

            {{-- Campo: Email --}}
            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-sm"
                       placeholder="ejemplo@correo.com" />
            </div>

            {{-- Campo: Contraseña --}}
            <div>
                <label class="block font-semibold mb-1">Contraseña</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-sm"
                       placeholder="Mínimo 6 caracteres" />
            </div>

            {{-- Botón de enviar --}}
            <div class="text-right">
                <button type="submit"
                        class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 transition">
                    Registrar
                </button>
            </div>
        </form>
    </div>

</body>
</html>

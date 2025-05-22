<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña - Estilo Vivo</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-orange-200 to-white text-gray-800 font-sans overflow-hidden h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
        <!-- Encabezado -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Estilo Vivo</h1>
            <p class="text-sm text-gray-500">¿Olvidaste tu contraseña?</p>
        </div>

        <!-- Descripción -->
        <p class="text-sm text-gray-600 mb-4">
            No hay problema. Solo ingresa tu dirección de correo y te enviaremos un enlace para que puedas establecer una nueva contraseña.
        </p>

        <!-- Mensaje de estado -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-orange-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-orange-700 transition">
                    Enviar enlace
                </button>
            </div>
        </form>
    </div>

</body>
</html>

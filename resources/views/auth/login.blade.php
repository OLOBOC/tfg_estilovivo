<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Estilo Vivo</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-orange-200 to-white text-gray-800 font-sans overflow-hidden h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
        <!-- Nombre de la peluquería -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-orange-600">Estilo Vivo</h1>
            <p class="text-sm text-gray-500">Tu estilo, nuestra pasión</p>
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar sesión</h2>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" name="email" type="email" required autofocus
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recordarme -->
            <div class="flex items-center mb-4">
                <input id="remember_me" name="remember" type="checkbox"
                    class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Recordarme</label>
            </div>

            <!-- Acciones -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-orange-600 hover:underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button type="submit"
                    class="bg-orange-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-orange-700 transition">
                    Iniciar sesión
                </button>
            </div>
        </form>

        <!-- Enlace a registro -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-orange-600 hover:underline font-medium">Regístrate aquí</a>
            </p>
        </div>
    </div>

</body>
</html>

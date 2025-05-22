<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Contraseña - Estilo Vivo</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-orange-200 to-white text-gray-800 font-sans overflow-hidden h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
        <!-- Encabezado -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Estilo Vivo</h1>
            <p class="text-sm text-gray-500">Área segura - Confirmar contraseña</p>
        </div>

        <!-- Mensaje de confirmación de contraseña -->
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
        </div>

        <!-- Formulario de confirmación de contraseña -->
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Botón de confirmación -->
            <div class="flex justify-end mt-4">
                <x-primary-button>
                    {{ __('Confirmar') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</body>
</html>

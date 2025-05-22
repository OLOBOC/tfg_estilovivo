<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Correo - Estilo Vivo</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-orange-200 to-white text-gray-800 font-sans overflow-hidden h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
        <!-- Encabezado -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Estilo Vivo</h1>
            <p class="text-sm text-gray-500">Verifica tu correo electrónico</p>
        </div>

        <!-- Mensaje de verificación -->
        <div class="mb-4 text-sm text-gray-600">
            {{ __('¡Gracias por registrarte! Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te enviamos. Si no has recibido el correo, podemos enviártelo nuevamente.') }}
        </div>

        <!-- Estado de verificación -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
            </div>
        @endif

        <!-- Formulario para reenvío del correo de verificación -->
        <div class="mt-4 flex flex-col items-center justify-center space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-orange-700 transition">
                        {{ __('Reenviar correo de verificación') }}
                    </button>
                </div>
            </form>

            <!-- Formulario para cerrar sesión -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div>
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Cerrar sesión') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

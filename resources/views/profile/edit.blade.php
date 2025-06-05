<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perfil - estilo vivo</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-orange-100 to-white text-gray-800 font-sans">

    <!-- Header según el rol del usuario -->
    @auth
        @php
            $rol = Auth::user()->rol;
        @endphp

        @if ($rol === 'admin')
            @include('partials.header.admin')
        @elseif ($rol === 'peluquero')
            @include('partials.header.peluquero')
        @else
            @include('partials.header.auth')
        @endif
    @endauth

    <main class="py-12 px-4 max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-orange-600">Area personal</h1>
            <p class="text-gray-600 mt-2 text-lg">consulta o modifica tu informacion de perfil y seguridad</p>
        </div>

        <!-- Información de usuario -->
        <div class="space-y-8">
            <section class="bg-white p-6 rounded-lg shadow">
                @include('profile.partials.update-profile-information-form')
            </section>

            <section class="bg-white p-6 rounded-lg shadow">
                @include('profile.partials.update-password-form')
            </section>

            <section class="bg-white p-6 rounded-lg shadow">
                @include('profile.partials.delete-user-form')
            </section>
        </div>
    </main>

</body>
</html>

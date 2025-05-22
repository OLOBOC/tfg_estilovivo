<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Estilo Vivo</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-orange-100 to-white text-gray-800 font-sans">

    @include('partials.header.auth') <!-- Header para usuarios autenticados -->

    <main class="py-12 px-4 max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-orange-600">Área personal</h1>
            <p class="text-gray-600 mt-2 text-lg">Consulta o modifica tu información de perfil y seguridad.</p>
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

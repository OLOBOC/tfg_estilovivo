<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f8f6f2">
    <title>@yield('title') | Estilo Vivo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-[#f8f6f2] font-sans text-[#292722] antialiased">
    <header class="border-b border-black/5 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 sm:px-8">
            <a href="{{ route('home') }}" class="font-serif text-xl font-semibold">Estilo Vivo</a>
            <a href="{{ route('home') }}" class="text-sm text-[#6d685f] underline underline-offset-4 hover:text-[#a96242]">Volver al inicio</a>
        </div>
    </header>
    <main class="mx-auto w-full max-w-4xl flex-1 px-6 py-12 sm:px-8 sm:py-16">
        <p class="text-xs font-semibold uppercase tracking-[.22em] text-[#a96242]">Información del sitio</p>
        <h1 class="mt-3 font-serif text-4xl font-medium sm:text-5xl">@yield('heading')</h1>
        <div class="legal-copy mt-8 space-y-7 rounded-2xl bg-white p-6 shadow-sm sm:p-10">
            @yield('content')
        </div>
    </main>
    @include('partials.footer.footer')
</body>
</html>

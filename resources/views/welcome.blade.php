<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cortes, color y cuidado personal en Estilo Vivo, en Gijón. Conoce al equipo y reserva tu próxima cita.">
    <meta name="theme-color" content="#f8f6f2">
    <title>Estilo Vivo | Peluquería en Gijón</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8f6f2] font-sans text-[#292722] antialiased">
    <a href="#contenido" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-5 focus:py-3 focus:shadow-lg">
        Saltar al contenido
    </a>

    @include('partials.header.guest')

    <main id="contenido">
        <section id="inicio" class="relative isolate flex min-h-[76vh] items-center overflow-hidden bg-[#28251f] px-6 py-24 text-white sm:min-h-[82vh] sm:px-10">
            <div class="absolute inset-0 -z-10 bg-cover bg-center" style="background-image: linear-gradient(90deg, rgba(25, 24, 21, .82), rgba(25, 24, 21, .3)), url('{{ asset('img/portada.png') }}');"></div>
            <div class="mx-auto w-full max-w-7xl">
                <p class="mb-6 text-xs font-semibold uppercase tracking-[.3em] text-[#e5c6a7]">Peluquería · Gijón</p>
                <h1 class="max-w-3xl font-serif text-5xl font-medium leading-[1.08] sm:text-6xl lg:text-7xl">Un estilo que se siente como tú.</h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-white/80 sm:text-lg">
                    Cortes, color y cuidado personal con tiempo para escucharte y encontrar tu próximo look.
                </p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('login') }}" class="inline-flex min-h-12 items-center justify-center rounded-full bg-[#a96242] px-7 text-sm font-semibold text-white transition hover:bg-[#914e33] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#292722]">
                        Reserva tu cita
                    </a>
                    <a href="#servicios" class="inline-flex min-h-12 items-center justify-center rounded-full border border-white/60 px-7 text-sm font-semibold text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white">
                        Descubre Estilo Vivo
                    </a>
                </div>
            </div>
            <p class="absolute bottom-6 right-8 hidden text-xs uppercase tracking-[.22em] text-white/70 sm:block">Tu momento, tu estilo</p>
        </section>

        @include('partials.Inicio.quienes-somos')
        @include('partials.Inicio.servicios')
        @include('partials.Inicio.mapa.ubicacion')
    </main>

    @include('partials.footer.footer')
</body>
</html>

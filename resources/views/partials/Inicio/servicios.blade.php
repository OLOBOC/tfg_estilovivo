<section id="servicios" class="px-6 py-20 sm:py-28">
    <div class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2 lg:gap-20">
        <div class="overflow-hidden rounded-3xl bg-[#e9e1d6]">
            <img src="{{ asset('img/portada.png') }}" alt="Personas con distintos cortes y estilos" loading="lazy" class="h-full max-h-[34rem] min-h-[20rem] w-full object-cover">
        </div>

        <div>
            <p class="text-xs font-semibold uppercase tracking-[.25em] text-[#a96242]">La experiencia Estilo Vivo</p>
            <h2 class="mt-4 font-serif text-4xl font-medium leading-tight text-[#292722] sm:text-5xl">Un cuidado pensado para ti.</h2>
            <p class="mt-6 max-w-xl leading-7 text-[#6d685f]">
                Cortes, coloración y peinados para encontrar el estilo que te representa. Cuéntanos qué tienes en mente y diseñaremos contigo el resultado.
            </p>

            <ul class="mt-8 grid gap-x-8 gap-y-4 text-sm text-[#514c44] sm:grid-cols-2">
                <li class="flex items-center gap-3"><span class="h-1.5 w-1.5 rounded-full bg-[#a96242]"></span>Corte, lavado y peinado</li>
                <li class="flex items-center gap-3"><span class="h-1.5 w-1.5 rounded-full bg-[#a96242]"></span>Tinte, mechas y balayage</li>
                <li class="flex items-center gap-3"><span class="h-1.5 w-1.5 rounded-full bg-[#a96242]"></span>Tratamientos capilares</li>
                <li class="flex items-center gap-3"><span class="h-1.5 w-1.5 rounded-full bg-[#a96242]"></span>Recogidos y peinados</li>
                <li class="flex items-center gap-3"><span class="h-1.5 w-1.5 rounded-full bg-[#a96242]"></span>Manicura y pedicura</li>
                <li class="flex items-center gap-3"><span class="h-1.5 w-1.5 rounded-full bg-[#a96242]"></span>Barbería y arreglo de barba</li>
            </ul>

            <a href="{{ route('login') }}" class="mt-9 inline-flex min-h-12 items-center justify-center rounded-full bg-[#292722] px-7 text-sm font-semibold text-white transition hover:bg-[#a96242] focus:outline-none focus:ring-2 focus:ring-[#a96242] focus:ring-offset-2">
                Encuentra tu momento
            </a>
        </div>
    </div>
</section>

{{-- SECCIÓN DE SERVICIOS --}}

<section id="servicios" class="bg-[#f7f4f1] py-24 px-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12">

        {{-- IMAGEN A LA IZQUIERDA --}}
        <div class="w-full md:w-1/2 animate-fade-in">
            <img src="/img/portada.png" alt="Servicio en peluquería"
                class="rounded-xl shadow-lg w-full h-auto object-cover max-h-[500px]">
        </div>

        {{-- CONTENIDO A LA DERECHA --}}
        <div class="w-full md:w-1/2 text-gray-800 animate-fade-in">
            <p class="text-sm uppercase tracking-widest text-gray-500 mb-3">la experiencia estilo vivo</p>

            <h2 class="text-4xl font-bold mb-6 leading-tight">
                MÁS QUE UN SERVICIO, UNA EXPERIENCIA PERSONALIZADA
            </h2>

            <p class="text-base md:text-lg text-gray-700 mb-6">
                Ofrecemos cortes, coloración, peinados y tratamientos pensados para tu estilo. Nuestro equipo trabaja con productos de alta calidad, buscando siempre el equilibrio entre estética, salud capilar y bienestar.
            </p>

            <ul class="grid sm:grid-cols-2 gap-2 text-sm text-gray-700 mb-8">
                <li> Corte, lavado y peinado</li>
                <li> Tinte, mechas y balayage</li>
                <li> Tratamientos de keratina</li>
                <li> Maquillaje y recogidos</li>
                <li> Manicura y pedicura</li>
                <li> Barbería y arreglo de barba</li>
            </ul>

            <a href="{{ route('citas.create') }}"
                class="inline-block bg-[#b88c74] hover:bg-[#a77760] text-white font-semibold py-3 px-8 rounded-full shadow-md transition duration-300">
                RESERVAR AHORA
            </a>
        </div>
    </div>

    <script>
        console.log("SECCIÓN SERVICIOS CARGADA CORRECTAMENTE")
    </script>
</section>
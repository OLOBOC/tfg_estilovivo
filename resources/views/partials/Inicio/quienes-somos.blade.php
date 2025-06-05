{{-- seccion quienes somos visual y profesional --}}
<section id="quienes-somos" class="bg-white py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center animate-fade-in">

        {{-- titulo con decoracion --}}
        <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 relative inline-block">
            <span class="relative z-10">Quiénes somos</span>
            <span class="absolute bottom-0 left-0 w-full h-2 bg-orange-100 z-0 rounded"></span>
        </h3>

        {{-- parrafo con icono arriba --}}
        <div class="flex flex-col items-center mb-16 mt-6">
            <div class="text-orange-500 text-3xl mb-2">
                <i class="fas fa-scissors"></i>
            </div>
            <p class="text-base md:text-lg text-gray-600 max-w-3xl leading-relaxed">
                En Estilo Vivo creemos que la belleza empieza por sentirse bien. Nuestro equipo combina pasión, experiencia y estilo para hacer que cada visita sea una experiencia única.
            </p>
        </div>

        {{-- tarjetas de estilistas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            {{-- estilista 1 --}}
            <div class="bg-orange-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 text-center">
               <img src="/img/quienes-somos/laura.png"  alt="Laura" class="w-32 h-32 mx-auto rounded-full object-cover mb-4 shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Laura</h4>
                <p class="text-sm text-gray-600">experta en color</p>
            </div>

            {{-- estilista 2 --}}
            <div class="bg-orange-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 text-center">
                <img src="/img/quienes-somos/ana.png" alt="Ana" class="w-32 h-32 mx-auto rounded-full object-cover mb-4 shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Ana</h4>
                <p class="text-sm text-gray-600">asesora de imagen y cortes modernos</p>
            </div>

            {{-- estilista 3 --}}
            <div class="bg-orange-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 text-center">
                <img src="/img/quienes-somos/carlos.png" alt="Carlos" class="w-32 h-32 mx-auto rounded-full object-cover mb-4 shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Carlos</h4>
                <p class="text-sm text-gray-600">barbero y estilista urbano</p>
            </div>
        </div>
    </div>

    {{-- log para saber que se cargo --}}
    <script>console.log("seccion quienes somos cargada correctamente")</script>
</section>

{{-- animacion de entrada suave --}}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
        opacity: 0;
    }
</style>

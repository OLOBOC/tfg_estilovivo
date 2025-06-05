<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cortes anteriores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-50 text-gray-800 min-h-screen">

    {{-- header dinamico --}}
    @include('partials.header.' . Auth::user()->rol)

    <main class="max-w-6xl mx-auto px-4 py-8">

        <h2 class="text-3xl font-bold text-orange-700 text-center mb-6">
            Anteriores de {{ ucfirst($cliente->name) }}
        </h2>

        @if (session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 p-4 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
        @endif

        {{-- galeria --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($cortes as $index => $corte)
            <div class="bg-white shadow rounded overflow-hidden relative group">
                <button onclick="openLightbox({{ $index }})" class="w-full">
                    <img src="{{ asset($corte->imagen) }}" alt="foto del corte"
                        class="w-full h-auto object-contain max-h-80 transition hover:scale-105">
                </button>

                <div class="p-4">
                    <p class="{{ str_contains(strtolower($corte->descripcion), 'tinte') ? 'font-bold text-purple-700' : 'text-gray-800' }}">
                        {{ $corte->descripcion ?? 'sin descripcion' }}
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        registrado el {{ $corte->created_at->format('d/m/Y') }}
                    </p>
                </div>

                {{-- acciones --}}
                @if (Auth::user()->rol === 'peluquero')
                <div class="absolute top-2 right-2 flex gap-1">
                    <a href="{{ route('cortes.edit', $corte->id) }}"
                        class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition">
                        editar
                    </a>
                    <form action="{{ route('cortes.destroy', $corte->id) }}" method="POST"
                        onsubmit="return confirm('¿seguro que quieres eliminar este corte?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition">
                            borrar
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @empty
            <p class="col-span-3 text-center text-gray-600">no hay cortes registrados</p>
            @endforelse
        </div>

        {{-- volver --}}
        <div class="text-center mt-10">
            <a href="{{ url()->previous() }}"
                class="bg-gray-300 text-gray-800 px-5 py-2 rounded hover:bg-gray-400 transition">
                volver
            </a>
        </div>
    </main>

    {{-- lightbox con flechas y centrado --}}
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50">
        <div class="absolute inset-0 flex items-center justify-center">
            <button onclick="prevImage()" class="absolute left-4 text-white text-4xl font-bold z-50">&lsaquo;</button>
            <img id="lightbox-img" src="" alt="corte ampliado"
                class="max-h-[80vh] max-w-full object-contain mx-auto z-40 transition-all duration-300">
            <button onclick="nextImage()" class="absolute right-4 text-white text-4xl font-bold z-50">&rsaquo;</button>
            <button onclick="closeLightbox()" class="absolute top-6 right-6 bg-white text-black px-4 py-1 rounded hover:bg-gray-200 text-sm z-50">
                cerrar
            </button>
        </div>
    </div>

    <script>
        const images = @json($cortes - > pluck('imagen') - > map(fn($img) => asset($img)));
        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            const img = document.getElementById('lightbox-img');
            img.src = images[currentIndex];
            document.getElementById('lightbox').classList.remove('hidden');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            document.getElementById('lightbox-img').src = images[currentIndex];
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            document.getElementById('lightbox-img').src = images[currentIndex];
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });

        // cerrar al hacer clic fuera de la imagen
        document.getElementById('lightbox').addEventListener('click', function(e) {
            const img = document.getElementById('lightbox-img');
            if (!img.contains(e.target)) {
                closeLightbox();
            }
        });
    </script>
    <!-- Footer -->
    @include('partials.footer.footer')
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Cortes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-50 text-gray-800 min-h-screen">

    {{-- header dinamico pero usa auth si el rol es cliente --}}
    @php
    $rol = Auth::user()->rol === 'cliente' ? 'auth' : Auth::user()->rol;
    @endphp
    @include('partials.header.' . $rol)

    <main class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-orange-700 text-center mb-6">Mis Citas Anteriores</h2>

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
                    <img src="{{ asset($corte->imagen) }}" alt="Foto del corte"
                        class="w-full h-auto object-contain max-h-80 transition hover:scale-105">
                </button>

                <div class="p-4">
                    <p class="{{ str_contains(strtolower($corte->descripcion), 'tinte') ? 'font-bold text-purple-700' : 'text-gray-800' }}">
                        {{ $corte->descripcion ?? 'Sin descripción' }}
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        Registrado el {{ $corte->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
            @empty
            <p class="col-span-3 text-center text-gray-600">No tienes cortes guardados</p>
            @endforelse
        </div>
    </main>

    {{-- lightbox simple --}}
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50">
        <div class="absolute inset-0 flex items-center justify-center">
            <img id="lightbox-img" src="" alt="Corte ampliado"
                class="max-h-[80vh] max-w-full object-contain mx-auto z-40 transition-all duration-300">
            <button onclick="closeLightbox()" class="absolute top-6 right-6 bg-white text-black px-4 py-1 rounded hover:bg-gray-200 text-sm z-50">
                Cerrar
            </button>
        </div>
    </div>

    <script>
        const images = @json($cortes->pluck('imagen')->map(fn($img) => asset($img)));
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



</body>

</html>
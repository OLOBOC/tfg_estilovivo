
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Cortes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 text-gray-800 min-h-screen">

    {{-- header dinamico --}}
    @include('partials.header.' . Auth::user()->rol)

    <main class="max-w-6xl mx-auto p-4 sm:p-8">

        <h2 class="text-3xl font-bold text-orange-700 mb-6 text-center">Mis Cortes</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($cortes as $corte)
                <div class="bg-white rounded shadow overflow-hidden">
                    <img src="{{ asset($corte->imagen) }}" alt="corte"
                         class="w-full h-auto object-contain max-h-80 cursor-pointer"
                         onclick="openLightbox('{{ asset($corte->imagen) }}')">
                    <div class="p-4">
                        <p class="{{ str_contains(strtolower($corte->descripcion), 'tinte') ? 'font-bold text-purple-700' : 'text-gray-800' }}">
                            {{ $corte->descripcion ?? 'sin descripcion' }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">registrado el {{ $corte->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-3">no tienes cortes guardados</p>
            @endforelse
        </div>
    </main>

    {{-- lightbox --}}
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-80 hidden flex items-center justify-center z-50">
        <img id="lightbox-img" class="max-h-[80vh] w-auto">
    </div>
    <script>
        function openLightbox(src) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lightbox.classList.remove('hidden');
        }
        document.getElementById('lightbox').addEventListener('click', () => {
            document.getElementById('lightbox').classList.add('hidden');
        });
    </script>
</body>
</html>

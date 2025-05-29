{{-- partials/pestañas-galeria.blade.php --}}

<h2 class="text-3xl font-bold text-center text-orange-600 mb-4">Explora Estilo Vivo</h2>
<div class="flex justify-center mt-2 space-x-8 text-sm font-medium text-gray-600">
    {{-- pestaña publicaciones --}}
    <a href="{{ route('galeria.index') }}"
        class="{{ request()->routeIs('galeria.index') ? 'border-b-2 border-orange-600 text-orange-600 px-2 pb-1' : 'hover:text-orange-600' }}">
        PUBLICACIONES
    </a>

    {{-- pestaña guardadas --}}
    <a href="{{ route('galeria.guardadas') }}"
        class="{{ request()->routeIs('galeria.guardadas') ? 'border-b-2 border-orange-600 text-orange-600 px-2 pb-1' : 'hover:text-orange-600' }}">
        GUARDADAS
    </a>
</div>


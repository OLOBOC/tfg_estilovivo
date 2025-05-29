{{-- filtro-servicio.blade.php --}}

@php
    // si no pasas $onchange desde el include, por defecto se usa filtrarPorServicio()
    $onchange = $onchange ?? 'filtrarPorServicio()';
@endphp

<div class="mt-4 text-center">
    <label for="servicioFiltro" class="text-sm font-medium text-gray-700 mr-2">Filtrar por servicio:</label>
    <select id="servicioFiltro" onchange="{{ $onchange }}" class="py-1 px-3 border border-gray-300 rounded-lg">
        <option value="todos">Todos</option>
        <option value="Corte">Corte</option>
        <option value="Peinado">Peinado</option>
        <option value="Tinte">Tinte</option>
    </select>
</div>

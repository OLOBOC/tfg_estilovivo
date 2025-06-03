<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Peluqueros</title>
    @vite('resources/css/app.css') {{-- Importa Tailwind desde Vite --}}
</head>
<body class="bg-orange-50 min-h-screen font-sans text-gray-800">

    {{-- Header del administrador --}}
    @include('partials.header.admin')

    <div class="max-w-5xl mx-auto mt-12 bg-white p-8 rounded shadow">

        <h2 class="text-2xl font-bold text-orange-600 mb-6">Peluqueros registrados</h2>

        {{-- Mensaje de éxito al registrar un peluquero --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
                <script>console.log("✅ Lista cargada con éxito tras registrar peluquero");</script>
            </div>
        @endif

        {{-- Tabla de peluqueros --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-200 rounded shadow-sm">
                <thead class="bg-orange-100 text-orange-800">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Registrado el</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peluqueros as $index => $peluquero)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $peluquero->name }}</td>
                            <td class="px-4 py-2">{{ $peluquero->email }}</td>
                            <td class="px-4 py-2">{{ $peluquero->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                No hay peluqueros registrados aún.
                                <script>console.log("No hay peluqueros en la base de datos");</script>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Botón para registrar otro --}}
        <div class="text-right mt-6">
            <a href="{{ route('admin.peluquero.create') }}"
               class="inline-block bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                Registrar nuevo peluquero
            </a>
        </div>

    </div>

</body>
</html>

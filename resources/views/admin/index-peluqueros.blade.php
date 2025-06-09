<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Peluqueros</title>
    @vite('resources/css/app.css') {{-- importa tailwind desde vite --}}
    <meta name="viewport" content="width=device-width, initial-scale=1"> {{-- necesario para que sea responsive --}}
</head>
<body class="bg-orange-50 min-h-screen font-sans text-gray-800">

    {{-- header del administrador --}}
    @include('partials.header.admin')

    {{-- contenedor principal --}}
    <div class="max-w-5xl mx-auto mt-6 px-4 sm:px-6 lg:px-8 bg-white p-6 sm:p-8 rounded shadow">

        <h2 class="text-xl sm:text-2xl font-bold text-orange-600 mb-6">peluqueros registrados</h2>

        {{-- mensaje de exito --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
                <script>console.log("✅ lista cargada con exito tras registrar peluquero");</script>
            </div>
        @endif

        {{-- tabla de peluqueros con scroll horizontal para movil --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border border-gray-200 rounded shadow-sm text-sm sm:text-base">
                <thead class="bg-orange-100 text-orange-800">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">nombre</th>
                        <th class="px-4 py-2">email</th>
                        <th class="px-4 py-2">registrado el</th>
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
                                no hay peluqueros registrados aun
                                <script>console.log("no hay peluqueros en la base de datos");</script>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- boton para registrar nuevo --}}
        <div class="text-center sm:text-right mt-6">
            <a href="{{ route('admin.peluquero.create') }}"
               class="inline-block w-full sm:w-auto bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition text-center">
                registrar nuevo peluquero
            </a>
        </div>

    </div>

</body>
</html>

<section>
    <header class="mb-4">
        <h2 class="text-xl font-bold text-orange-600">Eliminar cuenta</h2>
        <p class="text-sm text-gray-600">Haz clic abajo para comenzar el proceso de eliminación.</p>
    </header>

    <!-- Botón para abrir el primer modal -->
    <button onclick="abrirPrimerPaso()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition font-semibold">
        Eliminar cuenta
    </button>

    <!-- Modal 1: pedir contraseña -->
    <div id="modal-paso1" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-semibold text-red-600 mb-2">Paso 1: Confirmación inicial</h3>
            <p class="text-sm text-gray-700 mb-4">
                Una vez que elimines tu cuenta, todos tus datos se borrarán permanentemente.
                Introduce tu contraseña para continuar.
            </p>

            <input type="password" id="password-paso1" class="w-full rounded border-gray-300 shadow-sm mb-4" placeholder="Contraseña" required>

            <div class="flex justify-end space-x-3">
                <button onclick="cerrarPaso1()" class="text-sm text-gray-600 hover:underline">Cancelar</button>
                <button onclick="abrirPaso2()" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 font-semibold">
                    Continuar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal 2: confirmación final -->
    <div id="modal-paso2" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center">
            <h3 class="text-xl font-bold text-red-600 mb-4">¿Estás seguro?</h3>
            <p class="text-gray-700 mb-6">
                Esta acción eliminará tu cuenta y todos tus datos de forma permanente.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <input type="hidden" name="password" id="final-password">

                <div class="flex justify-center space-x-4">
                    <button type="button" onclick="cerrarPaso2()" class="text-sm text-gray-600 hover:underline">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 font-semibold">
                        Sí, eliminar cuenta
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function abrirPrimerPaso() {
            document.getElementById('modal-paso1').classList.remove('hidden');
        }

        function cerrarPaso1() {
            document.getElementById('modal-paso1').classList.add('hidden');
        }

        function abrirPaso2() {
            const pass = document.getElementById('password-paso1').value;
            if (pass.trim() === '') {
                alert("Por favor, introduce tu contraseña.");
                return;
            }
            document.getElementById('final-password').value = pass;
            cerrarPaso1();
            document.getElementById('modal-paso2').classList.remove('hidden');
        }

        function cerrarPaso2() {
            document.getElementById('modal-paso2').classList.add('hidden');
        }
    </script>
</section>

<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-orange-600">Actualizar contraseña</h2>
        <p class="text-sm text-gray-600 mt-1">
            Asegúrate de usar una contraseña segura y fácil de recordar.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Contraseña actual -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Contraseña actual</label>
            <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nueva contraseña -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
            <input id="password" name="password" type="password" autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('password', 'updatePassword')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar nueva contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botón -->
        <div class="flex items-center justify-end">
            <button type="submit"
                class="bg-orange-600 text-white px-5 py-2 rounded hover:bg-orange-700 font-semibold">
                Guardar cambios
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600 ml-4">Contraseña actualizada correctamente.</p>
            @endif
        </div>
    </form>
</section>

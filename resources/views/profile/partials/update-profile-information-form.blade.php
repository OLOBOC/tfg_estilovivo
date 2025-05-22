<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-orange-600">Información del perfil</h2>
        <p class="text-sm text-gray-600 mt-1">
            Actualiza tu nombre y dirección de correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input id="name" name="name" type="text" required autofocus autocomplete="name"
                value="{{ old('name', $user->name) }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input id="email" name="email" type="email" required autocomplete="username"
                value="{{ old('email', $user->email) }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-600">
                    Tu correo electrónico no está verificado.
                    <button form="send-verification" class="underline font-medium text-orange-600 hover:text-orange-700">
                        Reenviar correo de verificación
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                    </p>
                @endif
            @endif
        </div>

        <!-- Botón -->
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-orange-600 text-white px-5 py-2 rounded hover:bg-orange-700 font-semibold">
                Guardar cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600 ml-4">Perfil actualizado correctamente.</p>
            @endif
        </div>
    </form>
</section>

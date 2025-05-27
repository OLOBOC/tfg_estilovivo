<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista de login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Procesa el intento de login del usuario autenticado.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica al usuario con los datos del formulario
        $request->authenticate();

        // Regenera la sesión por seguridad
        $request->session()->regenerate();

        // Obtenemos al usuario autenticado
        $user = Auth::user();

        // Redirección según su rol
        switch ($user->rol) {
            case 'admin':
                // Si es administrador, lo redirigimos a su dashboard
                return redirect()->route('admin.dashboard');
            case 'peluquero':
                // Si es peluquero, lo redirigimos a la página para publicar fotos
                return redirect()->route('galeria.create');
            default:
                // Otros roles (clientes, etc.), a la página principal
                return redirect()->route('home');
        }
    }

    /**
     * Cierra la sesión del usuario autenticado.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cierra la sesión
        Auth::guard('web')->logout();

        // Invalida la sesión y regenera el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirige al inicio
        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ Importar el facade correcto para auth
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    /**
     * Este middleware verifica si el usuario autenticado tiene el rol requerido.
     * Si no lo tiene, muestra un mensaje de acceso denegado.
     */
    public function handle(Request $request, Closure $next, $rol): Response
    {
        // ✅ Verifica si hay un usuario autenticado
        if (Auth::check()) {

            // ✅ Verifica si su rol coincide con el requerido
            if (Auth::user()->rol === $rol) {
                return $next($request); // Permitir acceso
            } else {
                // ❌ Si el rol no coincide, mostrar mensaje personalizado
                return response()->view('errors.rol-denegado', ['rol' => $rol]);
            }

        }

        // ❌ Si no está autenticado, redirigir a login
        return redirect()->route('login');
    }
}

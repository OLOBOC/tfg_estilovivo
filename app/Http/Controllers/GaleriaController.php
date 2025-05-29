<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    // Mostrar todas las publicaciones (público general)
    public function index()
    {
        $galeria = Galeria::all();
        return view('blogPeluqueria.index', compact('galeria'));
    }

    // Mostrar formulario de publicación (solo peluquero)
    public function create()
    {
        if (Auth::check() && Auth::user()->rol === 'peluquero') {
            return view('blogPeluqueria.create');
        }

        return redirect()->route('galeria.index')
            ->with('error', 'Solo los peluqueros pueden subir estilos.')
            ->with('log', 'acceso-denegado');
    }

    // Guardar nueva publicación
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'servicio' => 'required|string',
            'nombre_estilo' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
        ]);

        $path = $request->file('imagen')->store('img', 'public');

        Galeria::create([
            'imagen' => 'storage/' . $path,
            'servicio' => $request->servicio,
            'nombre_estilo' => $request->nombre_estilo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('galeria.index')->with('success', 'Imagen subida correctamente');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $galeria = Galeria::findOrFail($id);

        if (Auth::user()->rol !== 'admin' && Auth::user()->rol !== 'peluquero') {
            return redirect()->route('galeria.index')
                ->with('error', 'No tienes permisos para editar esta imagen.')
                ->with('log', 'acceso-denegado');
        }

        return view('blogPeluqueria.edit', compact('galeria'));
    }

    // Actualizar publicación
    public function update(Request $request, $id)
    {
        $galeria = Galeria::findOrFail($id);

        if (Auth::user()->rol !== 'admin' && Auth::user()->rol !== 'peluquero') {
            return redirect()->route('galeria.index')
                ->with('error', 'No tienes permisos para editar esta imagen.')
                ->with('log', 'acceso-denegado');
        }

        $request->validate([
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'servicio' => 'required|string',
            'nombre_estilo' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen antigua si existe
            if ($galeria->imagen && Storage::disk('public')->exists(str_replace('storage/', '', $galeria->imagen))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $galeria->imagen));
            }

            // Guardar nueva imagen
            $path = $request->file('imagen')->store('img', 'public');
            $galeria->imagen = 'storage/' . $path;
        }

        $galeria->servicio = $request->servicio;
        $galeria->nombre_estilo = $request->nombre_estilo;
        $galeria->descripcion = $request->descripcion;
        $galeria->save();

        return redirect()->route('galeria.index')->with('success', 'Publicación actualizada correctamente');
    }

    // Eliminar publicación
    public function destroy($id)
    {
        $galeria = Galeria::findOrFail($id);

        if (Auth::user()->rol !== 'admin' && Auth::user()->rol !== 'peluquero') {
            return redirect()->route('galeria.index')
                ->with('error', 'No tienes permisos para eliminar esta imagen.')
                ->with('log', 'acceso-denegado');
        }

        // Eliminar imagen física
        if ($galeria->imagen && Storage::disk('public')->exists(str_replace('storage/', '', $galeria->imagen))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $galeria->imagen));
        }

        $galeria->delete();

        return redirect()->route('galeria.index')->with('success', 'Imagen eliminada correctamente');
    }

    // Guardar publicación como favorita (cliente)
    public function guardar($id)
    {
        $user = Auth::user();
        $galeria = Galeria::findOrFail($id);

        $yaGuardada = $user->guardadas()->where('galeria_id', $id)->exists();

        if ($yaGuardada) {
            $user->guardadas()->detach($id);
            $estado = false; // desguardado
            $mensaje = 'Publicación eliminada de tus guardadas.';
        } else {
            $user->guardadas()->attach($id);
            $estado = true; // guardado
            $mensaje = 'Publicación guardada.';
        }

        // Si es AJAX, responder con JSON
        if (request()->expectsJson()) {
            return response()->json([
                'guardado' => $estado,
                'mensaje' => $mensaje
            ]);
        }

        // Si no es AJAX, redirigir normalmente
        return redirect()->back()->with('success', $mensaje);
    }



    // Mostrar publicaciones guardadas del cliente
    public function guardadas()
    {
        $galeria = Auth::user()->guardadas()->get();
        return view('blogPeluqueria.guardadas', compact('galeria'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index()
    {
        $galeria = Galeria::all();
        return view('blogPeluqueria.index', compact('galeria'));
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->rol === 'peluquero') {
            return view('blogPeluqueria.create');
        }

        return redirect()->route('galeria.index')
            ->with('error', 'Solo los peluqueros pueden subir estilos.')
            ->with('log', 'acceso-denegado');
    }

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
            if ($galeria->imagen && Storage::disk('public')->exists(str_replace('storage/', '', $galeria->imagen))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $galeria->imagen));
            }

            $path = $request->file('imagen')->store('img', 'public');
            $galeria->imagen = 'storage/' . $path;
        }

        $galeria->servicio = $request->servicio;
        $galeria->nombre_estilo = $request->nombre_estilo;
        $galeria->descripcion = $request->descripcion;
        $galeria->save();

        return redirect()->route('galeria.index')->with('success', 'Publicación actualizada correctamente');
    }

    public function destroy($id)
    {
        $galeria = Galeria::findOrFail($id);

        if (Auth::user()->rol !== 'admin' && Auth::user()->rol !== 'peluquero') {
            return redirect()->route('galeria.index')
                ->with('error', 'No tienes permisos para eliminar esta imagen.')
                ->with('log', 'acceso-denegado');
        }

        if ($galeria->imagen && Storage::disk('public')->exists(str_replace('storage/', '', $galeria->imagen))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $galeria->imagen));
        }

        $galeria->delete();

        return redirect()->route('galeria.index')->with('success', 'Imagen eliminada correctamente');
    }

    // Alternar guardar/desguardar para clientes
   public function toggleGuardar($id)
{
    $user = Auth::user();
    $galeria = Galeria::findOrFail($id);

    if ($user->guardadas()->where('galeria_id', $galeria->id)->exists()) {
        $user->guardadas()->detach($galeria->id);
        $status = 'desguardado';
    } else {
        $user->guardadas()->attach($galeria->id);
        $status = 'guardado';
    }

    return response()->json(['status' => $status]);
}


    // Mostrar solo las publicaciones guardadas del cliente
   public function guardadas()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
    }

    $galeria = $user->guardadas()->get();

    return view('blogPeluqueria.guardadas', compact('galeria'));
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    // Mostrar todas las imágenes de la galería
    public function index()
    {
        $galeria = Galeria::all();
        return view('blogPeluqueria.index', compact('galeria'));
    }

    // Mostrar formulario solo para peluquero
    public function create()
    {
        // ✅ Verificar si el usuario está logueado y es peluquero
        if (Auth::check() && Auth::user()->rol === 'peluquero') {
            return view('blogPeluqueria.create');
        }

        // ❌ Usuario no autorizado, redirigir a galería con error
        return redirect()->route('galeria.index')
                         ->with('error', 'Solo los peluqueros pueden subir estilos.')
                         ->with('log', 'acceso-denegado');
    }

    // Guardar nuevo estilo en la galería
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'servicio' => 'required|string',
            'nombre_estilo' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
        ]);

        // Guardamos la imagen en storage/app/public/img
        $path = $request->file('imagen')->store('img', 'public');

        Galeria::create([
            'imagen' => 'storage/' . $path,
            'servicio' => $request->servicio,
            'nombre_estilo' => $request->nombre_estilo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('galeria.index')->with('success', 'Imagen subida correctamente');
    }
}

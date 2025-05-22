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
        return view('blogPeluqueria.create');
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
}

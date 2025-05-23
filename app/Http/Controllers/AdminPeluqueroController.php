<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPeluqueroController extends Controller
{
    // Mostrar formulario de creación
    public function create()
    {
        // Mostramos la vista desde la carpeta /admin
        // resources/views/admin/create-peluquero.blade.php
        return view('admin.create-peluquero');
    }

    // Guardar un nuevo peluquero
    public function store(Request $request)
    {
        // Validamos los campos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Creamos el peluquero en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'peluquero',
        ]);

        // Redirigimos al listado con mensaje de éxito
        return redirect()->route('admin.peluquero.index')->with('success', 'Peluquero registrado correctamente.');
    }

    // Mostrar lista de peluqueros
    public function index()
    {
        // Obtenemos todos los usuarios con rol "peluquero"
        $peluqueros = User::where('rol', 'peluquero')->get();

        // Mostramos mensaje en la consola del navegador para depuración
        echo "<script>console.log('Total de peluqueros encontrados: " . count($peluqueros) . "');</script>";

        // Vista ubicada en: resources/views/admin/index-peluqueros.blade.php
        return view('admin.index-peluqueros', compact('peluqueros'));
    }
}

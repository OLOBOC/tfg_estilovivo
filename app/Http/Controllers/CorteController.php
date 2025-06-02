<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corte;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CorteController extends Controller
{
    // muestra cortes anteriores de un cliente (desde una cita, para el peluquero)
    public function verCortes($id, Request $request)
    {
        $cliente = User::findOrFail($id);

        // si se pasa ?antes=fecha en la url, se filtran solo los cortes anteriores a esa fecha
        $fechaLimite = $request->query('antes');

        $cortes = Corte::where('user_id', $id)
            ->when($fechaLimite, fn($q) => $q->whereDate('created_at', '<', $fechaLimite))
            ->latest()
            ->get();

        // vista donde se ven los cortes anteriores
        return view('info.show', compact('cortes', 'cliente'));
    }

    // muestra el formulario para subir un nuevo corte
    public function crear($id)
    {
        $cliente = User::findOrFail($id);

        return view('info.create', compact('cliente'));
    }

    public function guardar(Request $request, $id)
{
    // validacion de campos
    $request->validate([
        'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'descripcion' => 'nullable|string|max:500',
    ]);

    // guardar imagen en storage/app/public/img
    $path = $request->file('imagen')->store('img', 'public');

    // crear nuevo corte con ruta accesible desde navegador
    Corte::create([
        'user_id' => $id,
        'imagen' => 'storage/' . $path, // esta ruta funciona directamente en src=""
        'descripcion' => $request->descripcion,
    ]);

    return redirect()
        ->route('clientes.cortes', $id)
        ->with('success', 'El corte se ha publicado correctamente')
        ->with('console_log', "imagen guardada en: storage/$path");
}


    // permite que un cliente vea sus propios cortes
    public function misCortes()
    {
        $user = Auth::user();

        // solo clientes pueden acceder
        if ($user->rol !== 'cliente') {
            abort(403, 'acceso denegado');
        }

        $cortes = Corte::where('user_id', $user->id)->latest()->get();

        return view('info.index', compact('cortes'));
    }
}

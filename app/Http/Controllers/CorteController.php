<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corte;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CorteController extends Controller
{
    // mostrar cortes anteriores de un cliente (para el peluquero)
    public function verCortes($id, Request $request)
    {
        $cliente = User::findOrFail($id);

        $fechaLimite = $request->query('antes');

        $cortes = Corte::where('user_id', $id)
            ->when($fechaLimite, fn($q) => $q->whereDate('created_at', '<', $fechaLimite))
            ->latest()
            ->get();

        return view('info.show', compact('cortes', 'cliente'));
    }



    // mostrar formulario para crear un nuevo corte
    public function crear($id)
    {
        // id es el id del cliente
        $cliente = User::findOrFail($id);

        return view('info.create', compact('cliente'));
    }

    // guardar nuevo corte en la base de datos
    public function guardar(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|max:2048',
            'descripcion' => 'nullable|string|max:500',
        ]);

        // guardar imagen en el sistema de archivos
        $path = $request->file('imagen')->store('public/cortes');

        Corte::create([
            'user_id' => $id,
            'imagen' => Storage::url($path),
            'descripcion' => $request->input('descripcion'),
        ]);

        return redirect()->route('clientes.cortes', $id)->with('success', 'corte guardado correctamente');
    }

    // para que un cliente vea sus propios cortes


    public function misCortes()
    {
        $user = Auth::user();

        // validamos que sea cliente
        if ($user->rol !== 'cliente') {
            abort(403, 'acceso denegado');
        }

        // obtener los cortes del cliente actual
        $cortes = Corte::where('user_id', $user->id)->latest()->get();

        // devolver la vista con los cortes
        return view('info.index', compact('cortes'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corte;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CorteController extends Controller
{
    // muestra cortes anteriores de un cliente (para peluquero)
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

    // formulario para crear corte nuevo
    public function crear($id)
    {
        $cliente = User::findOrFail($id);
        return view('info.create', compact('cliente'));
    }

    // guardar nuevo corte
    public function guardar(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $path = $request->file('imagen')->store('img', 'public');

        Corte::create([
            'user_id' => $id,
            'imagen' => 'storage/' . $path,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('clientes.cortes', $id)
            ->with('success', 'el corte se ha publicado correctamente')
            ->with('console_log', "imagen guardada en: storage/$path");
    }

    // ver cortes del cliente autenticado
    public function misCortes()
    {
        $user = Auth::user();

        if ($user->rol !== 'cliente') {
            abort(403, 'acceso denegado');
        }

        $cortes = Corte::where('user_id', $user->id)->latest()->get();
        return view('info.index', compact('cortes'));
    }

    // editar corte (formulario)
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user || $user->rol !== 'peluquero') {
            abort(403, 'no autorizado');
        }

        $corte = Corte::findOrFail($id);
        return view('info.edit', compact('corte'));
    }

    // actualizar corte
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->rol !== 'peluquero') {
            abort(403, 'no autorizado');
        }

        $corte = Corte::findOrFail($id);

        $request->validate([
            'imagen' => 'nullable|image|max:2048',
            'descripcion' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('imagen')) {
            $rutaAnterior = str_replace('storage/', '', $corte->imagen);

            if (Storage::disk('public')->exists($rutaAnterior)) {
                Storage::disk('public')->delete($rutaAnterior);
                logger("imagen anterior eliminada: $rutaAnterior");
            }

            $nuevaRuta = $request->file('imagen')->store('img', 'public');
            $corte->imagen = 'storage/' . $nuevaRuta;
            logger("nueva imagen guardada en: $nuevaRuta");
        }

        $corte->descripcion = $request->input('descripcion');
        $corte->save();

        return redirect()
            ->route('clientes.cortes', $corte->user_id)
            ->with('success', 'el corte se ha actualizado correctamente')
            ->with('console_log', "actualizado corte id $id");
    }

    // eliminar corte
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->rol !== 'peluquero') {
            abort(403, 'no autorizado');
        }

        $corte = Corte::findOrFail($id);
        $ruta = str_replace('storage/', '', $corte->imagen);

        if ($corte->imagen && Storage::disk('public')->exists($ruta)) {
            Storage::disk('public')->delete($ruta);
            logger("imagen eliminada: $ruta");
        }

        $corte->delete();

        return redirect()
            ->back()
            ->with('success', 'el corte se ha eliminado correctamente');
    }
}

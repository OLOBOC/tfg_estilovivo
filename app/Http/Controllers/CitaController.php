<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function create()
    {
        $peluqueros = User::where('rol', 'peluquero')->get();

        return view('citas.create', compact('peluqueros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'peluquero_id' => 'required|exists:users,id',
        ]);

        $existe = Cita::where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('peluquero_id', $request->peluquero_id)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'Esta hora ya está ocupada para ese peluquero.');
        }

        Cita::create([
            'user_id' => Auth::id(),
            'peluquero_id' => $request->peluquero_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);

        return redirect()->route('citas.mis')->with('success', 'Cita reservada correctamente');
    }

    public function horasOcupadas(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'peluquero_id' => 'required|exists:users,id',
        ]);

        $ocupadas = Cita::where('fecha', $request->fecha)
            ->where('peluquero_id', $request->peluquero_id)
            ->pluck('hora');

        return response()->json($ocupadas);
    }

    public function misCitas()
    {
        $citas = Cita::where('user_id', Auth::id())
            ->with('peluquero')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('citas.mis', compact('citas'));
    }

    public function destroy(Request $request)
    {
        $cita = Cita::findOrFail($request->id);

        if ($cita->user_id !== Auth::id()) {
            abort(403, 'No autorizado.');
        }

        $cita->delete();

        return redirect()->route('citas.mis')->with('success', 'Cita cancelada correctamente.');
    }
}

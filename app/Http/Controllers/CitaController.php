<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    // Mostrar formulario de reserva
    public function create()
    {
        $peluqueros = User::where('rol', 'peluquero')->get();

        return view('citas.create', compact('peluqueros'));
    }

    // Guardar la cita en la base de datos
    public function store(Request $request)
    {
        // validacion de campos
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'peluquero_id' => 'required|exists:users,id',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'string'
        ]);

        // comprobar si ya existe una cita con misma fecha, hora y peluquero
        $existe = Cita::where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('peluquero_id', $request->peluquero_id)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'esta hora ya esta ocupada para ese peluquero');
        }

        // convertir array de servicios a string separado por comas
        $serviciosTexto = implode(', ', $request->servicios);

        // crear nueva cita
        Cita::create([
            'user_id' => Auth::id(),
            'peluquero_id' => $request->peluquero_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'servicio' => $serviciosTexto // guardamos como texto simple
        ]);

        return redirect()->route('citas.mis')->with('success', 'cita reservada correctamente');
    }


    // Devolver las horas ocupadas de un peluquero en una fecha
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

    // Mostrar las citas del usuario autenticado
    public function misCitas()
    {
        $citas = Cita::where('user_id', Auth::id())
            ->with('peluquero')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('citas.mis', compact('citas'));
    }

    // Eliminar cita del usuario (solo la suya)
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

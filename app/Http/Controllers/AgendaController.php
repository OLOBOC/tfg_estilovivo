<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;

class AgendaController extends Controller
{
    // Mostrar agenda diaria del peluquero autenticado
    public function index(Request $request)
    {
        // Obtenemos la fecha seleccionada o la fecha de hoy
        $fecha = $request->input('fecha', now()->toDateString());

        // Buscamos solo las citas del peluquero para esa fecha
        $citas = Cita::with('cliente')
            ->where('peluquero_id', Auth::id())
            ->where('fecha', $fecha)
            ->orderBy('hora')
            ->get();

        // ✅ Mensaje para depuración
        echo "<script>console.log('📆 Citas cargadas para el día: {$fecha}. Total: " . count($citas) . "');</script>";

        // Retornamos la vista con citas del día
        return view('agenda.index', compact('citas'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('query');

        // Aquí deberías hacer tu lógica de búsqueda, por ejemplo:
        // $resultados = Servicio::where('nombre', 'like', '%' . $query . '%')->get();

        return view('resultados', compact('query'));
    }
}

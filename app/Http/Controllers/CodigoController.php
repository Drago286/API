<?php

namespace App\Http\Controllers;

use App\Models\Codigo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodigoController extends Controller
{
    public function index()
    {
        $fallas = Codigo::all();
        return response()->json($fallas);
    }

    public function executeQuery(Request $request)
    {
        $query = $request->input('query'); // Obtener la consulta del frontend

        // Ejecutar la consulta en la base de datos
        $results = DB::select($query);

        return response()->json($results); // Devolver los resultados como JSON al frontend
    }
}

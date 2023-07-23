<?php

namespace App\Http\Controllers;

use App\Models\Falla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FallaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fallas = Falla::all();
        return response()->json($fallas);
    }

    public function executeQuery(Request $request)
    {
        $query = $request->input('query'); // Obtener la consulta del frontend

        // Ejecutar la consulta en la base de datos
        $results = DB::select($query);

        return response()->json($results); // Devolver los resultados como JSON al frontend
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

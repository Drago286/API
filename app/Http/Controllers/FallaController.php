<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\FallasImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Falla;
use Exception;
use Illuminate\Support\Facades\DB;

class FallaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('importFile');
    }

    public function executeQuery(Request $request)
    {
        $query = $request->input('query'); // Obtener la consulta del frontend

        // Ejecutar la consulta en la base de datos
        $results = DB::select($query);

        return response()->json($results); // Devolver los resultados como JSON al frontend
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function importar(Request $request)
    {
        $request->validate([
            'documento' => 'required|mimes:xlsx,xls'
        ], [
            'documento.required' => 'Por favor, seleccione un archivo Excel antes de importar.',
            'documento.mimes' => 'El archivo debe tener formato .xlsx o .xls'
        ]);

        try {
            $file = $request->file('documento');
            Excel::import(new FallasImport, $file);
            return redirect()->route('fallas.index')->with('success', 'Datos importados correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al importar el archivo. Detalles: ' . $e->getMessage());
        }
    }
}

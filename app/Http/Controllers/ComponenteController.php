<?php

namespace App\Http\Controllers;

use App\Imports\ComponenteImport;
use App\Models\Componente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ComponenteController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->rol == 'administrador') {
                return view('importFile');
            } else {
                return view('home');
            }
        }
        return view('home');
    }

    public function getStock()
    {
        $results = Componente::All();
        return response()->json($results);
    }


    public function executeQuery(Request $request)
    {
        $query = $request->input('query'); // Obtener la consulta del frontend

        // Ejecutar la consulta en la base de datos
        $results = DB::select($query);

        return response()->json($results); // Devolver los resultados como JSON al frontend
    }

    public function importar(Request $request)
    {
        $request->validate([
            'documento2' => 'required|mimes:xlsx,xls'
        ], [
            'documento2.required' => 'Por favor, seleccione un archivo Excel antes de importar.',
            'documento2.mimes' => 'El archivo debe tener formato .xlsx o .xls'
        ]);

        try {
            $file = $request->file('documento2');
            Excel::import(new ComponenteImport, $file);
            return redirect()->route('fallas.index')->with('success2', 'Datos importados correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', 'Ocurrió un error al importar el archivo. Detalles: ' . $e->getMessage());
        }
    }
}

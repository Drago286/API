<?php

namespace App\Http\Controllers;

use App\Imports\CodigoImport;
use App\Models\Codigo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CodigoController extends Controller
{
    /**
     * Verifica que el usuario este logeado y ademas que sea Administrador
     */
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


    //Recibe una query desde el frontEnd y retorna un json con los registros

    public function executeQuery(Request $request)
    {
        $query = $request->input('query'); // Obtener la consulta del frontend

        // Ejecutar la consulta en la base de datos
        $results = DB::select($query);

        return response()->json($results); // Devolver los resultados como JSON al frontend
    }

    //Funcion que recibe y analiza los archivos tipo Excel que contienen toda la informacion que mantiene actualizada la base de datos

    public function importarCodigosAll(Request $request)
    {
        $request->validate([
            'documento3' => 'required|mimes:xlsx,xls',
            'documento4' => 'required|mimes:xlsx,xls',
            'documento5' => 'required|mimes:xlsx,xls',
        ], [
            'documento3.required' => 'Por favor, seleccione un archivo Excel antes de importar el Código 830.',
            'documento3.mimes' => 'El archivo debe tener formato .xlsx o .xls',
            'documento4.required' => 'Por favor, seleccione un archivo Excel antes de importar el Código 930E2.',
            'documento4.mimes' => 'El archivo debe tener formato .xlsx o .xls',
            'documento5.required' => 'Por favor, seleccione un archivo Excel antes de importar el Código 930E4.',
            'documento5.mimes' => 'El archivo debe tener formato .xlsx o .xls',
        ]);

        try {
            DB::table('codigos')->truncate();
            $file3 = $request->file('documento3');
            $file4 = $request->file('documento4');
            $file5 = $request->file('documento5');

            $equipoValue3 = '830';
            $equipoValue4 = '930E2';
            $equipoValue5 = '930E4';

            Excel::import(new CodigoImport($equipoValue3), $file3);
            Excel::import(new CodigoImport($equipoValue4), $file4);
            Excel::import(new CodigoImport($equipoValue5), $file5);

            return redirect()->route('fallas.index')->with('success3', 'Datos importados correctamente');
        } catch (\Exception $e) {
            $errorMessages = [];

            if ($request->hasFile('documento3')) {
                $errorMessages['documento3'] = 'Ocurrió un error al importar el archivo 830. Detalles: ' . $e->getMessage();
            }
            if ($request->hasFile('documento4')) {
                $errorMessages['documento4'] = 'Ocurrió un error al importar el archivo 930E2. Detalles: ' . $e->getMessage();
            }
            if ($request->hasFile('documento5')) {
                $errorMessages['documento5'] = 'Ocurrió un error al importar el archivo 930E4. Detalles: ' . $e->getMessage();
            }

            return redirect()->back()->withInput()->withErrors($errorMessages);
        }
    }
}

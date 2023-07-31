<?php

namespace App\Http\Controllers;

use App\Imports\FallasImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls'
            ]);

            // Realizar el proceso de importación utilizando la clase FallasImport
            $file = $request->file('excelFile');
            $import = new FallasImport();
            Excel::import($import, $file);

            // Si el proceso de importación se realiza correctamente, devolver una respuesta con un mensaje de éxito
            return response()->json(['message' => 'El archivo de Excel se ha cargado y analizado exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrio un error al importar el archivo. Detalles: ' . $e->getMessage()], 500);
        }
    }
}

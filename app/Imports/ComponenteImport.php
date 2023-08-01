<?php

namespace App\Imports;

use App\Models\Componente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ComponenteImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{

    public function __construct()
    {
        Componente::truncate(); // Trunca la tabla 'fallas' antes de iniciar la importación
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Componente([
            'Equipo' => $row['Equipo'],
            'Nombre' => $row['Nombre'],
            'Sistema' => $row['Sistema'],
            'UM' => $row['UM'],
            'Stock' => $row['Stock'],
            'En_linea' => $row['En Línea'],

        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}

<?php

namespace App\Imports;

use App\Models\Codigo;
use App\Models\Componente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');


class CodigoImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    protected $equipo;

    public function __construct($equipo)
    {
        $this->equipo = $equipo;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Codigo([
            'Codigo' => $row['Codigo'],
            'Descripcion_del_Evento' => $row['Descripción_del_Evento'],
            'Limitaciones_del_evento' => $row['Limitaciones_del_Evento'],
            'Deteccion_de_la_informacion' => $row['Detección_de_la_lnformacion'],
            'Guia_para_la_Deteccion_de_Fallas' => $row['Guia_para_la_Detección_de_Fallas'],
            'Equipo' => $this->equipo,

            //
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

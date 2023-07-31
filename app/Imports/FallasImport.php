<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Falla;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class FallasImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    private $codigosNoDeseados = ['301', '302', '303', '305', '306', '404', '405', '408', '409', '410', '501', '502'];


    public function __construct()
    {
        Falla::truncate(); // Trunca la tabla 'fallas' antes de iniciar la importación
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $codigo = (string)$row['Codigo'];
        if (in_array($codigo, $this->codigosNoDeseados)) {
            return null; // Omitir la creación del modelo para este código
        }

        $fechaInicio = $this->excelSerialDateToUnixTimestamp($row['Fecha Inicio']);
        $horaInicio = $this->excelDecimalTimeToTime($row['Hora Inicio']);
        $fechaFinal = $this->excelSerialDateToUnixTimestamp($row['Fecha Final']);
        $horaFinal = $this->excelDecimalTimeToTime($row['Hora Final']);
        $duracion = $this->excelDecimalTimeToTime($row['Duracion']);

        return new Falla([

            'Equipo' => $row['Equipo'],
            'Fecha_Inicio' => $fechaInicio,
            'Hora_Inicio' => $horaInicio,
            'Fecha_Final' => $fechaFinal,
            'Hora_Final' => $horaFinal,
            'Duracion' => $duracion,
            'Duracion_Excel' => $row['Duracion Excel'],
            'Codigo' => $row['Codigo'],
            'Categoria' => $row['Categoria'],
            'Descripcion' => $row['Descripcion'],
            'Comentario' => $row['Comentario'],
            'Caidas' => $row['Caidas'],
            'Tipo_Mant' => $row['Tipo Mant.'],
            'Sistema' => $row['Sistema'],
            'Sub_Sistem' => $row['Sub Sistem.'],
            'Componentes' => $row['Componentes'],
            'Componente' => $row['Componente'],
            'Horas' => $row['Horas'],
            'Mes' => $row['Mes'],
            'Motor' => $row['Motor'],
            'Flota' => $row['Flota'],
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

    // Función para transformar fecha de Excel (serial) a formato unix timestamp
    private function excelSerialDateToUnixTimestamp($serialDate)
    {
        $unixTimestamp = ($serialDate - 25569) * 86400; // Ajustar el número serial y convertir a segundos
        return date('Y-m-d', $unixTimestamp);
    }

    // Función para transformar hora decimal a formato H:i:s
    private function excelDecimalTimeToTime($decimalTime)
    {
        if (!is_numeric($decimalTime)) {
            return null; // Retorna null si el valor no es numérico
        }

        $hours = floor($decimalTime * 24);
        $minutes = round(($decimalTime * 24 - $hours) * 60);
        $seconds = 0;

        if ($minutes == 60) {
            $hours += 1;
            $minutes = 0;
        }

        $hour = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $minute = str_pad($minutes, 2, '0', STR_PAD_LEFT);

        return "{$hour}:{$minute}:{$seconds}";
    }
}

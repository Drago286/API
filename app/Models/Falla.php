<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Falla extends Model
{
    use HasFactory;

    protected $fillable = [
        'Equipo',
        'Fecha_Inicio',
        'Hora_Inicio',
        'Fecha_Final',
        'Hora_Final',
        'Duracion',
        'Duracion_Excel',
        'Codigo',
        'Categoria',
        'Descripcion',
        'Comentario',
        'Caidas',
        'Tipo_Mant',
        'Sistema',
        'Sub_Sistem',
        'Componentes',
        'Componente',
        'Horas',
        'Mes',
        'Motor',
        'Flota',
    ];
}

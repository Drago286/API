<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    use HasFactory;

    protected $fillable = [
        'Codigo',
        'Descripcion_del_Evento',
        'Limitaciones_del_evento',
        'Deteccion_de_la_informacion',
        'Guia_para_la_Deteccion_de_Fallas',
        'Equipo',
    ];
}

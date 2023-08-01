<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;

    protected $fillable = [
        'Equipo',
        'Nombre',
        'Sistema',
        'UM',
        'Stock',
        'En_linea'
    ];
}

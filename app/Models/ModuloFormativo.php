<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuloFormativo extends Model
{
    protected $fillable = [
        'ciclo_formativo_id',
        'nombre',
        'codigo',
        'horas_totales',
        'curso_escolar',
        'centro',
        'docente_id',
        'descripcion',
    ];
}

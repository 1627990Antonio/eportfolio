<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuloFormativo extends Model
{
    use HasFactory;
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'docente_id');
    }
    
    protected $table = 'modulos_formativos';

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

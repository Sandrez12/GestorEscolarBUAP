<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GrupoEstudiante extends Pivot
{
    protected $table = 'grupo_estudiantes';

    protected $fillable = [
        'grupo_id',
        'estudiante_id',
    ];

    public $timestamps = true;
}

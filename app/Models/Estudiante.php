<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'nombre',
        'email',
        'codigo_estudiante',
    ];

    public function grupos()
    {
        return $this->belongsToMany(
            Grupo::class,
            'grupo_estudiantes',
            'estudiante_id',
            'grupo_id'
        )->withTimestamps();
    }
}

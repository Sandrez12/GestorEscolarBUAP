<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $fillable = [];

    public function estudiantes()
    {
        return $this->belongsToMany(
            Estudiante::class,
            'grupo_estudiantes',
            'grupo_id',
            'estudiante_id'
        )->withTimestamps();
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}

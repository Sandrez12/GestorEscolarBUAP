<?php

namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EstudiantesImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;

    public function model(array $row)
    {
        // Ignorar filas vacías
        if (empty($row['nombre']) && empty($row['email']) && empty($row['codigo_estudiante'])) {
            return null;
        }

        $existe = Estudiante::where('email', $row['email'])
                            ->orWhere('codigo_estudiante', $row['codigo_estudiante'])
                            ->first();
        if ($existe) return null;

        return new Estudiante([
            'nombre'            => $row['nombre'],
            'email'             => $row['email'],
            'codigo_estudiante' => (string) $row['codigo_estudiante'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nombre'            => ['nullable', 'string', 'max:255'],
            '*.email'             => ['nullable', 'email', 'max:255'],
            '*.codigo_estudiante' => ['nullable'],
        ];
    }

    public function batchSize(): int { return 100; }
    public function chunkSize(): int { return 200; }
}
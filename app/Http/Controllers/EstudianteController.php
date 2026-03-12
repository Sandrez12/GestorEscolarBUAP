<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Imports\EstudiantesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::latest()->paginate(15);
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function showImport()
    {
        return view('estudiantes.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'archivo' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ], [
            'archivo.required' => 'Debes seleccionar un archivo.',
            'archivo.mimes'    => 'El archivo debe ser .xlsx, .xls o .csv.',
            'archivo.max'      => 'El archivo no debe superar los 5MB.',
        ]);

        try {
            $import = new EstudiantesImport();
            Excel::import($import, $request->file('archivo'));

            $errores = $import->errors();

            if ($errores->count() > 0) {
                $mensajes = $errores->map(fn($e) => $e->getMessage())->toArray();
                return redirect()->route('estudiantes.import')
                    ->with('warning', 'Importación completada con algunos errores.')
                    ->with('errores', $mensajes);
            }

            return redirect()->route('estudiantes.index')
                ->with('success', 'Estudiantes importados correctamente.');

        } catch (\Exception $e) {
            return redirect()->route('estudiantes.import')
                ->with('error', 'Error al procesar el archivo: ' . $e->getMessage());
        }
    }

    public function show(Estudiante $estudiante)
    {
        $estudiante->load('grupos');
        return view('estudiantes.show', compact('estudiante'));
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }
}

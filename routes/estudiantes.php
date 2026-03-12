<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;

Route::prefix('estudiantes')->name('estudiantes.')->withoutMiddleware(['auth'])->group(function () {
    Route::get('/', [EstudianteController::class, 'index'])->name('index');
    Route::get('/importar', [EstudianteController::class, 'showImport'])->name('import');
    Route::post('/importar', [EstudianteController::class, 'import'])->name('import.store');
    Route::get('/{estudiante}', [EstudianteController::class, 'show'])->name('show');
    Route::delete('/{estudiante}', [EstudianteController::class, 'destroy'])->name('destroy');
});
@extends('layouts.estudiantes')

@section('title', 'Estudiantes')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">
                <i class="bi bi-mortarboard-fill text-primary me-2"></i>Estudiantes
            </h2>
            <small class="text-muted">Total: {{ $estudiantes->total() }} registros</small>
        </div>
        <a href="{{ route('estudiantes.import') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-arrow-up me-1"></i> Importar Excel / CSV
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if($estudiantes->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    No hay estudiantes registrados aún.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Código</th>
                                <th>Registrado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantes as $estudiante)
                            <tr>
                                <td class="text-muted small">{{ $estudiante->id }}</td>
                                <td class="fw-semibold">{{ $estudiante->nombre }}</td>
                                <td>{{ $estudiante->email }}</td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-normal px-2">
                                        {{ $estudiante->codigo_estudiante }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $estudiante->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('estudiantes.show', $estudiante) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('estudiantes.destroy', $estudiante) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Eliminar a {{ $estudiante->nombre }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-3 py-2">
                    {{ $estudiantes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
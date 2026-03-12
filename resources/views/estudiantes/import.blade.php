@extends('layouts.estudiantes')

@section('title', 'Importar Estudiantes')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show">
                    <strong>{{ session('warning') }}</strong>
                    @if(session('errores'))
                        <ul class="mt-2 mb-0 small">
                            @foreach(session('errores') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('estudiantes.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div>
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-file-earmark-arrow-up text-success me-2"></i>
                                Importar Estudiantes
                            </h5>
                            <small class="text-muted">Carga masiva desde archivo Excel o CSV</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="alert alert-info d-flex gap-3 align-items-start mb-4">
                        <i class="bi bi-info-circle-fill fs-5 mt-1 flex-shrink-0"></i>
                        <div class="small">
                            <strong>Columnas requeridas en la primera fila:</strong>
                            <ul class="mb-1 mt-1">
                                <li><code>nombre</code></li>
                                <li><code>email</code></li>
                                <li><code>codigo_estudiante</code></li>
                            </ul>
                            <p class="mb-0">Formatos: <strong>.xlsx</strong>, <strong>.xls</strong>, <strong>.csv</strong> (máx. 5MB)</p>
                        </div>
                    </div>

                    <form action="{{ route('estudiantes.import.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="archivo" class="form-label fw-semibold">
                                Seleccionar archivo <span class="text-danger">*</span>
                            </label>
                            <div id="dropZone"
                                 class="border border-2 border-dashed rounded-3 p-5 text-center text-muted"
                                 style="cursor:pointer;"
                                 onclick="document.getElementById('archivo').click()">
                                <i class="bi bi-cloud-upload fs-2 d-block mb-2 text-success"></i>
                                <span id="dropLabel">Arrastra tu archivo aquí o <u>haz clic para buscar</u></span>
                            </div>
                            <input type="file" id="archivo" name="archivo"
                                   accept=".xlsx,.xls,.csv"
                                   class="d-none @error('archivo') is-invalid @enderror"
                                   onchange="mostrarNombreArchivo(this)">
                            @error('archivo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-end">
                            <a href="{{ route('estudiantes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-upload me-1"></i> Importar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3 border-0 bg-light">
                <div class="card-body py-3 px-4">
                    <p class="small mb-2 fw-semibold"><i class="bi bi-table me-1"></i> Ejemplo de estructura:</p>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered bg-white mb-0 small">
                            <thead class="table-success">
                                <tr>
                                    <th>nombre</th>
                                    <th>email</th>
                                    <th>codigo_estudiante</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ana García López</td>
                                    <td>ana.garcia@correo.buap.mx</td>
                                    <td>202312345</td>
                                </tr>
                                <tr>
                                    <td>Luis Ramírez Torres</td>
                                    <td>luis.ramirez@correo.buap.mx</td>
                                    <td>202312346</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function mostrarNombreArchivo(input) {
    const label = document.getElementById('dropLabel');
    const zone  = document.getElementById('dropZone');
    if (input.files.length > 0) {
        label.innerHTML = '<strong>' + input.files[0].name + '</strong> seleccionado ✔';
        zone.classList.add('bg-success-subtle');
    }
}
const zone = document.getElementById('dropZone');
zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('bg-light'); });
zone.addEventListener('dragleave', () => zone.classList.remove('bg-light'));
zone.addEventListener('drop', e => {
    e.preventDefault();
    zone.classList.remove('bg-light');
    const file = e.dataTransfer.files[0];
    if (file) {
        const input = document.getElementById('archivo');
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        mostrarNombreArchivo(input);
    }
});
</script>
@endsection
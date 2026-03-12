<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestión de Estudiantes') — {{ config('app.name') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8fafc; }
        .navbar-brand { font-weight: 700; letter-spacing: -0.5px; }
        .table th { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="{{ route('estudiantes.index') }}">
            <i class="bi bi-mortarboard-fill me-2"></i>GestorEscolar BUAP
        </a>
        <div class="ms-auto">
            <a href="{{ route('estudiantes.index') }}" class="btn btn-sm btn-outline-light me-2">
                <i class="bi bi-people me-1"></i> Estudiantes
            </a>
            <a href="{{ route('estudiantes.import') }}" class="btn btn-sm btn-success">
                <i class="bi bi-upload me-1"></i> Importar
            </a>
        </div>
    </nav>

    {{-- Contenido --}}
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

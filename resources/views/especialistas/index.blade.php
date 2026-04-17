<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Especialistas | Equipo 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .img-thumbnail { width: 60px; height: 60px; object-fit: cover; }
    </style>
</head>
<body>

<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="text-center mb-4 text-primary">Gestión de Especialistas - Equipo 6</h2>

    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title mb-3 text-secondary">Registrar Nuevo Especialista</h5>
            <form action="{{ route('especialistas.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label class="form-label fw-bold">Asignar a Usuario:</label>
                    <select name="id_usuario" class="form-select" required>
                        <option value="">Seleccione un usuario...</option>
                        @foreach($usuarios as $u)
                            <option value="{{ $u->id_usuario }}">{{ $u->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Especialidad:</label>
                    <input type="text" name="especialidad" class="form-control" placeholder="Ej. Cardiología" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Consultorio:</label>
                    <input type="text" name="consultorio" class="form-control" placeholder="Ej. B-201" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Imagen (URL):</label>
                    <input type="text" name="imagen_url" class="form-control" placeholder="Link de la foto" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Agregar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3 text-secondary">Listado de Especialistas</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Especialidad</th>
                            <th>Consultorio</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($especialistas as $e)
                        <tr>
                            <td>
                                <img src="{{ $e->imagen_url }}" class="img-thumbnail rounded-circle" alt="Foto">
                            </td>
                            <td class="fw-bold">{{ $e->usuario->nombre }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $e->especialidad }}</span>
                            </td>
                            <td>{{ $e->consultorio }}</td>
                            <td class="text-center">
                                <form action="{{ route('especialistas.destroy', $e->id_especialista) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
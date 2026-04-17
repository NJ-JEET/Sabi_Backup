@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Gestión de Usuarios</h2>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success">Registrar Nuevo Usuario</a>
    </div>

    <div class="card shadow-sm border-primary">
        <div class="card-header bg-white">
            <h5 class="mb-0">Listado del Sistema</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $user)
                        <tr>
                            <td>{{ $user->id_usuario }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->correo }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $user->rol }}</span>
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('usuarios.edit', $user->id_usuario) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('usuarios.destroy', $user->id_usuario) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $user->nombre }}? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Volver al Panel</a>
    </div>

</div>
@endsection
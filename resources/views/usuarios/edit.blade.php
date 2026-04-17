@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-warning">
                <div class="card-header bg-warning text-dark fw-bold">
                    <h5 class="mb-0">Editar Usuario: {{ $usuario->nombre }}</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label fw-bold">Nombre Completo</label>
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" value="{{ old('correo', $usuario->correo) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nueva Contraseña (Opcional)</label>
                            <input type="password" class="form-control" name="contraseña" placeholder="Déjalo en blanco para no cambiarla">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Rol en el Sistema</label>
                            <select class="form-select" name="rol" required>
                                <option value="Administrador" {{ $usuario->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="Especialista" {{ $usuario->rol == 'Especialista' ? 'selected' : '' }}>Especialista</option>
                                <option value="Paciente" {{ $usuario->rol == 'Paciente' ? 'selected' : '' }}>Paciente</option>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Actualizar Datos</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
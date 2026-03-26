@extends('layouts.app') @section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-primary">Panel de Control: {{ $user->nombre }}</h2>
            <span class="badge bg-secondary">Rol: {{ $user->rol }}</span>
        </div>
    </div>

    <div class="row g-4">
        @if($user->rol == 'ADMIN')
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Usuarios</h5>
                        <p class="card-text">Crear, editar, consultar y borrar cuentas de acceso.</p>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Administrar Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Especialistas</h5>
                        <p class="card-text">Administrar el catálogo completo de médicos y consultorios.</p>
                        <a href="{{ route('especialistas.index') }}" class="btn btn-primary">Administrar Catálogo</a>
                    </div>
                </div>
            </div>
        @endif

        @if($user->rol == 'ESPECIALISTA' || $user->rol == 'ADMIN')
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-info">
                    <div class="card-body">
                        <h5 class="card-title">Mis Citas Médicas</h5>
                        <p class="card-text">Consultar la lista de pacientes y pedidos de consulta.</p>
                        <a href="#" class="btn btn-info">Ver Pedidos</a>
                    </div>
                </div>
            </div>
        @endif

        @if($user->rol == 'CLIENTE')
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-body">
                        <h5 class="card-title">Agendar Cita</h5>
                        <p class="card-text">Crea o modifica tus solicitudes de consulta médica.</p>
                        <a href="#" class="btn btn-success">Nuevo Pedido</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
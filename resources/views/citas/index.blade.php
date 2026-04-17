@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Gestión de Citas Médicas</h2>
        @if(auth()->user()->rol == 'Paciente')
            <a href="{{ route('citas.create') }}" class="btn btn-success">Agendar Nueva Cita</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-info">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Historial de Solicitudes</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha y Hora</th>
                            @if(auth()->user()->rol != 'Paciente')
                                <th>Paciente</th>
                            @endif
                            <th>Especialista</th>
                            <th>Consultorio</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citas as $c)
                        <tr>
                            <td>
                                <strong>{{ $c->fecha }}</strong><br>
                                <small class="text-muted">{{ $c->hora }}</small>
                            </td>
                            @if(auth()->user()->rol != 'Paciente')
                                <td>{{ $c->paciente->nombre ?? 'Paciente no encontrado' }}</td>
                            @endif
                            <td>{{ $c->especialista?->usuario?->nombre ?? 'Sin médico asignado' }}</td>
                            <td>{{ $c->especialista?->consultorio ?? 'N/A' }}</td>
                            <td>{{ Str::limit($c->motivo, 30) }}</td>
                            <td>
                                <span class="badge {{ $c->estado == 'Pendiente' ? 'bg-warning text-dark' : 'bg-success' }}">
                                    {{ $c->estado }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('citas.edit', $c->id_cita) }}" class="btn btn-sm btn-warning fw-bold">Modificar</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No hay citas registradas en este momento.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3 text-center">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Volver al Dashboard</a>
    </div>
</div>
@endsection
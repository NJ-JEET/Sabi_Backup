@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-warning">
                <div class="card-header bg-warning text-dark fw-bold">
                    <h5 class="mb-0">Modificar Cita Médica</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('citas.update', $cita->id_cita) }}">
                        @csrf
                        @method('PUT')
                        
                        {{-- BLOQUE ÚNICO DE ERRORES: Limpio y profesional --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cambiar Especialista:</label>
                            <select name="id_especialista" class="form-select" required>
                                @foreach($especialistas as $e)
                                    <option value="{{ $e->id_especialista }}" {{ $cita->id_especialista == $e->id_especialista ? 'selected' : '' }}>
                                        {{ $e->usuario->nombre }} ({{ $e->especialidad }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nueva Fecha:</label>
                                <input type="date" name="fecha" class="form-control" value="{{ $cita->fecha }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nueva Hora:</label>
                                <input type="time" name="hora" class="form-control" value="{{ $cita->hora }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Motivo de la Consulta:</label>
                            <textarea name="motivo" class="form-control" rows="3" required>{{ $cita->motivo }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
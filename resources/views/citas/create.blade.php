@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Agendar Nueva Cita Médica</h5>
                </div>
                <div class="card-body p-4">
                    {{-- Bloque de Errores --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('citas.store') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Seleccione Especialista:</label>
                                <select name="id_especialista" class="form-select" required>
                                    <option value="" disabled {{ old('id_especialista') ? '' : 'selected' }}>-- Elija un médico --</option>
                                    @foreach($especialistas as $e)
                                        <option value="{{ $e->id_especialista }}" {{ old('id_especialista') == $e->id_especialista ? 'selected' : '' }}>
                                            {{ $e->usuario->nombre }} ({{ $e->especialidad }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha de la Cita:</label>
                                <input type="date" name="fecha" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('fecha') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Hora:</label>
                                <input type="time" name="hora" class="form-control" value="{{ old('hora') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Motivo de la Consulta:</label>
                            <textarea name="motivo" class="form-control" rows="3" placeholder="Describa brevemente sus síntomas..." required>{{ old('motivo') }}</textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Confirmar Agendamiento</button>
                            <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="card mx-auto shadow-sm text-center" style="max-width: 400px; border-radius: 12px;">
        <div class="card-body py-5">
            {{-- Icono de Éxito --}}
            <div class="mb-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            </div>
            
            <h2 class="fw-bold text-dark">¡Todo listo!</h2>
            <p class="text-secondary">Tu contraseña ha sido actualizada correctamente. Hemos enviado una confirmación a tu correo.</p>
            
            {{-- Botón Único de Acción --}}
            <div class="d-grid gap-2 mt-4">
                <a href="{{ route('login') }}" class="btn btn-success fw-bold py-2">Regresar al Inicio de Sesión</a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="card mx-auto shadow-sm" style="max-width: 400px; border-radius: 12px;">
        <div class="card-header bg-success text-white text-center fw-bold">Cambiar Contraseña</div>
        <div class="card-body">
            
            {{-- Mensaje de confirmación de envío --}}
            @if (session('reset_email'))
                <div class="alert alert-success border-0 shadow-sm mb-4 text-center" style="background-color: #d1e7dd; color: #0f5132;">
                    <i class="bi bi-envelope-check-fill me-2"></i>
                    Código de verificación enviado a: <br>
                    <strong>{{ session('reset_email') }}</strong>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                {{-- Campo: Código --}}
                <div class="mb-3">
                    <label class="form-label text-secondary fw-medium">Código enviado al correo</label>
                    <input type="text" name="codigo" class="form-control" placeholder="Ej: 1234" required style="border-radius: 8px;">
                </div>

                {{-- Campo: Nueva Contraseña SEAMLESS --}}
                <div class="mb-3">
                    <label class="form-label text-secondary fw-medium">Nueva Contraseña</label>
                    <div class="input-group border rounded @error('password') border-danger @enderror" style="border-color: #ced4da; overflow: hidden; border-radius: 8px !important;">
                        <input type="password" name="password" id="password" class="form-control border-0 bg-white" required style="box-shadow: none;">
                        <button class="btn bg-white border-0 text-muted px-3" type="button" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye-slash-fill"></i> 
                        </button>
                    </div>
                    @error('password')     
                    <div class="text-danger small mt-1 d-block">{{ $message }}</div>
                    @enderror               
                </div>

                {{-- Campo: Confirmar Contraseña SEAMLESS --}}
                <div class="mb-3">
                    <label class="form-label text-secondary fw-medium">Confirmar Contraseña</label>
                    <div class="input-group border rounded" style="border-color: #ced4da; overflow: hidden; border-radius: 8px !important;">
                        <input type="password" name="password_confirmation" id="password_confirm" class="form-control border-0 bg-white" required style="box-shadow: none;">
                        <button class="btn bg-white border-0 text-muted px-3" type="button" onclick="togglePassword('password_confirm', this)">
                            <i class="bi bi-eye-slash-fill"></i> 
                        </button>
                    </div>
                    <div id="password-error" class="text-danger small mt-1" style="display: none;">
                        <i class="bi bi-exclamation-circle-fill"></i> Las contraseñas no coinciden.
                    </div>    
                </div>

                <button type="submit" id="btn-submit" class="btn btn-success w-100 fw-bold py-2 mt-2" style="border-radius: 8px;">Actualizar Contraseña</button>
            </form>
        </div>
    </div>
</div>

{{-- Mantén el mismo script de JS, funciona perfecto con esta estructura --}}
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
        } else {
            input.type = "password";
            icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
        }
    }

    const password = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirm');
    const errorMsg = document.getElementById('password-error');
    const btnSubmit = document.getElementById('btn-submit');

    function validar() {
        // Obtenemos el contenedor 'input-group' del campo de confirmación para aplicar borde rojo
        const confirmGroup = confirmInput.closest('.input-group');

        if (confirmInput.value.length > 0) {
            if (password.value !== confirmInput.value) {
                errorMsg.style.display = 'block';
                confirmInput.classList.add('is-invalid');
                confirmInput.classList.remove('is-valid');
                // Aplicamos borde rojo al contenedor completo
                confirmGroup.classList.add('border-danger');
                confirmGroup.classList.remove('border-success');
                btnSubmit.disabled = true;
            } else {
                errorMsg.style.display = 'none';
                confirmInput.classList.remove('is-invalid');
                confirmInput.classList.add('is-valid');
                confirmGroup.classList.remove('border-danger');
                confirmGroup.classList.add('border-success');
                btnSubmit.disabled = false;
            }
        } else {
            errorMsg.style.display = 'none';
            confirmInput.classList.remove('is-invalid', 'is-valid');
            confirmGroup.classList.remove('border-danger', 'border-success');
            btnSubmit.disabled = false;
        }
    }

    password.addEventListener('input', validar);
    confirmInput.addEventListener('input', validar);
</script>
@endsection
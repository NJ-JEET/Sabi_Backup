@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Iniciar Sesión</h4>
                </div>
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first('correo') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf 
                        <div class="mb-3">
                            <label for="correo" class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}" placeholder="ejemplo@gestionmedica.com" required autofocus>
                        </div>
                        
                        <div class="mb-4">
                            <label for="contraseña" class="form-label fw-bold">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="********" required>
                        </div>
                        
                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-primary btn-lg">Entrar al Sistema</button>
                        </div>
                        <div class="text-center mt-4 pt-2 border-t border-gray-100">
                            <p class="text-sm text-gray-600">
                                ¿Eres nuevo en Sabi? 
                                <a href="{{ route('register') }}" class="text-indigo-600 fw-bold text-decoration-none hover:underline">
                                    Crea tu cuenta médica aquí
                                </a>
                            </p>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-primary text-decoration-none fw-bold">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
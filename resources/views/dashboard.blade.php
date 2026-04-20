@extends('layouts.app') 

@section('content')
<div class="container py-5">

    @auth
        {{-- Encabezado con Badge Moderno --}}
        <div class="row mb-5">
            <div class="col">
                <h2 class="text-indigo-600 fw-bold display-6">Panel de Control: {{ $user->nombre }}</h2>
                
                <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold shadow-sm mt-2 
                    {{ $user->rol == 'Administrador' ? 'bg-purple-600 text-white' : 
                       ($user->rol == 'Especialista' ? 'bg-blue-500 text-white' : 'bg-emerald-500 text-white') }}">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    {{ strtoupper($user->rol) }}
                </span>
            </div>
        </div>

        <div class="row g-4">
            {{-- SECCIÓN ADMINISTRADOR --}}
            @if($user->rol == 'Administrador')
                <div class="col-md-4">
                    <div class="max-w-sm rounded-xl overflow-hidden shadow-md bg-white border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-100 flex flex-col">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 text-indigo-600 uppercase tracking-wide">Gestión de Usuarios</div>
                            <p class="text-gray-600 text-sm">Crear, editar, consultar y borrar cuentas de acceso administrativo.</p>
                        </div>
                        <div class="px-6 pb-4 mt-auto">
                            <a href="{{ route('usuarios.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200 no-underline">
                                Administrar Usuarios
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="max-w-sm rounded-xl overflow-hidden shadow-md bg-white border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-100 flex flex-col">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 text-indigo-600 uppercase tracking-wide">Gestión Especialistas</div>
                            <p class="text-gray-600 text-sm">Administrar el catálogo completo de médicos y consultorios de Sabi.</p>
                        </div>
                        <div class="px-6 pb-4 mt-auto">
                            <a href="{{ route('especialistas.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200 no-underline">
                                Administrar Catálogo
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- SECCIÓN ESPECIALISTA / ADMIN --}}
            @if($user->rol == 'Especialista' || $user->rol == 'Administrador')
                <div class="col-md-4">
                    <div class="max-w-sm rounded-xl overflow-hidden shadow-md bg-white border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-100 flex flex-col">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 text-cyan-600 uppercase tracking-wide">Mis Citas Médicas</div>
                            <p class="text-gray-600 text-sm">Consultar la lista de pacientes y pedidos de consulta asignados.</p>
                        </div>
                        <div class="px-6 pb-4 mt-auto">
                            <a href="{{ route('citas.index') }}" class="inline-block bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200 no-underline">
                                Ver Pedidos
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- SECCIÓN PACIENTE --}}
            @if($user->rol == 'Paciente')
                <div class="col-md-4">
                    <div class="max-w-sm rounded-xl overflow-hidden shadow-md bg-white border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-100 flex flex-col">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 text-emerald-600 uppercase tracking-wide">Agendar Cita</div>
                            <p class="text-gray-600 text-sm">Crea o modifica tus solicitudes de consulta médica rápidamente.</p>
                        </div>
                        <div class="px-6 pb-4 mt-auto">
                            <a href="{{ route('citas.create') }}" class="inline-block bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200 no-underline">
                                Nuevo Pedido
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endauth

    @guest
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 text-center">
                <div class="bg-white rounded-xl shadow-lg p-5 border-t-4 border-red-500">
                    <h4 class="text-red-600 font-bold mb-3">¡Sesión no encontrada!</h4>
                    <p class="text-gray-600 mb-4">Parece que tu sesión expiró o Laravel te desconectó por seguridad.</p>
                    <a href="/login-test" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded-lg transition-colors no-underline">
                        Volver a Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    @endguest

</div>
@endsection
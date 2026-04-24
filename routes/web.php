<?php

use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

// --- 1. RUTAS PÚBLICAS Y DE LOGIN ---
Route::get('/', [ClinicaController::class, 'index']);
Route::get('/contacto', [ClinicaController::class, 'contact'])->name('contacto');

// Pantalla de Login (Afuera del candado para que todos puedan verla)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/olvide-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/olvide-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/restablecer-password', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/actualizar-password', [AuthController::class, 'updatePassword'])->name('password.update');

// RUTAS DE REGISTRO
Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registro', [RegisterController::class, 'register'])->name('register.post');

// --- RUTAS PROTEGIDAS ---
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('citas', CitaController::class);

    // AQUÍ ESTÁ EL CAMBIO:
    // Creamos un grupo donde AMBOS (Admin y Especialista) pueden entrar
    Route::group(['middleware' => ['role:Administrador,Especialista']], function () {
        // El catálogo que el Especialista puede gestionar
        Route::resource('especialistas', EspecialistaController::class);
        
        // La vista de usuarios (El Especialista solo debe consultar, el Admin todo)
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    });

    // Este grupo se queda SOLO para el Administrador (para crear/borrar usuarios)
    Route::group(['middleware' => ['role:Administrador']], function () {
        Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    });


/*     Route::get('/probar-correo', function () {
        Mail::raw('¡Conexión SMTP con Outlook exitosa!', function ($message) {
            $message->to('un-correo-que-puedas-revisar@gmail.com')
                    ->subject('Prueba de Sistema Médico');
        });
        return "El correo ha sido enviado. ¡Punto 3 completado!";
    }); */
});
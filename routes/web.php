<?php

use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Ruta principal que carga el index
Route::get('/', [ClinicaController::class, 'index']);

// Ruta de contacto con nombre para que el botón funcione
Route::get('/contacto', [ClinicaController::class, 'contact'])->name('contacto');

// Solo el Admin entra aquí
Route::group(['middleware' => ['role:ADMIN']], function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('especialistas', EspecialistaController::class);
});

// Admin y Especialista pueden ver esto
Route::group(['middleware' => ['role:ADMIN,ESPECIALISTA']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
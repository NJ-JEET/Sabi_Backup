<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 1. IMPORTANTE: Dile a Laravel que use la tabla 'usuarios'
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    /**
     * Los campos que se pueden llenar (Deben coincidir con tu Seeder)
     */
    protected $fillable = [
        'nombre', 
        'rol', 
        'correo',      // Antes era 'email'
        'contraseña'   // Antes era 'password'
    ];

    /**
     * Ocultar la contraseña al convertir a JSON
     */
    protected $hidden = [
        'contraseña',   // Antes era 'password'
        'remember_token',
    ];

    /**
     * 2. IMPORTANTE: Dile a Laravel que el campo de la clave no se llama password
     */
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
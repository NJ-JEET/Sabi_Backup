<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre', 
        'rol', 
        'correo',    
        'password', // Ahora que se llama así en la BD
        'country_code',   
        'phone_prefix',   
        'telefono',       
        'idioma',         
        'zona_horaria',   
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * IMPORTANTE: Laravel por defecto busca la columna 'email'.
     * Con esto le decimos que nuestro identificador es 'correo'.
     */
    public function username()
    {
        return 'correo';
    }
}
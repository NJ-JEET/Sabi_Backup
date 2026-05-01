<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'rol' => 'Paciente', 
            'correo' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'), // CORREGIDO: De 'contraseña' a 'password'
            'remember_token' => Str::random(10),    // Añadido para la persistencia de sesión
            
            // Campos de localización para Sabi
            'country_code' => 'MX',
            'phone_prefix' => '+52',
            'telefono' => $this->faker->phoneNumber(),
            'idioma' => 'es',
            'zona_horaria' => 'America/Mexico_City',
        ];
    }
}
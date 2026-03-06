<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'rol' => 'Paciente', // Valor base
            'correo' => $this->faker->unique()->safeEmail(),
            'contraseña' => Hash::make('password123'),
        ];
    }
}

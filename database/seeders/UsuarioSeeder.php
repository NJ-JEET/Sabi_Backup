<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Registro 1: Administrador
        Usuario::create([
            'nombre' => 'Paulina Vazquez',
            'rol' => 'Administrador',
            'correo' => 'paulina.vaz@gestionmedica.com',
            'contraseña' => Hash::make('pAU23li8n2'),
        ]);

        // Registro 2: Especialista
        Usuario::create([
            'nombre' => 'Jocelyn Lomeli',
            'rol' => 'Especialista',
            'correo' => 'joce.Lo@gestionmedica.com',
            'contraseña' => Hash::make('fisio123'),
        ]);

        // Registro 3: Paciente
        Usuario::create([
            'nombre' => 'Laura Garcia',
            'rol' => 'Paciente',
            'correo' => 'laura.garcia@gmail.com',
            'contraseña' => Hash::make('lau32344ra'),
        ]);
    }
}
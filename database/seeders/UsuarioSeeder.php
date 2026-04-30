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
            'password' => Hash::make('pAU23li8n2'),
            'country_code' => 'MX',
            'phone_prefix' => '+52',
            'telefono' => '3312345678',
            'idioma' => 'es',
            'zona_horaria' => 'America/Mexico_City',
                 
        ]);

        // Registro 2: Especialista
        Usuario::create([
            'nombre' => 'Jocelyn Lomeli',
            'rol' => 'Especialista',
            'correo' => 'joce.Lo@gestionmedica.com',
            'password' => Hash::make('fisio123'),
            'country_code' => 'MX',
            'phone_prefix' => '+52',
            'telefono' => '3387654321',
            'idioma' => 'es',
            'zona_horaria' => 'America/Mexico_City',
        ]);

        // Registro 3: Paciente
        Usuario::create([
            'nombre' => 'Laura Garcia',
            'rol' => 'Paciente',
            'correo' => 'laura.garcia@gmail.com',
            'password' => Hash::make('lau32344ra'),
            'country_code' => 'MX',
            'phone_prefix' => '+52',
            'telefono' => '3300001122',
            'idioma' => 'es',
            'zona_horaria' => 'America/Mexico_City',
        ]);
    }
}
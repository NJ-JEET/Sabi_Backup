<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
        public function run()
    {
        // 1. Primero cargamos los 3 usuarios manuales (los de Paulina, Jocelyn y Laura)
        $this->call(UsuarioSeeder::class);

        // 2. Agregamos los 50 clientes (pacientes) usando el factory
        \App\Models\Usuario::factory(50)->create([
            'rol' => 'Paciente'
        ]);

        // 3. Agregamos los 5 usuarios administradores usando el mismo factory
        \App\Models\Usuario::factory(5)->create([
            'rol' => 'Administrador'
        ]);
    }
}

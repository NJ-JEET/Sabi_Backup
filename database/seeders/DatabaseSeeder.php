<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Usuarios manuales (Paulina, Jocelyn, Laura)
        // Esto crea los registros en la tabla 'usuarios'
        $this->call(UsuarioSeeder::class);
        
        // Esto crea los registros en la tabla 'especialistas' para Jocelyn (id 2)
        $this->call(EspecialidadSeeder::class);

        // 2. Crear perfiles para los usuarios manuales restantes
        // Perfil para Paulina (Admin) - ID 1
        \App\Models\Administrador::create([
            'id_usuario' => 1,
            'nivel_acceso' => 'SuperAdmin',
            'fecha_asig' => now(),
            'departamento' => 'Sistemas'
        ]);

        // Perfil para Laura (Paciente) - ID 3
        \App\Models\Paciente::create([
            'id_usuario' => 3,
            'fecha_registro' => now(),
            'historial' => 'Paciente inicial del sistema.'
        ]);

        // 3. Generar 5 Administradores aleatorios con su Perfil
        // Primero el Usuario (Padre), luego el Administrador (Hijo)
        $admins = \App\Models\Usuario::factory(5)->create(['rol' => 'Administrador']);
        foreach ($admins as $u) {
            \App\Models\Administrador::create([
                'id_usuario' => $u->id_usuario,
                'nivel_acceso' => 'Moderador',
                'fecha_asig' => now(),
                'departamento' => 'General'
            ]);
        }

        // 4. Generar 50 Pacientes aleatorios con su Perfil
        // Primero el Usuario (Padre), luego el Paciente (Hijo)
        $pacientes = \App\Models\Usuario::factory(50)->create(['rol' => 'Paciente']);
        foreach ($pacientes as $u) {
            \App\Models\Paciente::create([
                'id_usuario' => $u->id_usuario,
                'fecha_registro' => now(),
                'historial' => 'Historial generado por Factory.'
            ]);
        }
    }
}
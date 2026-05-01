<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Administrador;
use Illuminate\Database\Seeder;

class RolRelacionSeeder extends Seeder
{
    public function run()
    {
        // 1. Buscamos usuarios con rol 'Paciente' que NO tengan registro en la tabla pacientes
        $usuariosPacientes = Usuario::where('rol', 'Paciente')
            ->whereDoesntHave('paciente')
            ->get();

        foreach ($usuariosPacientes as $u) {
            Paciente::create([
                'id_usuario' => $u->id_usuario,
                'fecha_registro' => now(),
                'historial' => 'Paciente nuevo registrado en el sistema Sabi.', //
            ]);
        }

        // 2. Buscamos usuarios con rol 'Administrador' que NO tengan registro en administradores
        $usuariosAdmins = Usuario::where('rol', 'Administrador')
            ->whereDoesntHave('administrador')
            ->get();

        foreach ($usuariosAdmins as $u) {
            Administrador::create([
                'id_usuario' => $u->id_usuario,
                'nivel_acceso' => 'General',
            ]);
        }
    }
}
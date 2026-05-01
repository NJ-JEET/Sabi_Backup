<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <--- ¡ESTA ES LA LÍNEA QUE FALTA!

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialistas')->insert([
            [
                'especialidad' => 'Pediatría', 
                'consultorio' => 'Consultorio 1', 
                'imagen_url' => 'https://ui-avatars.com/api/?name=Jocelyn+Lomeli', // Cambiado de cedula_prof
                'id_usuario' => 2
            ],
            [
                'especialidad' => 'Cardiología', 
                'consultorio' => 'Consultorio 2', 
                'imagen_url' => 'https://ui-avatars.com/api/?name=Jocelyn+Lomeli', 
                'id_usuario' => 2
            ],
            [
                'especialidad' => 'Nutrición', 
                'consultorio' => 'Consultorio 3', 
                'imagen_url' => 'https://ui-avatars.com/api/?name=Jocelyn+Lomeli', 
                'id_usuario' => 2
            ],
        ]);
    }
}
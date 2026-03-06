<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        ['especialidad' => 'Pediatría', 'consultorio' => 'Consultorio 1', 'cedula_prof' => '12345', 'id_usuario' => 2],
        ['especialidad' => 'Cardiología', 'consultorio' => 'Consultorio 2', 'cedula_prof' => '67890', 'id_usuario' => 2],
        ['especialidad' => 'Nutrición', 'consultorio' => 'Consultorio 3', 'cedula_prof' => '11223', 'id_usuario' => 2],
    ]);
}
}

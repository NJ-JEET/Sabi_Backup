<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialistas', function (Blueprint $table) {
            $table->id('id_especialista'); // PK 
            $table->string('cedula_prof');
            $table->string('especialidad');
            $table->string('consultorio');
            // Relación "Es" con Usuario 
            $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialistas');
    }
};

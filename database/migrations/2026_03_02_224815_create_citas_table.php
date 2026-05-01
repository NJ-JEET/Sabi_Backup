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
       Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita'); // PK 
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado')->default('pendiente');
            // FKs de Paciente y Especialista 
            $table->foreignId('id_paciente')->constrained('pacientes', 'id_paciente')->onDelete('cascade');
            $table->foreignId('id_especialista')->constrained('especialistas', 'id_especialista')->onDelete('cascade');
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
        Schema::dropIfExists('citas');
    }
};

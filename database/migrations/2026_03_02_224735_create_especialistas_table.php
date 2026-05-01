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
            
            $table->string('especialidad'); // Campo 2: Especialidad
            $table->string('consultorio');  // Campo 3: Consultorio
            $table->string('imagen_url')->nullable();   // URL de la imagen del especialista
            $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario')->onDelete('cascade'); // Relación
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

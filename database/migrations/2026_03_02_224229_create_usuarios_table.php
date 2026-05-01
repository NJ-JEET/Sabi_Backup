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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); //llave primaria personalizada
            $table->string('nombre');
            $table->string('rol');
            $table->string('correo')->unique();
            $table->string('password'); // Nombre estandarizado
            $table->rememberToken();    // Agrega la columna de 100 caracteres para la sesión
            
            // Campos para la API de países y localización
            $table->string('country_code', 2)->nullable();
            $table->string('phone_prefix', 10)->nullable();
            $table->string('telefono')->nullable();
            
            $table->string('idioma')->nullable();
            $table->string('zona_horaria')->nullable();
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
        Schema::dropIfExists('usuarios');
    }
};

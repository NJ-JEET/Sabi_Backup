<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('idioma')->after('telefono')->nullable();
            $table->string('zona_horaria')->after('idioma')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            table->dropColumn(['idioma', 'zona_horaria']);
        });
    }
};

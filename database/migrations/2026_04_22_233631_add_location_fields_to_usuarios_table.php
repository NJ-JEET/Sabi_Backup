<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
        {
            Schema::table('usuarios', function (Blueprint $table) {
                // Cambiamos 'email' por 'correo' para que coincida con tu base de datos actual
                $table->string('country_code', 2)->after('correo'); 
                $table->string('phone_prefix', 10)->after('country_code');
                $table->string('telefono')->after('phone_prefix');
            });
        }

        public function down()
        {
            Schema::table('usuarios', function (Blueprint $table) {
                $table->dropColumn(['country_code', 'phone_prefix', 'telefono']);
            });
        }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatosCiudadano extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DatosCiudadano', function (Blueprint $table){
            $table->bigIncrements('id_persona');
            $table->string('nombre_completo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->string('edo_civil')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->string('EntFed')->nullable();
            $table->string('municipio')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('colonia')->nullable();
            $table->string('CP')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('curp')->nullable();
            $table->string('ComSeEnt')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->biginteger('id')->unsigned();
            $table->foreign('id')->references('id')->on('users');
            $table->rememberToken();
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
        Schema::dropIfExists('DatosCiudadano');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuestoDeseado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PuestoDeseado', function (Blueprint $table){
            $table->bigIncrements('IdPuestoDeseado');
            $table->string('puesto_deseado')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('experiencia_puesto')->nullable();
            $table->string('tipo_empleo')->nullable();
            $table->string('salario_mensual')->nullable();
            $table->string('dispo_viajar')->nullable();
            $table->string('dispo_radicar_fuera')->nullable();
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
        Schema::dropIfExists('PuestoDeseado');
    }
}

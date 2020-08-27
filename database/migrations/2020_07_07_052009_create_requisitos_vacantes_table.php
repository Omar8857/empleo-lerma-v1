<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitosVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitos_vacantes', function (Blueprint $table) {
            $table->bigIncrements('id_requisitos');
            $table->string('personas_con_discapacidad')->nullable();
            $table->string('mencione_discapacidad')->nullable();
            $table->string('adultos_mayores')->nullable();
            $table->string('causa_origina_vacante')->nullable();
            $table->string('escolaridad')->nullable();
            $table->string('carrera_especialidad')->nullable();
            $table->string('situacion_academica')->nullable();
            $table->string('experiencia_MinRequerida')->nullable();
            $table->string('minima_edad')->nullable();
            $table->string('maxima_edad')->nullable();
            $table->string('idioma')->nullable();
            $table->string('computacion')->nullable();
            $table->string('sexo')->nullable();
            $table->string('disponibilidad_viajar')->nullable();
            $table->string('disponibilidad_RadicarFuera')->nullable();
            $table->string('prestaciones_ofrecidas')->nullable();
            $table->string('observaciones')->nullable();
            $table->biginteger('id_vacante')->unsigned();
            $table->foreign('id_vacante')->references('id_vacante')->on('vacantes');
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
        Schema::dropIfExists('requisitos_vacantes');
    }
}

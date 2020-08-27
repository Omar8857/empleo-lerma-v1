<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('vacantes', function (Blueprint $table) {
            $table->bigIncrements('id_vacante');
             $table->string('titulo_puesto')->nullable();
             $table->string('slug')->unique();
             $table->string('descripcion_breve')->nullable();
             $table->string('FunActi_realizar')->nullable();
             $table->string('conocimientos_requeridos')->nullable();
             $table->string('habilidades_requeridos')->nullable();
             $table->string('direccioncompleta')->nullable();
             $table->string('tipo_empleo')->nullable();
             $table->string('salario_mensual')->nullable();
             $table->string('lugar_vacante')->nullable();
             $table->string('dias_laboral')->nullable();
             $table->time('hora_entrada',0)->nullable();
             $table->time('hora_salida',0)->nullable();
             $table->string('numero_plazas')->nullable();
             $table->string('vigencia_vacante')->nullable();
             $table->biginteger('id_empresa')->unsigned();
             $table->foreign('id_empresa')->references('id_empresa')->on('datos_empresas');
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
        Schema::dropIfExists('vacantes');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PerfilLaboral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PerfilLaboral', function (Blueprint $table){
            $table->bigIncrements('id_perfil');
            $table->string('nombre_RS')->nullable();
            $table->string('titulo_puesto')->nullable();
            $table->string('funciones_actividades')->nullable();
            $table->string('salario_mensual')->nullable();
            $table->string('tipo_empleo')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_separacion')->nullable();
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
        Schema::dropIfExists('PerfilLaboral');
    }
}

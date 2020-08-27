<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->bigIncrements('id_postulacion');
            $table->biginteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->biginteger('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id_persona')->on('datosciudadano');
            $table->biginteger('id_vacante')->unsigned();
            $table->foreign('id_vacante')->references('id_vacante')->on('vacantes');
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
        Schema::dropIfExists('postulaciones');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Escolaridad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Escolaridad', function (Blueprint $table){
            $table->bigIncrements('IdEscolaridad');
            $table->string('grado_estudios')->nullable();
            $table->string('carrera_especialidad')->nullable();
            $table->string('situacion_academica')->nullable();
            $table->string('idioma')->nullable();
            $table->string('dominio')->nullable();
            $table->string('conocimientos_esp')->nullable();
            $table->string('habilidades_esp')->nullable();
            $table->string('cursos')->nullable();
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
        Schema::dropIfExists('Escolaridad');
    }
}

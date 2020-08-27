<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurriculumUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CurriculumUsers', function (Blueprint $table){
            $table-> bigIncrements('id_curriculum');
            $table->string('objetivo_prof')->nullable();
            $table->string('experiencia_prof')->nullable();
            $table->string('area_especialidad')->nullable();
            $table->string('habilidades')->nullable();
            $table->string('educacion')->nullable();
            $table->string('idiomas')->nullable();
            $table->string('cursos_y_certificaciones')->nullable();
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
        Schema::dropIfExists('CurriculumUsers');
    }
}

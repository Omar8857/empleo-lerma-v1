<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SituacionLaboral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SituacionLaboral', function (Blueprint $table){
            $table->bigIncrements('IdSituacionLab');
            $table->string('trabajo_actual')->nullable();
            $table->string('motivo')->nullable();
            $table->date('fecha_busquedaempleo')->nullable();
            $table->string('disponibilidad')->nullable();
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
        Schema::dropIfExists('SituacionLaboral');
    }
}

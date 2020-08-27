<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacionContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_contactos', function (Blueprint $table) {
            $table->bigIncrements('id_contacto');
            $table->string('nombre_contacto')->nullable();
            $table->string('cargo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('medio_preferente_contacto')->nullable();
            $table->string('dias_entrevista')->nullable();
            $table->string('horario_entrevista_inicial')->nullable();
            $table->string('horario_entrevista_final')->nullable();
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
        Schema::dropIfExists('informacion_contactos');
    }
}

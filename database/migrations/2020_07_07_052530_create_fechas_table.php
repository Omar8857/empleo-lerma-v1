<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas', function (Blueprint $table) {
            $table->bigIncrements('id_fecha');
            $table->dateTime('fecha')->nullable();
            $table->string('periodico_ofertas')->nullable();
            $table->string('portal_empleo')->nullable();
            $table->string('feria_empleo')->nullable();
            $table->string('radio_mexiquense')->nullable();
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
        Schema::dropIfExists('fechas');
    }
}

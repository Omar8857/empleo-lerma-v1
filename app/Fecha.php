<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $primarykey = 'id_fecha';
    protected $fecha;
    protected $periodico_ofertas;
    protected $portal_empleo;
    protected $feria_empleo;
    protected $radio_mexiquense;
    protected $id_vacante;
    protected $table= "fechas";
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitosVacante extends Model
{
    protected $primarykey = 'id_requisitos';
    protected $personas_con_discapacidad;
    protected $mencione_discapacidad;
    protected $adultos_mayores;
    protected $causa_origina_vacante;
    protected $escolaridad; 
    protected $carrera_especialidad;
    protected $situacion_academica;
    protected $experiencia_MinRequerida;
    protected $minima_edad;
    protected $maxima_edad;
    protected $idioma;
    protected $computacion;
    protected $sexo;
    protected $disponibilidad_viajar;
    protected $disponibilidad_RadicarFuera;
    protected $prestaciones_ofrecidas;
    protected $observaciones;
    protected $id_vacante;
    protected $table= "requisitos_vacantes";
}

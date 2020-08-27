<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuestoDeseado extends Model
{
  protected $primaryKey = 'IdPuestoDeseado'; 
  protected $IdPuestoDeseado;
  protected $puesto_deseado;
  protected $ocupacion;
  protected $experiencia_puesto;
  protected $tipo_empleo;
  protected $salario_mensual;
  protected $dispo_viajar;
  protected $dispo_radicar_fuera;
  protected $id; 
  protected $table= "PuestoDeseado";
}

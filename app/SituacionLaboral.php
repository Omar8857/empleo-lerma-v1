<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SituacionLaboral extends Model
{
  protected $primaryKey = 'IdSituacionLab'; 
  protected $trabajo_actual;
  protected $motivo;
  protected $fecha_busquedaempleo;
  protected $disponibilidad;  
  protected $id; 
  protected $table= "SituacionLaboral";
}

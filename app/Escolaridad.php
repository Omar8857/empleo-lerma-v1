<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escolaridad extends Model 
{
  protected $primaryKey = 'IdEscolaridad';
  protected $IdEscolaridad;
  protected $grado_estudios;
  protected $carrera_especialidad;
  protected $situacion_academica;
  protected $idioma;
  protected $dominio;
  protected $conocimientos_esp;
  protected $habilidades_esp;
  protected $cursos;
  protected $id; 
  protected $table= "Escolaridad"; 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class curriculumusers extends Model
{
    protected $primarykey = 'id_curriculum';
    protected $objetivo_prof;
    protected $experiencia_prof;
    protected $area_especialidad;
    protected $habilidades;
    protected $educacion;
    protected $idiomas;
    protected $cursos_y_certificaciones;
    protected $id;
}

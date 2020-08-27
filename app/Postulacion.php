<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $primaryKey = 'id_postulacion';
    protected $id_usuario;
    protected $id_persona;
    protected $id_vacante;
    protected $id_empresa;
    protected $table= "postulaciones"; 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilLaboral extends Model
{
    protected $primaryKey = 'id_perfil'; 
    protected $id_perfil;
    protected $nombre_RS;
    protected $titulo_puesto;
    protected $funciones_actividades;
    protected $salario_mensual;
    protected $tipo_empleo;
    protected $fecha_ingreso;
    protected $fecha_separacion;
    protected $id;
    protected $table= "PerfilLaboral";
}

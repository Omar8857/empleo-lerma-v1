<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosCiudadano extends Model
{
    protected $primarykey = 'id_persona';
    protected $nombre_completo;
    protected $telefono;
    protected $fecha_nacimiento;
    protected $genero;
    protected $edo_civil;
    protected $lugar_nacimiento;
    protected $EntFed;
    protected $municipio;
    protected $calle;
    protected $numero;
    protected $colonia;
    protected $CP;
    protected $discapacidad;
    protected $curp;
    protected $ComSeEnt;
    protected $foto_perfil;
    protected $id;
    protected $table = "DatosCiudadano";
}

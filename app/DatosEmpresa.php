<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model
{
    protected $primarykey = 'id_empresa';
    protected $nombre_RS;
    protected $calle;
    protected $numero;
    protected $colonia;
    protected $CP;
    protected $municipio;
    protected $estado;
    protected $RFC;
    protected $tel1;
    protected $tel2;
    protected $email;
    protected $pagina_electronica;
    protected $actividad_economica;
    protected $numero_empleados;
    protected $ComoSeEnt;
    protected $foto_perfil;
    protected $id;
    protected $table= "datos_empresas";
}

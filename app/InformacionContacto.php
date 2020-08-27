<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformacionContacto extends Model
{
    protected $primarykey = 'id_contacto';
    protected $nombre_contacto;
    protected $cargo;
    protected $telefono;
    protected $email;
    protected $medio_preferente_contacto;
    protected $dias_entrevista;
    protected $horario_entrevista_inicial;
    protected $horario_entrevista_final;
    protected $id_vacante;
    protected $table= "informacion_contactos";
}
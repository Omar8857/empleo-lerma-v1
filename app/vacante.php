<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vacante extends Model
{
    protected $primarykey = 'id_vacante';
    protected $titulo_puesto;
    protected $slug;
    protected $descripcion_breve;
    protected $FunActi_realizar;
    protected $conocimientos_requeridos;
    //protected $habilidades_requeridos;
    protected $direccioncompleta;
    protected $lugar_vacante;
    protected $tipo_empleo;
    protected $dias_laboral;
    protected $hora_entrada;
    protected $hora_salida;
    protected $salario_mensual;
    protected $numero_plazas;
    protected $vigencia_vacante;
    protected $id_empresa;
    protected $is_covered;
    protected $covered_on_platform;
    protected $table = "vacantes";

    public function scopeTitulo($query, $titulo)
    {
        if ($titulo)
            return $query->where('titulo_puesto', 'LIKE', "%$titulo%");
    }

    public function scopeLugar($query, $lugar)
    {
        if ($lugar)
            return $query->where('lugar_vacante', 'LIKE', "%$lugar%")
                ->orWhere('direccioncompleta', 'LIKE', "%$lugar%");
    }
}

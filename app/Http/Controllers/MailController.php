<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; 

use App\User;
use App\curriculumusers;
use App\EntidadFed;
use App\EdoCivil;
use App\Municipio;
use App\UltimoGrado;
use App\Motivo;
use App\ExpPuesto;
use App\TipoEmpleo;
use App\DatosCiudadano;
use App\Escolaridad;
use App\PerfilLaboral;
use App\SituacionLaboral;
use App\PuestoDeseado;
use App\idioma;
use App\usercv;
use App\DatosEmpresa;
use App\vacante;
use App\RequisitosVacante;
use App\InformacionContacto;
use App\Fecha;
use App\Postulacion;
use DB; 

use App\Mail\ContactoMail; 
class MailController extends Controller
{
    public function store(Request $req){

        $correo = $req->email;
        $nomempresa = $req->nomemp;
        $postulacion = $req->postulacion;
        $datospost  = Postulacion::where('id_postulacion',$postulacion)->first();
        $idvacante  = $datospost->id_vacante;
        $idciudadano = $datospost->id_persona;
        $datoscontacto = InformacionContacto::where('id_vacante',$idvacante)->first();
        $datosciudadano = DatosCiudadano::where('id_persona',$idciudadano)->first();
        $datosvacante = vacante::where('id_vacante',$idvacante)->first();

        $mensaje = request()->validate([
            'nomemp' => 'required',
            'email' => 'required|email',
        ]
        );

        Mail::to($correo)->send(new ContactoMail($mensaje, $datoscontacto, $datosciudadano, $datosvacante));

        echo '<script language="javascript">alert("Se ha enviado un correo al postulante");</script>';
        return redirect()->back();
    }
}

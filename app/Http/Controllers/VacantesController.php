<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use DateTime;

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
use App\reciente;
use Barryvdh\DomPDF\Facade as PDF;

use App\DatosEmpresa;
use App\vacante;
use App\RequisitosVacante;
use App\InformacionContacto;
use App\Fecha;

use App\Postulacion;
use App\Notifications\NewVacancy;
use App\Notifications\NewPostulate;

use Session;
use DB;

use function PHPSTORM_META\elementType;

class VacantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $titulo   = $request->get('titulo_puesto');
        $lugar  = $request->get('lugar_vacante');

        $vacantes = vacante::orderBy('vacantes.id_vacante', 'DESC')
            ->join('datos_empresas', 'datos_empresas.id_empresa', '=', 'vacantes.id_empresa')
            ->join('fechas', 'fechas.id_vacante', '=', 'vacantes.id_vacante')
            ->titulo($titulo)
            ->lugar($lugar)
            ->paginate(4)
            ->appends(request()->query());
        return view('busquedavacantes', compact('vacantes'))
            ->with('titulo', $titulo)
            ->with('lugar', $lugar);
    }

    public function redirectTo()
    {
        if (session()->has('redirect_to'))
            return session()->pull('redirect_to');

        return $this->redirectTo;
    }

    public function welcome()
    {
        if (Auth()->check()) {
            return redirect()->route('micuenta');
        }
        $empresas = DatosEmpresa::All();
        $vacantes = \DB::SELECT("SELECT * FROM vacantes INNER JOIN datos_empresas 
        ON vacantes.id_empresa = datos_empresas.id_empresa ORDER BY vacantes.created_at DESC LIMIT 4");
        $requisitos = RequisitosVacante::All();
        $info = InformacionContacto::All();
        $fechas = fecha::All();

        return view('welcome', compact('empresas', 'vacantes', 'requisitos', 'info', 'fechas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $id         = auth()->id();
        $id_e       = DatosEmpresa::select('id_empresa')->where('id', $id)->first();
        $id_empresa = $id_e->id_empresa;

        $idv_next = 1;
        $idv = vacante::select('id_vacante')->orderBy('id_vacante', 'DESC')->first();
        if ($idv != null)
            $idv_next    = $idv->id_vacante + 1;

        $titulo = $req->title;
        $slug   = Str::slug($titulo);
        $slug2  = $slug . '-' . $idv_next;

        $fecha = new DateTime();
        //$fecha = $fech->format('l jS \de F Y h:i:s A');

        $vacante = new vacante;
        $vacante->id_vacante               = $idv_next;
        $vacante->titulo_puesto            = $req->title;
        $vacante->slug                     = $slug2;
        $vacante->descripcion_breve        = $req->description;
        $vacante->FunActi_realizar         = $req->FuncionActividad;
        $vacante->conocimientos_requeridos = $req->conocimientos;
        //$vacante -> habilidades_requeridos   = $req -> habilidades;
        $vacante->direccioncompleta        = $req->direccioncompleta;
        $vacante->tipo_empleo              = $req->tipoempleo;
        $vacante->salario_mensual          = $req->salario;
        $vacante->lugar_vacante            = $req->ubicacion;
        $vacante->dias_laboral             = $req->DiasLaboral;
        $vacante->hora_entrada             = $req->entrada;
        $vacante->hora_salida              = $req->salida;
        $vacante->numero_plazas            = $req->NumPlazas;
        $vacante->vigencia_vacante         = $req->VigenciaVacante;
        $vacante->id_empresa               = $id_empresa;
        $vacante->save();

        $requisitos = new RequisitosVacante;
        $requisitos->personas_con_discapacidad    = $req->discapacidad;
        $requisitos->mencione_discapacidad        = $req->MenDiscapacidad;
        $requisitos->adultos_mayores              = $req->AdultoMayor;
        $requisitos->causa_origina_vacante        = $req->CausaVacante;
        $requisitos->escolaridad                  = $req->escolaridad;
        $requisitos->carrera_especialidad         = $req->CarreraEspe;
        $requisitos->situacion_academica          = $req->SituAcademica;
        $requisitos->experiencia_MinRequerida     = $req->exppuesto;
        $requisitos->minima_edad                  = $req->EdadMinima;
        $requisitos->maxima_edad                  = $req->EdadMaxima;
        $requisitos->idioma                       = $req->idioma;
        $requisitos->computacion                  = $req->computacion;
        $requisitos->sexo                         = $req->genero;
        $requisitos->disponibilidad_viajar        = $req->RadicarFuera;
        $requisitos->disponibilidad_RadicarFuera  = $req->DispoViajar;
        $requisitos->prestaciones_ofrecidas       = $req->prestaciones;
        $requisitos->observaciones                = $req->observaciones;
        $requisitos->id_vacante                   = $idv_next;
        $requisitos->save();

        $informacion = new InformacionContacto;
        $informacion->nombre_contacto             = $req->nameC;
        $informacion->cargo                       = $req->Cargo;
        $informacion->telefono                    = $req->tel;
        $informacion->email                       = $req->email;
        $informacion->medio_preferente_contacto   = $req->contacto;
        $informacion->dias_entrevista             = $req->DiaEntrevista;
        $informacion->horario_entrevista_inicial  = $req->HorarioInicial;
        $informacion->horario_entrevista_final    = $req->HorarioFinal;
        $informacion->id_vacante                  = $idv_next;
        $informacion->save();

        $publicacion = new Fecha;
        $publicacion->fecha                 = $fecha;
        $publicacion->periodico_ofertas     = $req->periodico;
        $publicacion->portal_empleo         = $req->PortalEmpleo;
        $publicacion->feria_empleo          = $req->FeriaEmpleo;
        $publicacion->radio_mexiquense      = $req->RadioMex;
        $publicacion->id_vacante            = $idv_next;
        $publicacion->save();

        //get admins
        $admins = User::where('tipo_user', 'admin')->get();
        //send notification
        Notification::send($admins, new NewVacancy($vacante));

        return redirect()->route('micuenta');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $idu         = auth()->id();
        $datos       = \DB::SELECT("SELECT * FROM DatosCiudadano WHERE id='$idu'");
        $escolaridad = \DB::SELECT("SELECT * FROM Escolaridad WHERE id='$idu'");

        $vacante = vacante::where('slug', $slug)->first();
        if ($vacante == "") {
            return view('errors.404');
        } else {
            $id = $vacante->id_empresa;
            $empresa = DatosEmpresa::where('id_empresa', $id)->first();
            $idv = $vacante->id_vacante;
            $nombre = $vacante->titulo_puesto;
            $requisitos = RequisitosVacante::where('id_vacante', $idv)->first();
            $contacto = InformacionContacto::where('id_vacante', $idv)->first();

            $postulacion = Postulacion::where('id_usuario', $idu)->where('id_vacante', $idv)->first();

            if (Auth()->check()) {
                $reciente = new reciente;
                $reciente->nombre_reciente = $nombre;
                $reciente->slug = $slug;
                $reciente->id_usuario = $idu;
                $reciente->save();
            }

            return view('vacantesingle', compact('vacante'))
                ->with('empresa', $empresa)
                ->with('requisitos', $requisitos)
                ->with('contacto', $contacto)
                ->with('datos', $datos)
                ->with('escolaridad', $escolaridad)
                ->with('postulacion', $postulacion);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tiposemp   = TipoEmpleo::All();
        $munvacante = \DB::SELECT("SELECT * FROM Municipio WHERE EntFed='México'");
        $exppuestos = ExpPuesto::All();
        //vacancy data
        $vacante = vacante::where('id_vacante', $id)->first();
        $requisitos = RequisitosVacante::where('id_vacante', $vacante->id_vacante)->first();
        $contacto = InformacionContacto::where('id_vacante', $vacante->id_vacante)->first();
        $fecha = Fecha::where('id_vacante', $vacante->id_vacante)->first();

        return view('vacanteedit', compact('vacante'))
            ->with('fecha', $fecha)
            ->with('requisitos', $requisitos)
            ->with('contacto', $contacto)
            ->with('tiposemp', $tiposemp)
            ->with('munvacante', $munvacante)
            ->with('exppuestos', $exppuestos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //vacancy data
        $titulo_puesto            = $req->title;
        $descripcion_breve        = $req->description;
        $FunActi_realizar         = $req->FuncionActividad;
        $conocimientos_requeridos = $req->conocimientos;
        $direccioncompleta        = $req->direccioncompleta;
        $tipo_empleo              = $req->tipoempleo;
        $salario_mensual          = $req->salario;
        $lugar_vacante            = $req->ubicacion;
        $dias_laboral             = $req->DiasLaboral;
        $hora_entrada             = $req->entrada;
        $hora_salida              = $req->salida;
        $numero_plazas            = $req->NumPlazas;
        $vigencia_vacante         = $req->VigenciaVacante;

        if ($hora_entrada== ''){
            $hora_entrada = '00:00:00';
        }
        if ($hora_salida== ''){
            $hora_salida = '00:00:00';
        }   

        
        \DB::UPDATE("UPDATE vacantes 
                     SET titulo_puesto='$titulo_puesto', 
                         descripcion_breve='$descripcion_breve', 
                         FunActi_realizar='$FunActi_realizar',
                         conocimientos_requeridos='$conocimientos_requeridos', 
                         direccioncompleta='$direccioncompleta',
                         tipo_empleo='$tipo_empleo', 
                         salario_mensual='$salario_mensual',
                         lugar_vacante='$lugar_vacante', 
                         dias_laboral='$dias_laboral',
                         hora_entrada='$hora_entrada', 
                         hora_salida='$hora_salida',
                         numero_plazas='$numero_plazas', 
                         vigencia_vacante='$vigencia_vacante'
                     WHERE id_vacante='$id'");

        $personas_con_discapacidad    = $req->discapacidad;
        $mencione_discapacidad        = $req->MenDiscapacidad;
        $adultos_mayores              = $req->AdultoMayor;
        $causa_origina_vacante        = $req->CausaVacante;
        $escolaridad                  = $req->escolaridad;
        $carrera_especialidad         = $req->CarreraEspe;
        $situacion_academica          = $req->SituAcademica;
        $experiencia_MinRequerida     = $req->exppuesto;
        $minima_edad                  = $req->EdadMinima;
        $maxima_edad                  = $req->EdadMaxima;
        $idioma                       = $req->idioma;
        $computacion                  = $req->computacion;
        $sexo                         = $req->genero;
        $disponibilidad_viajar        = $req->RadicarFuera;
        $disponibilidad_RadicarFuera  = $req->DispoViajar;
        $prestaciones_ofrecidas       = $req->prestaciones;
        $observaciones                = $req->observaciones;

        \DB::UPDATE("UPDATE requisitos_vacantes 
                     SET personas_con_discapacidad='$personas_con_discapacidad', 
                         mencione_discapacidad='$mencione_discapacidad', 
                         adultos_mayores='$adultos_mayores',
                         causa_origina_vacante='$causa_origina_vacante', 
                         escolaridad='$escolaridad',
                         carrera_especialidad='$carrera_especialidad', 
                         situacion_academica='$situacion_academica',
                         experiencia_MinRequerida='$experiencia_MinRequerida', 
                         minima_edad='$minima_edad',
                         maxima_edad='$maxima_edad', 
                         idioma='$idioma',
                         computacion='$computacion', 
                         sexo='$sexo',
                         disponibilidad_viajar='$disponibilidad_viajar', 
                         disponibilidad_RadicarFuera='$disponibilidad_RadicarFuera',
                         prestaciones_ofrecidas='$prestaciones_ofrecidas', 
                         observaciones='$observaciones'
                     WHERE id_vacante='$id'");

        $nombre_contacto             = $req->nameC;
        $cargo                       = $req->Cargo;
        $telefono                    = $req->tel;
        $email                       = $req->email;
        $medio_preferente_contacto   = $req->contacto;
        $dias_entrevista             = $req->DiaEntrevista;
        $horario_entrevista_inicial  = $req->HorarioInicial;
        $horario_entrevista_final    = $req->HorarioFinal;

        if ($horario_entrevista_inicial== ''){
            $horario_entrevista_inicial = '0000-00-00';
        }
        if ($horario_entrevista_final== ''){
            $horario_entrevista_final = '000-00-00';
        } 

        \DB::UPDATE("UPDATE informacion_contactos 
                     SET nombre_contacto='$nombre_contacto', 
                         cargo='$cargo', 
                         telefono='$telefono',
                         email='$email', 
                         medio_preferente_contacto='$medio_preferente_contacto',
                         dias_entrevista='$dias_entrevista', 
                         horario_entrevista_inicial='$horario_entrevista_inicial',
                         horario_entrevista_final='$horario_entrevista_final'
                     WHERE id_vacante='$id'");

        $periodico_ofertas     = $req->periodico;
        $portal_empleo         = $req->PortalEmpleo;
        $feria_empleo          = $req->FeriaEmpleo;
        $radio_mexiquense      = $req->RadioMex;

        \DB::UPDATE("UPDATE fechas 
                     SET periodico_ofertas='$periodico_ofertas', 
                         portal_empleo='$portal_empleo', 
                         feria_empleo='$feria_empleo',
                         radio_mexiquense='$radio_mexiquense'
                     WHERE id_vacante='$id'");
        
        $vacante = vacante::where('id_vacante', $id)->first();
        
        return view('vacanteedit', compact('vacante'))
            ->with('update', "actualizada");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postulacion(Request $req)
    {
        $id        = auth()->id();
        //$url       = $req->url;
        $idv       = $req->idvacante;
        $idempresa = Vacante::select('id_empresa')->where('id_vacante', $idv)->first();
        $ide       = $idempresa->id_empresa;
        $datosc    = DatosCiudadano::where('id', $id)->first();
        $idd       = $datosc->id_persona;
        
        $postulacion = new Postulacion;
        $postulacion->id_usuario = $id;
        $postulacion->id_persona = $idd;
        $postulacion->id_vacante = $idv;
        $postulacion->id_empresa = $ide;
        $postulacion->save();

        $empresa = DatosEmpresa::where('id_empresa', $ide)->first();
        $vacante = vacante::where('id_vacante', $idv)->first();
        $users = User::findMany([$id, $empresa->id]);
        Notification::send($users, new NewPostulate($vacante));
         
        //return redirect($url);
        return response()->json(['success'=>'Te haz postulado satisfactoriamente', 
                                 'name'=>$datosc->nombre_completo]);
    }

    // Crea el PDF del curriculum del usuario ciudadano automaticamente
    public function cvuserpdf($nombre_completo)
    {
        $idd         = DatosCiudadano::select('id')->where('nombre_completo', $nombre_completo)->first();
        $id          = $idd->id;
        $cv          = usercv::where('id', $id)->first();
        $userr       = User::where('id', $id)->get();
        $datos       = DatosCiudadano::where('id', $id)->get();
        $escolaridad = Escolaridad::where('id', $id)->get();
        $perfil      = PerfilLaboral::where('id', $id)->get();
        $puesto      = PuestoDeseado::where('id', $id)->get();
        $situacion   = SituacionLaboral::where('id', $id)->get();
        if (empty($cv)) {
            $pdf        = PDF::loadview('cv.pdfuser', [
                'datos'       => $datos,
                'escolaridad' => $escolaridad,
                'perfil'      => $perfil,
                'puesto'      => $puesto,
                'userr'       => $userr,
                'situación'   => $situacion
            ]);

            return $pdf->download('CV-' . $nombre_completo . '.pdf');
        } else {
            $nomcv       = $cv->nombre_cv;
            $file = public_path('/archivo/') . $nomcv;

            return response()->download($file);
        }
    }

    public function contactar($email)
    {
        $correouser = $email;
        $datosu = User::where('email', $email)->first();
        return view('email/emailform')
            ->with('correouser', $correouser)
            ->with('datosu', $datosu);
    }

    public function covered($id, $platform_support){
        
        //vacancy data
        $vacante = vacante::where('id_vacante', $id)->first();
 
        $is_covered = 1;
        if($platform_support=='true'){
            $covered_on_platform = 1;
        }else{
            $covered_on_platform = 0;
        }
        //update
        \DB::UPDATE("UPDATE vacantes 
                     SET is_covered='$is_covered', 
                         covered_on_platform='$covered_on_platform'
                     WHERE id_vacante='$id'");

        return response()->json(['success'=>'La vacante se ha modificado satisfactoriamente', 
                                 'name'=>$vacante->titulo_puesto]);
    }
}

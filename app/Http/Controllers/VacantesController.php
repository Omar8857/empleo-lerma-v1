<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

use Session;
use DB; 

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
       ->with('titulo',$titulo)
       ->with('lugar',$lugar);
    }
 
    public function redirectTo()
    {
        if (session()->has('redirect_to'))
            return session()->pull('redirect_to');

        return $this->redirectTo;
    }

    public function welcome()
    {
        if(Auth()->check())
        {
            return redirect()->route('micuenta');
        }
        $empresas = DatosEmpresa::All();
        $vacantes = \DB::SELECT("SELECT * FROM vacantes INNER JOIN datos_empresas 
        ON vacantes.id_empresa = datos_empresas.id_empresa ORDER BY vacantes.created_at DESC LIMIT 4");
        $requisitos = RequisitosVacante::All();
        $info = InformacionContacto::All();
        $fechas = fecha::All();
        
        return view('welcome', compact('empresas','vacantes','requisitos','info','fechas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $id         = auth()->id();
        $id_e       = DatosEmpresa::select('id_empresa')->where('id',$id)->first();
        $id_empresa = $id_e->id_empresa;

        $idv_next = 1;
        $idv = vacante::select('id_vacante')->orderBy('id_vacante', 'DESC')->first();
        if($idv!=null)
          $idv_next    = $idv -> id_vacante + 1;
        
        $titulo = $req -> title;
        $slug   = Str::slug($titulo);
        $slug2  = $slug.'-'.$idv_next;

        $fecha = new DateTime();
        //$fecha = $fech->format('l jS \de F Y h:i:s A');

        $vacante = new vacante;
        $vacante -> id_vacante               = $idv_next;
        $vacante -> titulo_puesto            = $req -> title;
        $vacante -> slug                     = $slug2;
        $vacante -> descripcion_breve        = $req -> description;
        $vacante -> FunActi_realizar         = $req -> FuncionActividad;
        $vacante -> conocimientos_requeridos = $req -> conocimientos;
        $vacante -> habilidades_requeridos   = $req -> habilidades;
        $vacante -> direccioncompleta        = $req -> direccioncompleta;
        $vacante -> tipo_empleo              = $req -> tipoempleo;
        $vacante -> salario_mensual          = $req -> salario;
        $vacante -> lugar_vacante            = $req -> ubicacion;
        $vacante -> dias_laboral             = $req -> DiasLaboral;
        $vacante -> hora_entrada             = $req -> entrada;
        $vacante -> hora_salida              = $req -> salida;
        $vacante -> numero_plazas            = $req -> NumPlazas;
        $vacante -> vigencia_vacante         = $req -> VigenciaVacante;
        $vacante -> id_empresa               = $id_empresa; 
        $vacante -> save();

        $requisitos = new RequisitosVacante;
        $requisitos -> personas_con_discapacidad    = $req -> discapacidad;
        $requisitos -> mencione_discapacidad        = $req -> MenDiscapacidad;
        $requisitos -> adultos_mayores              = $req -> AdultoMayor;
        $requisitos -> causa_origina_vacante        = $req -> CausaVacante;
        $requisitos -> escolaridad                  = $req -> escolaridad;
        $requisitos -> carrera_especialidad         = $req -> CarreraEspe;
        $requisitos -> situacion_academica          = $req -> SituAcademica;
        $requisitos -> experiencia_MinRequerida     = $req -> exppuesto;
        $requisitos -> minima_edad                  = $req -> EdadMinima;
        $requisitos -> maxima_edad                  = $req -> EdadMaxima;
        $requisitos -> idioma                       = $req -> idioma;
        $requisitos -> computacion                  = $req -> computacion;
        $requisitos -> sexo                         = $req -> genero;
        $requisitos -> disponibilidad_viajar        = $req -> RadicarFuera;
        $requisitos -> disponibilidad_RadicarFuera  = $req -> DispoViajar;
        $requisitos -> prestaciones_ofrecidas       = $req -> prestaciones;
        $requisitos -> observaciones                = $req -> observaciones;
        $requisitos -> id_vacante                   = $idv_next; 
        $requisitos -> save();

        $informacion = new InformacionContacto;
        $informacion -> nombre_contacto             = $req -> nameC;
        $informacion -> cargo                       = $req -> Cargo;
        $informacion -> telefono                    = $req -> tel;
        $informacion -> email                       = $req -> email;
        $informacion -> medio_preferente_contacto   = $req -> contacto;
        $informacion -> dias_entrevista             = $req -> DiaEntrevista;
        $informacion -> horario_entrevista_inicial  = $req -> HorarioInicial;
        $informacion -> horario_entrevista_final    = $req -> HorarioFinal;
        $informacion -> id_vacante                  = $idv_next;
        $informacion -> save();

        $publicacion = new Fecha;
        $publicacion -> fecha                 = $fecha;
        $publicacion -> periodico_ofertas     = $req -> periodico;
        $publicacion -> portal_empleo         = $req -> PortalEmpleo;
        $publicacion -> feria_empleo          = $req -> FeriaEmpleo;
        $publicacion -> radio_mexiquense      = $req -> RadioMex;
        $publicacion -> id_vacante            = $idv_next;
        $publicacion -> save();

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

        $vacante = vacante::where('slug',$slug)->first();
        if($vacante == "")
        {
            return view('errors.404');
        }
        else
        {
            $id = $vacante->id_empresa;
            $empresa = DatosEmpresa::where('id_empresa',$id)->first();
            $idv = $vacante->id_vacante; 
            $nombre = $vacante->titulo_puesto;
            $requisitos = RequisitosVacante::where('id_vacante',$idv)->first();
            $contacto = InformacionContacto::where('id_vacante',$idv)->first();

            $postulacion = Postulacion::where('id_usuario',$idu)->where('id_vacante',$idv)->first();
            
            if(Auth()->check())
            {
                $reciente = new reciente;
                $reciente -> nombre_reciente = $nombre;
                $reciente -> slug = $slug ;
                $reciente -> id_usuario = $idu;
                $reciente -> save();
            }

            return view('vacantesingle', compact('vacante'))
            ->with('empresa',$empresa)
            ->with('requisitos',$requisitos)
            ->with('contacto',$contacto)
            ->with('datos',$datos)
            ->with('escolaridad',$escolaridad)
            ->with('postulacion',$postulacion);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $url       = $req->url;
        $idv       = $req->idvacante;
        $idempresa = Vacante::select('id_empresa')->where('id_vacante',$idv)->first();
        $ide       = $idempresa->id_empresa;
        $datosc    = DatosCiudadano::where('id',$id)->first();
        $idd       = $datosc->id_persona;

        $postulacion = new Postulacion;
        $postulacion -> id_usuario = $id;
        $postulacion -> id_persona = $idd;
        $postulacion -> id_vacante = $idv;
        $postulacion -> id_empresa = $ide;
        $postulacion -> save();

        return redirect($url);

    }

    // Crea el PDF del curriculum del usuario ciudadano automaticamente
    public function cvuserpdf($nombre_completo) 
    {
        $idd         = DatosCiudadano::select('id')->where('nombre_completo', $nombre_completo)->first();
        $id          = $idd->id;
        $cv          = usercv::where('id',$id)->first();
        $userr       = User::where('id',$id)->get();
        $datos       = DatosCiudadano::where('id',$id)->get();
        $escolaridad = Escolaridad::where('id',$id)->get();
        $perfil      = PerfilLaboral::where('id',$id)->get();
        $puesto      = PuestoDeseado::where('id',$id)->get();
        $situacion   = SituacionLaboral::where('id',$id)->get();
        if(empty($cv))
        {
            $pdf        = PDF::loadview('cv.pdfuser',[
                        'datos'       => $datos,
                        'escolaridad' => $escolaridad,
                        'perfil'      => $perfil,
                        'puesto'      => $puesto,
                        'userr'       => $userr,
                        'situación'   => $situacion]);  

            return $pdf->download('CV-'.$nombre_completo.'.pdf'); 
        }
        else
        {
            $nomcv       = $cv->nombre_cv;
            $file= public_path('/archivo/').$nomcv;   

            return response()->download($file);
        }
    }
    
    public function contactar($email)
    {
        $correouser = $email;
        $datosu = User::where('email',$email)->first();
        return view('email/emailform')
        ->with('correouser',$correouser)
        ->with('datosu',$datosu);
    }

}

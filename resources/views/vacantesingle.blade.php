@extends('layouts.app')

@section('content')
    <!--header-->
    <header>
      <div class="brand text-center">
        <a href="{{url('/')}}">
          <img src="{{asset('assets/img/logos-lerma.png')}}" alt="lerma">
        </a>
      </div>
      <div class="social-icons">
        <div class="container">
          <ul>
          @guest
            <li>
              <a href="{{ route('login') }}" class="btn"> Iniciar Sesión </a>
            </li>
            @if (Route::has('register'))
            <li>
              <a href="{{ route('register') }}" class="btn"> Registrarse </a>
            </li>
            @endif
            @else
            <li>
              <a id="navbarDropdown" class=" btn nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->nombre }} <span class="caret"></span>
              </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('micuenta') }}">
                    {{ __('Mi Cuenta') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Cerrar Sesión') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </div>
            @endguest
            </li>
            <li class="facebook">
              <a href="#" class="s-i" target="_blank"></a>
            </li>
            <li class="instagram">
              <a href="#" class="s-i" target="_blank"></a>
            </li>
            <li class="youtube">
              <a href="#" class="s-i" target="_blank"></a>
            </li>
          </ul>
        </div>        
      </div>
      <nav class="navbar navbar-expand-lg navbar-dark gradient-brand">
        <div class="container">
          <button class="navbar-toggler ri" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarToggler"> 
            <ul class="navbar-nav">
             <li class="nav-item">
                <a class="nav-link" href="https://visita.lerma.gob.mx/quehacer">BUSCO EMPLEO</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="https://visita.lerma.gob.mx/queSucede">OFREZCO EMPLEO</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="https://visita.lerma.gob.mx/conoce_lerma">EMPLEO LERMA</a>
             </li>
         </ul>
          </div>
        </div>
      </nav>
    </header>
    <!--Vacancies-->
    <section class="pt-md-3 m-3"> 
      <div class="container my-md-5">
        <div class="row justify-content-md-center">
          <div class="col-12 mb-3">
            <h3>{{$vacante->titulo_puesto}}</h3>
            <hr>
          </div>
          <div class="col-12 col-md-8">
            <div class="card-group vacancies mr-md-4">
              <div class="card bg-info text-white text-center mb-0 mb-md-3">
                <div class="card-header mt-3">
                  <h6 class="mb-0">Sueldo Mensual</h6>
                </div>
                <div class="card-body pt-0">
                  <h5 class="mb-0">${{$vacante->salario_mensual}}</h5>
                </div>
              </div>
              <div class="card  bg-info text-white text-center mb-0 mb-md-3">
                <div class="card-header mt-3">
                  <h6 class="mb-0">Lugar</h6>
                </div>
                <div class="card-body pt-0">
                  <h5 class="mb-0">{{$vacante->lugar_vacante}}</h5>
                </div>
              </div>
              <div class="card  bg-info text-white text-center mb-0 mb-md-3">
                <div class="card-header mt-3">
                  <h6 class="mb-0">Tipo</h6>
                </div>
                <div class="card-body pt-0">
                  <h5 class="mb-0">{{$vacante->tipo_empleo}}</h5>
                </div>
              </div>
            </div>
            <h4 class="my-3 font-weight-bold">Datos de la Vacante: </h4>
            <div class="content mr-md-4">
              <ul>
                <li><p><b>Descripción: </b>{{$vacante->descripcion_breve}}</p></li>
                <li><p><b>Funciones y actividades a realizar: </b>{{$vacante->FunActi_realizar}}</p></li>
                <li><p><b>Conocimientos requeridos: </b>{{$vacante->conocimientos_requeridos}}</p></li>
                <li><p><b>Habilidades requeridas: </b>{{$vacante->habilidades_requeridos}}</p></li>
                <li><p><b>Dias laborales: </b>{{$vacante->dias_laboral}}</p></li>
                <li><p><b>Horario: </b>De {{date('h:i a', strtotime($vacante->hora_entrada))}} A {{date('h:i a', strtotime($vacante->hora_salida))}}</p></li>
                <li><p><b>Prestaciones ofrecidas: </b>{{$requisitos->prestaciones_ofrecidas}}</p></li>
                <li><p><b>Dirección: </b>{{$vacante->direccioncompleta}}</p></li>
              <ul>
            </div>
            <h4 class="my-3 font-weight-bold">Requisitos: </h4>
            <div class="content mr-md-4">
              <ul>
                <li><p><b>Acepta personas con discapacidad: </b>{{$requisitos->personas_con_discapacidad}}, {{$requisitos->mencione_discapacidad}}</p></li>
                <li><p><b>Escolaridad: </b>{{$requisitos->escolaridad}}</p></li>
                <li><p><b>Carrera o especialidad: </b>{{$requisitos->carrera_especialidad}}</p></li>
                <li><p><b>Situación academica: </b>{{$requisitos->situacion_academica}}</p></li>
                <li><p><b>Experiencia: </b>{{$requisitos->experiencia_MinRequerida}}</p></li>
                <li><p><b>Rango de edad: </b>De {{$requisitos->minima_edad}} años a {{$requisitos->maxima_edad}} años</p></li>
                <li><p><b>Idioma: </b>{{$requisitos->idioma}}</p></li>
                <li><p><b>Conocimientos en computación: </b>{{$requisitos->computacion}}</p></li>
                <li><p><b>Sexo: </b>{{$requisitos->sexo}}</p></li>
                <li><p><b>Disponibilidad de viajar: </b>{{$requisitos->disponibilidad_viajar}}</p></li>
                <li><p><b>Disponibilidad de radicar fuera: </b>{{$requisitos->disponibilidad_RadicarFuera}}</p></li>
                <li><p><b>Observaciones: </b>{{$requisitos->observaciones}}</p></li>
              </ul>
            </div>
            <h4 class="my-3 font-weight-bold">Contacto: </h4>
              <ul>
                <li><p><b>Nombre: </b>{{$contacto->nombre_contacto}}<p></li>
                <li><p><b>Cargo: </b>{{$contacto->cargo}}<p></li>
                <li><p><b>Teléfono: </b>{{$contacto->telefono}}<p></li>
                <li><p><b>Correo Electrónico: </b>{{$contacto->email}}<p></li>
                <li><p><b>Medio preferente: </b>{{$contacto->medio_preferente_contacto}}<p></li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="mb-4 ml-md-4">
              <div class="card postulation shadow ">
                <img src="{{asset('archivo/'.$empresa->foto_perfil)}}" class="card-img-top" alt="$empresa->foto_perfil">
                <div class="card-body">
                  <h5 class="card-title text-center">{{$empresa->nombre_RS}}</h5>
                  <div class="classification text-center mb-4">
                    <ol>
                      <i class="fas fa-star mx-2"></i>
                      <i class="fas fa-star mx-2"></i>
                      <i class="fas fa-star mx-2"></i>
                      <i class="far fa-star mx-2"></i>
                      <i class="far fa-star mx-2"></i>
                    </ol>                    
                  </div>
                  @guest
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">Postularme</button>
                    <!-- <a href="#" class="btn btn-primary btn-block">Postularme</a> -->
                  @else
                    @empty($postulacion)
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">Postularme</button>
                      <!-- <a href="#" class="btn btn-primary btn-block">Postularme</a> -->
                    @else
                      <button type="button" class="btn btn-primary btn-block" disabled>Ya te haz postulado</button>
                    @endempty
                  @endguest
                </div>
              </div>
              <!-- <h6 class="sharer mt-5">
                Comparte esta vacante
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a> 
              </h6> -->
            </div>
          </div>
          @guest
            <!-- Modal con notificación para iniciar sesión -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header gradient-brand">
                    <h5 class="modal-title" style="color:white" id="exampleModalLongTitle">Lo sentimos, no puedes postularte a esta vacante.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span style="color:white" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div align="center">
                      <h6>Para poder postularte, primero debes:</h6>
                    </div>
                    <div align="center">
                    <a href="{{ url('/login?redirect_to='.url()->current()) }}" class="btn btn-primary col-md-4 btn-block">Iniciar Sesión</a>
                    </div>
                    <div align="center">
                      <h6>ó</h6>
                    </div>
                    <div align="center">
                    <a href="{{route('register')}}" class="btn btn-primary col-md-4 btn-block">Registrarte</a>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          @else
            @if ($datos && $escolaridad)
              <!-- Modal para postulación -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header gradient-brand">
                      <h5 class="modal-title" style="color:white" id="exampleModalLongTitle">Confirmación de Postulante.</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white" aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h6>¿Deseas Postularte a <b>"{{$vacante->titulo_puesto}}"</b> ofrecido por <b>"{{$empresa->nombre_RS}}"</b>?</h6>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="{{ route('postulacion') }}">
                        @csrf
                        <input type="hidden" name="idvacante" value="{{$vacante->id_vacante}}">
                        <input type="hidden" name="url" value="{{url()->current()}}">
                        <button type="submit" class="btn btn-primary">Postularme</button>
                      </form>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            @else
              <!-- Modal para llenar datos obligatorios -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header gradient-brand">
                      <h5 class="modal-title" style="color:white" id="exampleModalLongTitle">Para continuar con esta acción:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white" aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div>
                      <h6>Debes tener completo el registro de datos que se te piden en <b><a href="{{route('micuenta')}}">"Mi Cuenta"</a>,</b> tales como:</h6>
                      <li><b>Mis Datos</b> (Fecha de nacimiento, género, estado civil, dirección, etc.).</li>
                      <li><b>Mi Curriculum</b> (Escolaridad, situación laboral, perfil laboral y puesto deseado).</li>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <a href="{{route('micuenta')}}" class="btn btn-primary">Ir a Mi Cuenta</a>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endguest
        </div>
      </div>
    </section>
    <!--Related-->
    <section class="bg-light">
      <div class="container my-md-5">
        <div class="row justify-content-between">
          <!-- reviews-->
          <div class="col-12 ">
            <h4 class="mb-4 mx-3">Vacantes Similares</h4>
            <div class="card-deck mx-3 mx-md-0">
              <div class="card">
                <div class="card-body">
                  <a href="#">
                    <h5 class="card-title">Vacante Similar</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <small class="txt-accent"><span>Lerma</span> / <span> hace 3 min</span></small>
                  </a>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <a href="#">
                    <h5 class="card-title">Vacante Similar</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <small class="txt-accent"><span>Lerma</span> / <span> hace 3 min</span></small>
                  </a>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <a href="#">
                    <h5 class="card-title">Vacante Similar</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <small class="txt-accent"><span>Lerma</span> / <span> hace 3 min</span></small>
                  </a>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <a href="#">
                    <h5 class="card-title">Vacante Similar</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <small class="txt-accent"><span>Lerma</span> / <span> hace 3 min</span></small>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--footer-->
    <footer>
      <div class="container-fluid bg-dark text-light">
        <div class="container">
          <div class="row py-5 justify-content-center">
            <div class="col-4 col-md-1">
              <img src="{{asset('assets/img/lerma-footer.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-10 col-md-4">
              <h5 class="text-uppercase pb-1">Contactanos</h5>
              <i class="fas fa-phone fa-xs fa-footer pr-3"></i><a href="tel:+52 728 2829903" class="text-light">+52 (728) 2829903</a><br>
              <i class="far fa-envelope fa-xs fa-footer pr-3"></i><a href="mailto:empleolerma@gmail.com" class="text-light">empleolerma@gmail.com</a><br>
              <i class="fas fa-map-marker-alt fa-xs fa-footer pr-3"></i><a href="#" class="text-light">Palacio Municipal s/n Col. Centro, Lerma, Estado de México</a>
            </div>
            <div class="col-10 col-md-3">
              <h5 class="text-uppercase pb-1">Síguenos</h5>
              <i class="fab fa-facebook fa-xs fa-footer pr-3"></i><a href="#" class="text-light">Facebook</a><br>
              <i class="fab fa-instagram-square fa-xs fa-footer pr-3"></i><a href="#" class="text-light">Instagram</a><br>
              <i class="fab fa-youtube fa-xs fa-footer pr-3"></i><a href="#" class="text-light">YouTube</a><br>
            </div>
            <div class="col-10 col-md-4">
              <h5 class="text-uppercase pb-1">Enlaces de interes</h5>
              <a href="https://www.lerma.gob.mx/" class="text-light">Ayuntamiento de Lerma</a><br>
              <a href="https://strabajo.edomex.gob.mx" class="text-light">Secretaría del Trabajo del Estado de México</a><br>
              <a href="https://www.gob.mx/stps" class="text-light">Secretaría del Trabajo y Previsión Social</a><br>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid bg-secondary">
        <div class="container">
          <div class="row py-3 justify-content-md-center text-center">
            <div class="col-12 col-md-8 copy">
              <a href="#" class="text-white small text-uppercase pr-4">Derechos reservados 2019</a>
              <a href="http://www.lerma.gob.mx/ayuntamiento/aviso-de-privacidad/" class="text-white small text-uppercase pr-4">Anuncio de privacidad</a>
            </div>
          </div>
        </div>
      </div>
    </footer>  

@endsection
<!DOCTYPE html>  
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleo Lerma</title>
    <link href="{{asset('assets/img/escudo-de-armas-lerma.png')}}" rel="shortcut icon">
    <meta name="robots" content="index,follow">
    <meta name="description" content="Empleo Lerma">
    <meta name="author" content="LERMA.GOB.MX">
    <meta name="keywords" content="lerma, empleo, municipio">
    <meta name="copyright" content="Copyright 2020 Ayuntamiento de Lerma">
    <link rel="canonical" href="https://empleo.lerma.gob.mx">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://empleo.lerma.gob.mx">
    <meta property="og:title" content="Empleo Lerma">
    <meta property="og:description" content="Empleo Lerma">
    <meta property="og:image" content="https://empleo.lerma.gob.mx/img/logos-lerma.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/src/style.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/b2d5760d1d.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).ready(function (){ 
        $('.btnNext').click(function(){
          $('.siguiente .active').parent().next('li').find('a').trigger('click');
        });

        $('.btnPrevious').click(function() {
          $('.siguiente .active').parent().prev('li').find('a').trigger('click');
        });

        $('#entfed').change(function() {
          var EntFed = $(this).val();
          $.ajax({
            url: 'getMpios',
            type: 'GET',
            data: {EntFed:EntFed},
            headers: {
                      'X-CSRF-Token': '{{ csrf_token() }}',
                      },
            success:function(response){
              var datos = JSON.parse(response);
              var len = response.length;
              $("#municipio").empty();
              for( var i = 0; i<len; i++){
                  // var IdMunicipio = datos[i]['IdMunicipio'];
                  var Municipio = datos[i]['Municipio'];
                  $("#municipio").append("<option value='"+Municipio+"'>"+Municipio+"</option>");
              }
            }
          });
        });
      });
    </script>
  </head>
  <body>
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
              </li>
            @endguest
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
    <!--Dashboard-->
    <section class="events py-5">
      <div class="container">
        <div class="row justify-content-between">
          <!--username-->
          <div class="col-12">
            <h4 class="ml-4 lerma">{{ Auth::user()->nombre }}</h4>
          </div>
          <!--menu-->
          <div class="col-12 col-md-4">
            <div class="nav flex-column nav-pills shadow m-4 bg-white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mi Cuenta</a>
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mis Datos</a>
              <a class="nav-link" id="v-pills-applications-tab" data-toggle="pill" href="#v-pills-applications" role="tab" aria-controls="v-pills-applications" aria-selected="false">Mis Postulaciones</a>
              <a class="nav-link" id="v-pills-cv-tab" data-toggle="pill" href="#v-pills-cv" role="tab" aria-controls="v-pills-cv" aria-selected="false">Mi Curriculum</a>
            </div>
          </div>
          <div class="col-12 col-md-8">
            <div class="tab-content m-4" id="v-pills-tabContent">
              <!--home-->
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="card">
                  <div class="card-header bg-white">
                    <h5 class="text-center font-weight-bold">Datos de Contacto</h5>
                  </div>
                  <div class="card-body">
                    <ul class="list-group">
                      <li class="list-group-item"><small>Nombre:</small>   <span>{{ Auth::user()->nombre }}</span></li>
                      <li class="list-group-item"><small>Teléfono:</small> <span>{{ Auth::user()->telefono }}</span></li>
                      <li class="list-group-item"><small>Email:</small>    <span>{{ Auth::user()->email }}</span></li>
                    </ul>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header bg-white">
                    <h5 class="text-center font-weight-bold">Postulaciones Recientes</h5>
                  </div>
                  <div class="card-body">
                    <div class="card-content">
                      <ul class="list-unstyled">
                        <h4 align="center">Aún no te haz postulado a una vacante.</h4>
                        <hr>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!--profile-->
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="card">
                  <div class="card-header bg-white">
                    <h5 class="text-center font-weight-bold">Mis Datos</h5>
                  </div>
                  <div class="card-body">
                    <!--form profile-->
                    {{Form::open(['route' => 'guardardatosc','files' => true, 'class' => 'data-form'])}}
                      @csrf
                      <div class="tab-content">
                        <div id="datosper" class="container tab-pane active">
                          <div class="form-row" align="center">
                            <div class="form-group col-md-12">
                              <label for="photoUser" class="font-weight-bold">Foto de Perfil (Opcional)</label><br>
                              <input type="file" id="photoUser" name="photoUser" class="input--style-4" accept=".jpg,.jpeg,.png" title="Solo imagenes con extensión: jpg, jpeg, png">
                            </div>
                            <hr/>
                            <div class="form-group col-md-6">
                              <label for="userName" class="font-weight-bold">Nombre Completo <font color="red">*</font></label>
                              <input type="text" class="form-control" id="userName" name="userName" placeholder="Nombre Completo" value="{{old('userName', Auth::user()->nombre)}}" required>
                            </div>
                            <div class="form-group col-md-6"> 
                              <label for="phoneUser" class="font-weight-bold">Teléfono <font color="red">*</font></label>
                              <input type="tel" class="form-control" id="phoneUser" name="phoneUser" placeholder="Numero de Teléfono" pattern="[0-9]{10}" title="Ingrese número a 10 dígitos" value="{{old('phoneUser', Auth::user()->telefono)}}" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="dateUser" class="font-weight-bold">Fecha de Nacimiento <font color="red">*</font></label>
                              <input type="date" class="form-control" id="dateUser" name="dateUser" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="genereUser" class="font-weight-bold">Género <font color="red">*</font></label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genereUser"  value="Masculino" checked>
                                <label class="form-check-label" for="genereUser">Masculino</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genereUser"  value="Femenino">
                                <label class="form-check-label" for="genereUser">Femenino</label>
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="edocivil" class="font-weight-bold">Estado Civil <font color="red">*</font></label>
                              <select id="edocivil" name="edocivil" class="form-control" required>
                                <option disabled>Selecciona</option>
                                @foreach ($edoscivil as $edocivil)
                                  <option value='{{ $edocivil->EdoCivil }}'> {{ $edocivil->EdoCivil }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="entidadnac" class="font-weight-bold">Lugar de Nacimiento <font color="red">*</font></label>
                              <select id="entidadnac" name="entidadnac" class="form-control" required>
                                <option disabled> Selecciona</option>
                                @foreach ($ents as $ent)
                                  <option value='{{ $ent->EntFed }}'> {{ $ent->EntFed }}</option>
                                @endforeach
                              </select>
                            </div> 
                            <div class="form-group col-md-6">
                              <label for="entfed" class="font-weight-bold">Entidad Federativa <font color="red">*</font></label>
                              <select name="entfed" id="entfed" class="form-control" required>
                                <option disabled>Selecciona</option>
                                @foreach ($ents as $ent)
                                  <option value='{{ $ent->EntFed }}'> {{ $ent->EntFed }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="municipio" class="font-weight-bold">Municipio <font color="red">*</font></label>
                              <select name="municipio" id="municipio" class="form-control" required>
                                @foreach ($municipios as $municipio)
                                  <option value='{{ $municipio->Municipio }}'> {{ $municipio->Municipio }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="colonia" class="font-weight-bold">Colonia <font color="red">*</font></label>
                              <input type="text" class="form-control" name="colonia" placeholder="Colonia" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="codpost" class="font-weight-bold">Código Postal <font color="red">*</font></label>
                              <input type="text" class="form-control" name="codpost" placeholder="C.P." pattern="[0-9]{5}" title="Ingrese Código Postal a 5 digitos" required>
                            </div> 
                            <div class="form-group col-md-6">
                              <label for="calle" class="font-weight-bold">Calle <font color="red">*</font></label>
                              <input type="text" class="form-control" name="calle" placeholder="Calle" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="num" class="font-weight-bold">Número <font color="red">*</font></label>
                              <input type="text" class="form-control" name="num" placeholder="#" required>
                            </div>                       
                            <div class="form-group col-md-6">
                              <label for="disc" class="font-weight-bold">Discapacidad <font color="red">*</font></label>
                              <select name="discap" class="form-control" required>
                                <option value="No">No</option>
                                <option value="Si" >Si</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="curp" class="font-weight-bold">CURP <font color="red">*</font></label>
                              <input type="text" class="form-control" name="curp" placeholder="CURP" pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d)" title="Ingrese una CURP valida." required>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="comoentero" class="font-weight-bold">¿Cómo se enteró de la "Bolsa de Trabajo Para el Municipio de Lerma"? <font color="red">*</font></label>
                              <input type="text" class="form-control" name="comoentero" placeholder="¿Cómo se enteró de la Bolsa de Trabajo Para el Municipio de Lerma?" required>
                            </div>
                            <hr/>
                            <div class="form-group col-md-12">
                              <button type="submit" class="btn btn-primary">Guardar Datos</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>      
              </div>
              <!--applications-->
              <div class="tab-pane fade" id="v-pills-applications" role="tabpanel" aria-labelledby="v-pills-applications-tab">
                <div class="card">
                  <div class="card-header bg-white">
                    <h5 class="text-center font-weight-bold">Postulaciones</h5>
                  </div>
                  <div class="card-body">
                    <div class="card-content">
                      <ul class="list-unstyled">
                        <h4 align="center">Aún no te haz postulado a una vacante.</h4>
                        <hr>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Curriculum -->
              <div class="tab-pane fade" id="v-pills-cv" role="tabpanel" aria-labelledby="v-pills-cv-tab">
                <div class="card">
                  <div class="card-header bg-white">
                    <h5 class="text-center font-weight-bold">Mi Curriculum</h5>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <nav class="navbar navbar-expand-lg navbar-dark gradient-brand">
                        <div class="container">
                          <button class="navbar-toggler ri" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Menu">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarToggler"> 
                            <ul class="navbar-nav nav siguiente">
                              <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#esconoc">Escolaridad</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#sitlab">Situación laboral</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#perflab">Perfil laboral</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#puestodes">Puesto deseado</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </nav>
                      <form method="POST" action="{{ route('guardarcurriculum') }}" class="data-form">
                        @csrf
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div id="esconoc" class="container tab-pane active"><br>
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h5 class="font-weight-bold">Escolaridad.</h5>
                                <hr/>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="ultimogrado" class="font-weight-bold">Último grado de estudios: <font color="red">*</font></label>
                                <select name="ultimogrado" class="form-control" required>
                                  @foreach ($ultimosgr as $ultimogr)
                                      <option value='{{ $ultimogr->UltimoGrado }}'> {{ $ultimogr->UltimoGrado}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="carrera" class="font-weight-bold">Carera o Especialidad: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="carrera" placeholder="Carrera o especialidad" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="situacionacad" class="font-weight-bold">Situación académica: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="situacionacad"  value="Estudiante" checked>
                                  <label class="form-check-label" for="genero">Estudiante</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="situacionacad"  value="Diploma o certificado">
                                  <label class="form-check-label" for="genero">Diploma o certificado </label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="situacionacad" value="Trunca">
                                  <label class="form-check-label" for="genero">Trunca</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="situacionacad"  value="Pasante">
                                  <label class="form-check-label" for="genero">Pasante</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="situacionacad"  value="Titulado">
                                  <label class="form-check-label" for="genero">Titulado</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="idioma" class="font-weight-bold">Idioma: <font color="red">*</font></label>
                                <select name="idioma" class="form-control" required>
                                  @foreach ($idioma as $idio)
                                    <option value="{{$idio->Idioma}}">{{$idio->Idioma}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="dominioidio" class="font-weight-bold">Dominio: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="domidio"  value="Básico" checked>
                                  <label class="form-check-label" for="domidio">Básico</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="domidio"  value="Intermedio">
                                  <label class="form-check-label" for="domidio">Intermedio</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="domidio" value="Avanzado">
                                  <label class="form-check-label" for="domidio">Avanzado</label>
                                </div>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="conhab" class="font-weight-bold">Conocimientos específicos: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="conhabc" placeholder="Conocimientos específicos" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="conhab" class="font-weight-bold">Habilidades específicas: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="conhabh" placeholder="Habilidades específicas" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="cursos" class="font-weight-bold">Cursos y Certificaciones: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="cursos" placeholder="Cursos y certificaciones" required>
                              </div>
                              <hr/>
                              <div class="form-group col-md-12">
                                <button type="button" class="btn btn-primary btn-centered btnNext">Siguiente >></button>
                              </div>
                            </div>
                          </div>
                          <div id="sitlab" class="container tab-pane fade"><br>
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h5 class="font-weight-bold">Situación Laboral.</h5>
                                <hr/>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="trabajaact" class="font-weight-bold">Trabaja actualmente: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="trabajaact"  value="Si" checked>
                                  <label class="form-check-label" for="trabajaact">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="trabajaact"  value="No">
                                  <label class="form-check-label" for="trabajaact">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="motivo" class="font-weight-bold">Motivo: <font color="red">*</font></label>
                                <select name="motivo" class="form-control">
                                  @foreach ($motivos as $motivo)
                                      <option value='{{ $motivo->Motivo }}'> {{ $motivo->Motivo}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fechacombus" class="font-weight-bold">Fecha que comenzó a buscar empleo: <font color="red">*</font></label>
                                <input type="date" class="form-control" name="fechacombus" placeholder="" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="disponibilidad" class="font-weight-bold">Disponibilidad: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="disponibilidad"  value="Inmediata" checked>
                                  <label class="form-check-label" for="disponibilidadt">Inmediata</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="disponibilidad"  value="A convenir">
                                  <label class="form-check-label" for="disponibilidadt">A convenir</label>
                                </div>
                              </div>
                              <hr/>
                              <div class="form-group col-md-12">
                                <button type="button" class="btn btn-primary btn-centered btnPrevious"><< Anterior</button>
                                <button type="button" class="btn btn-primary btn-centered btnNext">Siguiente >></button>
                              </div>
                            </div>
                          </div>
                          <div id="perflab" class="container tab-pane fade"><br>
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h5 class="font-weight-bold">Perfil Laboral (Ultimo Puesto).</h5>
                                <hr/>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="nombrerazsoc" class="font-weight-bold">Nombre o Razón Social: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="nombrerazsoc" placeholder="Nombre o Razón Social" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="puestoocu" class="font-weight-bold">Título del puesto ocupado: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="puestoocu" placeholder="Título del puesto ocupado" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="funcrealiz" class="font-weight-bold">Funciones y actividades realizadas: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="funcrealiz" placeholder="Funciones y actividades realizadas" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="salario" class="font-weight-bold">Salario mensual: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="salario" placeholder="$" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="tipoempleo" class="font-weight-bold">Tipo de empleo: <font color="red">*</font></label>
                                <select name="tipoempleo" class="form-control" required>
                                  @foreach ($tiposemp as $tipoemp)
                                    <option value='{{ $tipoemp->TipoEmpleo }}'> {{ $tipoemp->TipoEmpleo }}</option>
                                  @endforeach
                                </select>
                              </div>  
                              <div class="form-group col-md-6">
                                <label for="fechaingr" class="font-weight-bold">Fecha de Ingreso: <font color="red">*</font></label>
                                <input type="date" class="form-control" name="fechaingr" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fechasep" class="font-weight-bold">Fecha de Separación: <font color="red">*</font></label>
                                <input type="date" class="form-control" name="fechasep" required>
                              </div>
                              <hr/> 
                              <div class="form-group col-md-12">
                                <button type="button" class="btn btn-primary btn-centered btnPrevious"><< Anterior</button>
                                <button type="button" class="btn btn-primary btn-centered btnNext">Siguiente >></button>
                              </div>
                            </div>
                          </div>
                          <div id="puestodes" class="container tab-pane fade"><br> 
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h5 class="font-weight-bold">Puesto Deseado.</h5>
                                <hr/>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="puestodeseado" class="font-weight-bold">Puesto deseado: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="puestodeseado" placeholder="Puesto deseado" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="ocupacion" class="font-weight-bold">Ocupación: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="ocupacion" placeholder="Ocupación" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exppuesto" class="font-weight-bold">Experiencia en el puesto: <font color="red">*</font></label>
                                <select name="exppuesto" class="form-control" required>
                                  @foreach ($exppuestos as $exppuesto)
                                    <option value='{{ $exppuesto->ExpPuesto }}'> {{ $exppuesto->ExpPuesto }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="tipoempleo" class="font-weight-bold">Tipo de empleo deseado: <font color="red">*</font></label>
                                <select name="tipoempleo" class="form-control" required>
                                  @foreach ($tiposemp as $tipoemp)
                                    <option value='{{ $tipoemp->TipoEmpleo }}'> {{ $tipoemp->TipoEmpleo }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="salariopre" class="font-weight-bold">Salario mensual pretendido: <font color="red">*</font></label>
                                <input type="text" class="form-control" name="salariopre" placeholder="$" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="dispviajar" class="font-weight-bold">Disponibilidad para viajar: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="dispviajar"  value="Si" checked>
                                  <label class="form-check-label" for="dispviajar">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="dispviajar"  value="No">
                                  <label class="form-check-label" for="dispviajar">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="dispcamres" class="font-weight-bold">Disponibilidad para radicar fuera: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="dispcamres"  value="Si" checked>
                                  <label class="form-check-label" for="dispcamres">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="dispcamres"  value="No">
                                  <label class="form-check-label" for="dispcamres">No</label>
                                </div>
                              </div>
                              <hr/>
                              <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar Datos</button>
                              </div>
                            </div>  
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Search -->
    <section class="bg-light"> 
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-8">
            <form action="{{ route('buscar') }}" class="row data-form form-search bg-light" method="GET">    
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="searchText">¿Qué trabajo buscas?</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-briefcase"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" id="vacantes" name="titulo_puesto" placeholder="Puesto o Área Deseada">
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group ">
                  <label for="searchCity">¿Dónde?</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-map-marker-alt"></i>
                      </div>
                    </div>
                    <input class="form-control" id="municipio" name="lugar_vacante" placeholder="Municipio, Colonia o Ciudad">
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
                  </div>
                </div>
              </div>
            </form>
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
              <h5 class="text-uppercase pb-1">Contáctanos</h5>
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
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
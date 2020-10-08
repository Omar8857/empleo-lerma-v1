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
              <a id="navbarDropdown" class=" btn dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
          <h4 class="ml-4 lerma">Empresa: {{Auth::user()->nombre}}</h4>
        </div>
        <!--menu-->
        <div class="col-12 col-md-4">
          <div class="nav flex-column nav-pills shadow m-4 bg-white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Cuenta</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Datos Empresariales</a>
            <a class="nav-link" id="v-pills-applications-tab" data-toggle="pill" href="#v-pills-applications" role="tab" aria-controls="v-pills-applications" aria-selected="false">Postulados</a>
            <a class="nav-link" id="v-pills-vacancies-tab" data-toggle="pill" href="#v-pills-vacancies" role="tab" aria-controls="v-pills-vacancies" aria-selected="false">Vacantes</a>
          </div>
        </div>
        <div class="col-12 col-md-8">
          <div class="tab-content m-4" id="v-pills-tabContent">
            <!--home-->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="card">
                    <div class="card-header bg-white">
                      <h5 class="text-center font-weight-bold">Datos de Contacto</h5>
                    </div>
                    <div class="card-body">
                      <ul class="list-group">
                        <li class="list-group-item"><small>Telefono:</small> <span>{{Auth::user()->telefono}}</span></li>
                        <li class="list-group-item"><small>Email:</small> <span>{{Auth::user()->email}}</span></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="card">
                    <div class="card-header bg-white">
                      <h5 class="text-center font-weight-bold">Resumen</h5>
                    </div>
                    <div class="card-body">
                      <ul class="list-group">
                        <li class="list-group-item"><small>Vacantes Publicadas:</small>   <span>@if($empresa) {{$contadorp}} @else 0 @endif</span></li>
                        <li class="list-group-item"><small>Postulaciones Recibidas:</small> <span>@if($empresa) {{$contadorc}} @else 0 @endif</span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header bg-white">
                  <h5 class="text-center font-weight-bold">Postulaciones Recientes</h5>
                </div>
                <div class="card-body">
                  <div class="card-content">
                    <ul class="list-unstyled">
                      @empty($postulantes)
                        <h4 align="center">Nadie se ha postulado aún.</h4>
                      @else
                        @foreach($postulantes as $postulacion)
                          <div class="media mb-4">
                            <img src="archivo/{{$postulacion->foto_perfil}}" width="100px" height="100px" class="mr-3 shadow" alt="...">
                            <div class="media-body">
                              <h5><small class="float-right txt-info">$ {{$postulacion->salario_mensual}}</small></h5>
                              <a href="#">
                                <h5>Nombre: {{$postulacion->nombre_completo}}</h5>
                              </a>
                              <a href="{{ route('vacante', $postulacion->slug) }}">
                                <h6>Vacante: {{$postulacion->titulo_puesto}}</h6>
                              </a>
                              <div class="form-row" align="center">
                                <div class="form-group col-md-6">
                                  <a class="btn btn-primary btn-block" href="{{ route('cvuserpdf', $postulacion->nombre_completo) }}" target="_blank" >Descargar CV</a>
                                </div>
                                <div class="form-group col-md-6">
                                  <form method="POST" action="{{route('contacto')}}">
                                    @csrf
                                    <input type="hidden" name="email" value="{{$postulacion->email}}">
                                    <input type="hidden" name="nomemp" value="{{Auth::user()->nombre}}">
                                    <input type="hidden" name="postulacion" value="{{$postulacion->id_postulacion}}">
                                    <input type="submit" class="btn btn-primary btn-block" value="Contactar Postulante">
                                  </form>
                                  <!-- <a class="btn btn-primary col-md-5" href="{{ route('correo', $postulacion->email ) }}" target="_blank">Contactar postulante</a> -->
                                </div>
                              </div>
                              <small class="txt-accent"><span>{{$postulacion->lugar_vacante}}</span> / <span> hace 3 min</span></small>                
                            </div>
                          </div>
                          <hr>
                        @endforeach
                      @endempty
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--profile-->
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <div class="card">
                <div class="card-header bg-white">
                  <h5 class="text-center font-weight-bold">Datos Empresariales</h5>
                </div>
                @if($empresa)
                  <div class="card-body">
                    <div class="container">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs justify-content-center navbar-light bg-light gradient-brand" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active font-weight-bold" style="color:white;" data-toggle="tab" href="#verdatos">Ver Datos</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link font-weight-bold" style="color:white;" data-toggle="tab" href="#modificardatos">Editar Datos</a>
                        </li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div id="verdatos" class="container tab-pane active"><br>
                          <!-- form profile -->
                          <div class="form-row data-form" align="center">
                            <div class="form-group col-md-12">
                              <label for="photoUser">Foto de Perfil</label><br> 
                              <img style="border-radius:150px;" width="130px" height="130px" src="{{asset('archivo/'.$empresa->foto_perfil)}}" alt="{{$empresa->foto_perfil}}">
                            </div>
                              <hr/>
                            <div class="form-group col-md-8">
                              <label for="userName">Nombre o Razón Social</label>
                              <input type="text" readonly class="form-control" id="companyName" name="companyName" placeholder="Nombre o Razón Social" value="{{$empresa->nombre_RS}}" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="userName">RFC</label>
                              <input type="text" readonly class="form-control" id="CompanyRFC" name="CompanyRFC" placeholder="RFC" value="{{$empresa->RFC}}" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="stateUser">Estado</label>
                              <input type="text" readonly class="form-control" id="stateCompany" name="stateCompany" placeholder="Estado" value="{{$empresa->estado}}" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="cityUser">Municipio</label>
                              <input type="text" readonly class="form-control" id="cityCompany" name="cityCompany" placeholder="Municipio" value="{{$empresa->municipio}}" required>
                            </div>
                            <div class="form-group col-md-8">
                              <label for="villageUser">Colonia</label>
                              <input type="text" readonly class="form-control" id="coloniaCompany" name="coloniaCompany" placeholder="Colonia" value="{{$empresa->colonia}}" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="cpUser">Código Postal</label>
                              <input type="number" readonly class="form-control" id="cpCompany" name="cpCompany" placeholder="Código Postal" value="{{$empresa->CP}}" required> 
                            </div> 
                              <div class="form-group col-md-8">
                                <label for="villageUser">Calle</label>
                                <input type="text" readonly class="form-control" id="calleCompany" name="calleCompany" placeholder="Calle" value="{{$empresa->calle}}" required>
                            </div> 
                            <div class="form-group col-md-4">
                              <label for="villageUser">Número</label>
                              <input type="text" readonly class="form-control" id="numeroCompany" name="numeroCompany" placeholder="Número" value="{{$empresa->numero}}" required>
                            </div> 
                            <div class="form-group col-md-6">
                              <label for="phoneUser">Teléfono 1</label>
                              <input type="number" readonly class="form-control" id="phoneUser1" name="phoneUser1" placeholder="Teléfono 1" value="{{$empresa->tel1}}" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="phoneUser">Teléfono 2</label>
                              <input type="number" readonly class="form-control" id="phoneUser2" name="phoneUser2" placeholder="Teléfono 2" value="{{$empresa->tel2}}" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="email">Correo Electrónico</label>
                              <input type="text" readonly class="form-control" id="emailCompany" name="emailCompany" placeholder="Correo Electrónico" value="{{$empresa->email}}" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="pagElectronica">Página Electrónica</label>
                              <input type="text" readonly class="form-control" id="pagElectronica" name="pagElectronica" placeholder="Página Electrónica" value="{{$empresa->pagina_electronica}}" required>
                            </div>
                            <div class="form-group col-md-8">
                              <label for="acteco">Actividad Económica</label>
                              <input type="text" readonly class="form-control" id="acteco" name="acteco" placeholder="Actividad Económica" value="{{$empresa->actividad_economica}}" required> 
                            </div>
                            <div class="form-group col-md-4">
                              <label for="numemple">Número de Empleados</label>
                              <input type="text" readonly class="form-control" id="numemple" name="numemple" placeholder="Número de Empleados" value="{{$empresa->numero_empleados}}" required>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="ComoSeEnt">¿Cómo Se Entero De La "Bolsa de Trabajo Para el Municipio de Lerma"?</label>
                              <input type="text"readonly class="form-control" id="ComoSeEnt" name="ComoSeEnt" placeholder="¿Cómo Se Entero De La Bolsa de Trabajo Para el Municipio de Lerma?" value="{{$empresa->ComoSeEnt}}" required> 
                            </div>
                          </div>
                        </div>
                        <div id="modificardatos" class="container tab-pane fade"><br>
                          <!-- form profile -->
                          {{Form::open(['route' => 'modificardatosemp','files' => true, 'class' => 'data-form'])}}
                            @csrf
                            <input type="hidden" name='actual' value="{{$empresa->foto_perfil}}">
                            <div class="form-row" align="center">
                              <div class="form-row" align="center">
                                <div class="form-group col-md-6">
                                  <label for="photoUser" class="font-weight-bold">Foto Actual</label><br>
                                  <img style="border-radius:150px;" width="130px" height="130px" src="{{asset('archivo/'.$empresa->foto_perfil)}}" alt="{{ $empresa->foto_perfil }}">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="photoUser" class="font-weight-bold">Foto Nueva (Opcional)</label><br>
                                  <input type="file" name="photoCompany" id="photoCompany" accept=".jpg,.jpeg,.png" title="Solo imagenes con extensión: jpg, jpeg, png">
                                </div> 
                              </div>
                                <hr/>
                              <div class="form-group col-md-8">
                                <label for="userName">Nombre o Razón Social</label>
                                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Nombre o Razón Social" value="{{$empresa->nombre_RS}}" required>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="userName">RFC</label>
                                <input type="text" class="form-control" id="CompanyRFC" name="CompanyRFC" placeholder="RFC" pattern="([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))((-)?([A-Z\d]{3}))" title="Ingrese un RFC valido." value="{{$empresa->RFC}}" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="stateUser">Estado</label>
                                <select name="entfed" id="entfed" class="form-control" required>
                                @foreach ($ents as $ent)
                                    @if($ent->EntFed == $empresa->estado)
                                          <option value='{{ $ent->EntFed }}' selected> {{ $ent->EntFed }}</option>
                                        @else
                                          <option value='{{ $ent->EntFed }}'> {{ $ent->EntFed }}</option>
                                    @endif
                                @endforeach
                              </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="cityUser">Municipio</label>
                                <select name="municipio" id="municipio" class="form-control" required>
                                  @foreach ($municipios as $municipio)
                                    @if($municipio->Municipio == $empresa->municipio)
                                          <option value='{{ $municipio->Municipio }}' selected> {{ $municipio->Municipio }}</option>
                                        @else
                                          <option value='{{ $municipio->Municipio }}'> {{ $municipio->Municipio }}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-8">
                                <label for="villageUser">Colonia</label>
                                <input type="text" class="form-control" id="coloniaCompany" name="coloniaCompany" placeholder="Colonia" value="{{$empresa->colonia}}" required>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="cpUser">Código Postal</label>
                                <input type="text" class="form-control" id="cpCompany" name="cpCompany" placeholder="Código Postal" value="{{$empresa->CP}}" pattern="[0-9]{5}" title="Ingrese Código Postal a 5 digitos" required> 
                              </div> 
                              <div class="form-group col-md-8">
                                <label for="villageUser">Calle</label>
                                <input type="text" class="form-control" id="calleCompany" name="calleCompany" placeholder="Calle" value="{{$empresa->calle}}" required>
                              </div> 
                              <div class="form-group col-md-4">
                                <label for="villageUser">Número</label>
                                <input type="text" class="form-control" id="numeroCompany" name="numeroCompany" placeholder="Número" value="{{$empresa->numero}}" required>
                              </div> 
                              <div class="form-group col-md-6">
                                <label for="phoneUser">Teléfono 1</label>
                                <input type="tel" class="form-control" id="phoneUser1" name="phoneUser1" placeholder="Teléfono 1" value="{{$empresa->tel1}}" pattern="[0-9]{10}" title="Ingrese número a 10 dígitos" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="phoneUser">Teléfono 2</label>
                                <input type="tel" class="form-control" id="phoneUser2" name="phoneUser2" placeholder="Teléfono 2" value="{{$empresa->tel2}}" pattern="[0-9]{10}" title="Ingrese número a 10 dígitos" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" id="emailCompany" name="emailCompany" placeholder="Correo Electrónico" value="{{$empresa->email}}" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="pagElectronica">Página Electrónica</label>
                                <input type="text" class="form-control" id="pagElectronica" name="pagElectronica" placeholder="Página Electrónica" value="{{$empresa->pagina_electronica}}" required>
                              </div>
                              <div class="form-group col-md-8">
                                <label for="acteco">Actividad Económica</label>
                                <input type="text" class="form-control" id="acteco" name="acteco" placeholder="Actividad Económica" value="{{$empresa->actividad_economica}}" required> 
                              </div>
                              <div class="form-group col-md-4">
                                <label for="numemple">Número de Empleados</label>
                                <input type="number" class="form-control" id="numemple" name="numemple" placeholder="Número de Empleados" value="{{$empresa->numero_empleados}}" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="ComoSeEnt">¿Cómo Se Entero De La "Bolsa de Trabajo Para el Municipio de Lerma"?</label>
                                <input type="text" class="form-control" id="ComoSeEnt" name="ComoSeEnt" placeholder="¿Cómo Se Entero De La Bolsa de Trabajo Para el Municipio de Lerma?" value="{{$empresa->ComoSeEnt}}" required> 
                              </div>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="card-body">
                    <!-- form profile -->
                    {{Form::open(['route' => 'guardardatosemp','files' => true, 'class' => 'data-form'])}}
                      @csrf
                      <div class="form-row" align="center">
                        <div class="form-group col-md-12">
                          <label for="photoUser">Foto de Perfil</label><br> 
                          <input type="file" name="photoCompany" id="photoCompany" accept=".jpg,.jpeg,.png" title="Solo imagenes con extensión: jpg, jpeg, png" required>
                        </div>
                          <hr/>
                        <div class="form-group col-md-8">
                          <label for="userName">Nombre o Razón Social</label>
                          <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Nombre o Razón Social" value="{{old('companyName',Auth::user()->nombre)}}" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="userName">RFC</label>
                          <input type="text" class="form-control" id="CompanyRFC" name="CompanyRFC" placeholder="RFC" pattern="([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))((-)?([A-Z\d]{3}))" title="Ingrese un RFC valido." required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="entfed">Estado</label>
                          <select name="entfed" id="entfed" class="form-control" required>
                            <option disabled>Selecciona</option>
                            @foreach ($ents as $ent)
                              <option value='{{ $ent->EntFed }}'> {{ $ent->EntFed }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="cityUser">Municipio</label>
                          <select name="municipio" id="municipio" class="form-control" required>
                            @foreach ($municipios as $municipio)
                              <option value='{{ $municipio->Municipio }}'> {{ $municipio->Municipio }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="villageUser">Colonia</label>
                          <input type="text" class="form-control" id="coloniaCompany" name="coloniaCompany" placeholder="Colonia" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="cpUser">Código Postal</label>
                          <input type="text" class="form-control" id="cpCompany" name="cpCompany" placeholder="Código Postal" pattern="[0-9]{5}" title="Ingrese Código Postal a 5 digitos" required> 
                        </div> 
                        <div class="form-group col-md-8">
                          <label for="villageUser">Calle</label>
                          <input type="text" class="form-control" id="calleCompany" name="calleCompany" placeholder="Calle" required>
                        </div> 
                        <div class="form-group col-md-4">
                          <label for="villageUser">Número</label>
                          <input type="text" class="form-control" id="numeroCompany" name="numeroCompany" placeholder="Número" required>
                        </div> 
                        <div class="form-group col-md-6">
                          <label for="phoneUser">Teléfono 1</label>
                          <input type="tel" class="form-control" id="phoneUser1" name="phoneUser1" placeholder="Teléfono 1" pattern="[0-9]{10}" title="Ingrese número a 10 dígitos" value="{{old('phoneUser1',Auth::user()->telefono)}}" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="phoneUser">Teléfono 2</label>
                          <input type="tel" class="form-control" id="phoneUser2" name="phoneUser2" placeholder="Teléfono 2" pattern="[0-9]{10}" title="Ingrese número a 10 dígitos" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="email">Correo Electrónico</label>
                          <input type="email" class="form-control" id="emailCompany" name="emailCompany" placeholder="Correo Electrónico" value="{{old('emailCompany',Auth::user()->email)}}" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="pagElectronica">Página Electrónica</label>
                          <input type="text" class="form-control" id="pagElectronica" name="pagElectronica" placeholder="Página Electrónica" required>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="acteco">Actividad Económica</label>
                          <input type="text" class="form-control" id="acteco" name="acteco" placeholder="Actividad Económica" required> 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="numemple">Número de Empleados</label>
                          <input type="number" class="form-control" id="numemple" name="numemple" placeholder="Número de Empleados" required>
                        </div>
                        <div class="form-group col-md-12">
                          <label for="ComoSeEnt">¿Cómo Se Entero De La "Bolsa de Trabajo Para el Municipio de Lerma"?</label>
                          <input type="text" class="form-control" id="ComoSeEnt" name="ComoSeEnt" placeholder="¿Cómo Se Entero De La Bolsa de Trabajo Para el Municipio de Lerma?" required> 
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                @endif
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
                     @empty($postulantes)
                        <h4 align="center">Nadie se ha postulado aún.</h4>
                      @else
                        @foreach($postulants as $postulacion)
                          <div class="media mb-4">
                            <img src="archivo/{{$postulacion->foto_perfil}}" width="100px" height="100px" class="mr-3 shadow" alt="...">
                            <div class="media-body">
                              <h5><small class="float-right txt-info">$ {{$postulacion->salario_mensual}}</small></h5>
                              <a href="#">
                                <h5>Nombre: {{$postulacion->nombre_completo}}</h5>
                              </a>
                              <a href="{{ route('vacante', $postulacion->slug) }}">
                                <h6>Vacante: {{$postulacion->titulo_puesto}}</h6>
                              </a>
                              <div class="form-row" align="center">
                                <div class="form-group col-md-6">
                                  <a class="btn btn-primary btn-block" href="{{ route('cvuserpdf', $postulacion->nombre_completo) }}" target="_blank">Descargar CV</a>
                                </div>
                                <div class="form-group col-md-6">
                                  <form method="POST" action="{{route('contacto')}}">
                                    @csrf
                                    <input type="hidden" name="email" value="{{$postulacion->email}}">
                                    <input type="hidden" name="nomemp" value="{{Auth::user()->nombre}}">
                                    <input type="hidden" name="postulacion" value="{{$postulacion->id_postulacion}}">
                                    <input type="submit" class="btn btn-primary btn-block" value="Contactar Postulante">
                                  </form>
                                  <!-- <a class="btn btn-primary col-md-5" href="{{ route('correo', $postulacion->email ) }}" target="_blank">Contactar postulante</a> -->
                                </div>
                              </div>
                              <small class="txt-accent"><span>{{$postulacion->lugar_vacante}}</span> / <span> hace 3 min</span></small>                
                            </div>
                          </div>
                          <hr>
                        @endforeach
                      @endempty
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Vacancies -->
            <div class="tab-pane fade" id="v-pills-vacancies" role="tabpanel" aria-labelledby="v-pills-vacancies-tab">
              <div class="card">
                <div class="card-header bg-white">
                  <h5 class="text-center font-weight-bold">Vacantes</h5>
                </div>
                @if($empresa)
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">Nueva Vacante</button>
                @else
                  <h5 align="center">Aún no puedes publicar, completa los datos empresariales.</h5> 
                  <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter" disabled>Nueva Vacante</button>
                @endif
                <div class="card-body">
                  <div class="card-content">
                    <ul class="list-unstyled">
                      @if($empresa)
                        @isset($vacantes)
                          @foreach ($vacantes as $vacante)
                            <a href="{{ route('vacante', $vacante->slug) }}" class="media mb-4">
                              <img src="archivo/{{$vacante->foto_perfil}}" width="100px" height="100px" class="mr-3 shadow" alt="">
                              <div class="media-body">
                                <h5><small class="float-right txt-info">${{$vacante->salario_mensual}}</small></h5>
                                <h5>{{$vacante->titulo_puesto}}</h5>
                                <p>{{$vacante->descripcion_breve}}</p>
                                <small class="txt-accent"><span>{{$vacante->lugar_vacante}}</span> / <span> {{date('d-m-o  h:i a', strtotime($vacante->fecha))}}</span></small>                
                              </div>
                            </a>
                            <hr> 
                          @endforeach
                          {{ $vacantes->appends(request()->query())->links() }}
                        @else 
                          <h5 align="center">No hay vacantes para mostrar.</h5> 
                        @endisset
                      @else
                        <h5 align="center">No hay vacantes para mostrar.</h5>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Modal con notificación para iniciar sesión -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header gradient-brand">
                      <h5 class="modal-title" style="color:white" id="exampleModalLongTitle">Formulario de Nueva Vacante.</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white" aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      {{Form::open(['route' => 'guardarvacante', 'class' => 'data-form'])}}
                        @csrf
                        <nav class="navbar navbar-expand-lg navbar-dark gradient-brand">
                          <div class="container">
                            <button class="navbar-toggler ri" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Menu">
                              <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarToggler"> 
                              <ul class="navbar-nav nav siguiente">
                                <li class="nav-item">
                                  <a class="nav-link active" data-toggle="tab" href="#datosvacante">Datos de la Vacante</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#requisitos">Requisitos de la Vacante</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#infocontacto">Información de Contacto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#fechayp">Publicación</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </nav>
                        <div class="tab-content">
                          <div id="datosvacante" class="container tab-pane active"><br>
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h4 class="font-weight-bold">Datos de la Vacante</h4>
                                <hr/>
                              </div>    
                              <div class="form-group col-md-12">   
                                <label for="title" class="font-weight-bold">Título del puesto: <font color="red">*</font></label>
                                <input type="text" class="form-control" id="title" name="title" Placeholder="Título del puesto" required>
                              </div>
                              <div class="form-group col-md-12">   
                                <label for="description" class="font-weight-bold">Breve Descipción: <font color="red">*</font></label>
                                <input type="text" class="form-control" id="description" name="description" Placeholder="Descripción breve del puesto" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="FuncionActividad" class="font-weight-bold">Funciones y actividades a relizar: <font color="red">*</font></label><br>
                                <input type="text" class="form-control" name="FuncionActividad" placeholder="Funciones y actividades a realizar" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="conocimientos" class="font-weight-bold">Conocimientos requeridos: <font color="red">*</font></label><br>
                                <input type="text" class="form-control" name="conocimientos" placeholder="Conocimientos requeridos" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="habilidades" class="font-weight-bold">Habilidades requeridas: <font color="red">*</font></label><br>
                                <input type="text" class="form-control" name="habilidades" placeholder="Habilidades requeridas" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="direccion" class="font-weight-bold">Dirección donde se ubica la vacante: <font color="red">*</font></label><br>
                                <input type="text" class="form-control" name="direccioncompleta" placeholder="Colonia, calle, número, etc" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="tipoempleo" class="font-weight-bold">Tipo de empleo: <font color="red">*</font></label>
                                <select id="TipoEmpleo" name="tipoempleo" class="form-control" required>
                                  @foreach ($tiposemp as $tipoemp)
                                    <option value='{{ $tipoemp->TipoEmpleo }}'> {{ $tipoemp->TipoEmpleo }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="salario" class="font-weight-bold">Salario mensual ofrecido: <font color="red">*</font></label>
                                <input type="text" class="form-control" id="salario" name="salario" Placeholder="$" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="ubicacion" class="font-weight-bold">Municipio donde de ubica la vacante: <font color="red">*</font></label>
                                <select name="ubicacion" id="ubicacion" class="form-control" required>
                                  <option disabled>Selecciona</option>
                                  @foreach ($munvacante as $mun)
                                    <option value='{{ $mun->Municipio }}'> {{ $mun->Municipio }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="diaslaboral" class="font-weight-bold">Días a laborar: <font color="red">*</font></label>
                                <input type="text" class="form-control" id="DiasLaboral" name="DiasLaboral" Placeholder="Días a laborar" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="entrada" class="font-weight-bold">Hora de entrada: <font color="red">*</font></label>
                                <input type="time" class="form-control" id="entrada" name="entrada" Placeholder="Hora de entrada" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="salida" class="font-weight-bold">Hora de salida: <font color="red">*</font></label>
                                <input type="time" class="form-control" id="salida" name="salida" Placeholder="Hora de salida" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="plazas" class="font-weight-bold">Número de plazas: <font color="red">*</font></label>
                                <input type="number"  class="form-control" id="NumPlazas" name="NumPlazas" Placeholder="Numero de plazas" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="vigencia" class="font-weight-bold">Vigencia de la vacante: <font color="red">*</font></label>
                                <input type="date" class="form-control" id="VigenciaVacante" name="VigenciaVacante" Placeholder="Vigencia de la vacante" required>
                              </div>
                                <hr/>
                              <div class="form-group col-md-12">
                                  <button type="button" class="btn btn-primary btn-centered btnNext">Siguiente >></button>
                              </div>
                            </div>
                          </div>
                          <div id="requisitos" class="container tab-pane"><br>
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h4 class="font-weight-bold">Requisitos de la Vacante</h4>
                                <hr/>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="discapacidad" class="font-weight-bold">¿Acepta personas con discapacidad? <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="discapacidad"  value="Si" checked>
                                  <label class="form-check-label" for="discapacidad">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="discapacidad"  value="No">
                                  <label class="form-check-label" for="discapacidad">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="MenDiscapacidad" class="font-weight-bold">Mencione que discapacidad <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="MenDiscapacidad" name="MenDiscapacidad" Placeholder="Mencione que discapacidad" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="AdultoMayor" class="font-weight-bold">¿Acepta adultos mayores de 60 años? <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="AdultoMayor" required value="Si" checked>
                                  <label class="form-check-label" for="AdultoMayor">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="AdultoMayor"  value="No">
                                  <label class="form-check-label" for="AdultoMayor">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="CausaVacante" class="font-weight-bold">Causa que origina la vacante <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="CausaVacante" name="CausaVacante" Placeholder="Causa que origina la vacante" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="escolaridad" class="font-weight-bold">Escolaridad: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="escolaridad" name="escolaridad" Placeholder="Escolaridad" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="CarreraEspe" class="font-weight-bold">Carrera o Especialidad: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="CarreraEspe" name="CarreraEspe" Placeholder="Carrera o Especialidad" required>
                              </div> 
                              <div class="form-group col-md-6">
                                <label for="idioma" class="font-weight-bold">Situación Académica: <font color="red">*</font></label>
                                <select name="SituAcademica" class="form-control" required>
                                  <option disabled>Seleccione una opción</option>
                                  <option value="Estudiante">Estudiante</option>
                                  <option value="Diploma o certificado">Diploma o certificado</option>
                                  <option value="Trunca">Trunca</option>
                                  <option value="Pasante">Pasante</option>
                                  <option value="Titulado">Titulado</option>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="ExpeMin" class="font-weight-bold">Experiencia mínima requerida: <font color="red">*</font></label>
                                <select name="exppuesto" class="form-control" required>
                                  @foreach ($exppuestos as $exppuesto)
                                    <option value='{{ $exppuesto->ExpPuesto }}'> {{ $exppuesto->ExpPuesto }}</option>
                                  @endforeach
                                </select>
                              </div> 
                              <div class="form-group col-md-6">
                                <label for="rango" class="font-weight-bold">Rango de edad: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <p>De</p>
                                </div>
                                <div class="form-check form-check-inline col-md-3">
                                  <input type="number"  class="form-control" id="EdadMinima" name="EdadMinima" Placeholder="Min." required>
                                </div>
                                <div class="form-check form-check-inline">
                                  <p>A</p>
                                </div>
                                <div class="form-check form-check-inline col-md-3">
                                  <input type="number"  class="form-control" id="EdadMaxima" name="EdadMaxima" Placeholder="Max." required>
                                </div>
                              </div> 
                              <div class="form-group col-md-6">
                                <label for="idioma" class="font-weight-bold">Idioma Requerido: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="idioma" name="idioma" Placeholder="Idioma Requerido" required>
                              </div> 
                              <div class="form-group col-md-6">
                                <label for="computacion" class="font-weight-bold">¿Requiere conocimientos en computación? <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="computacion" required value="Si" checked>
                                  <label class="form-check-label" for="computacion">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="computacion"  value="No">
                                  <label class="form-check-label" for="computacion">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="genero" class="font-weight-bold">Género <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="genero"  value="Hmbre" checked>
                                  <label class="form-check-label" for="genero">Hombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="genero"  value="Mujer">
                                  <label class="form-check-label" for="genero">Mujer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="genero"  value="Indistinto">
                                  <label class="form-check-label" for="genero">Indistinto</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="RadicarFuera" class="font-weight-bold">¿Requiere disponibilidad para radicar fuera? <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="RadicarFuera"  value="Si" checked>
                                  <label class="form-check-label" for="RadicarFuera">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="RadicarFuera"  value="No">
                                  <label class="form-check-label" for="RadicarFuera">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="DispoViajar" class="font-weight-bold">¿Requiere disponibilidad para viajar? <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="DispoViajar"  value="Si" checked>
                                  <label class="form-check-label" for="DsipoViajar">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="DispoViajar"  value="No">
                                  <label class="form-check-label" for="DispoViajar">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="prestaciones" class="font-weight-bold">Otras prestaciones: </label><br>
                                <input type="text" class="form-control" name="prestaciones" placeholder="Otras prestaciones">
                              </div>
                              <div class="form-group col-md-12">
                                <label for="observaciones" class="font-weight-bold">Observaciones:</label><br>
                                <input type="text" class="form-control" name="observaciones" placeholder="Observaciones">
                              </div>
                                <hr/>
                              <div class="form-group col-md-12">
                                <button type="button" class="btn btn-primary btn-centered btnPrevious"><< Anterior</button>
                                <button type="button" class="btn btn-primary btn-centered btnNext">Siguiente >></button>
                              </div>
                            </div>
                          </div>
                          <div id="infocontacto" class="container tab-pane"><br>
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h4 class="font-weight-bold">Información de Contacto</h4>
                                <hr/>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="nameC" class="font-weight-bold">Nombre: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="nameC" name="nameC" Placeholder="Nombre" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="Cargo" class="font-weight-bold">Cargo: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="Cargo" name="Cargo" Placeholder="Cargo" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="tel" class="font-weight-bold">Teléfono: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="tel" name="tel" Placeholder="Teléfono" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="email" class="font-weight-bold">Correo Electrónico: <font color="red">*</font></label>
                                <input type="email"  class="form-control" id="email" name="email" Placeholder="Correo electrónico" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="contacto" class="font-weight-bold">Medio Preferente contacto: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="contacto" name="contacto" Placeholder="Medio preferente de contacto" required>
                              </div>
                              <div class="form-group col-md-6">   
                                <label for="DiaEntrevista" class="font-weight-bold">Días de entrevista: <font color="red">*</font></label>
                                <input type="text"  class="form-control" id="" name="DiaEntrevista" Placeholder="Días de entrevista" required> 
                              </div>
                              <div class="form-group col-md-12">
                                <label for="rango" class="font-weight-bold">Horario de Entrevista: <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <p>De</p>
                                </div>
                                <div class="form-check form-check-inline col-md-5">
                                  <input type="time"  class="form-control" id="horaentrevista" name="HorarioInicial" Placeholder="Horario de entrevista" required>
                                </div>
                                <div class="form-check form-check-inline">
                                  <p>A</p>
                                </div>
                                <div class="form-check form-check-inline col-md-5">
                                <input type="time"  class="form-control" id="horaentrevista" name="HorarioFinal" Placeholder="Horario de entrevista" required>
                                </div>
                              </div>
                                <hr/>
                              <div class="form-group col-md-12">
                                <button type="button" class="btn btn-primary btn-centered btnPrevious"><< Anterior</button>
                                <button type="button" class="btn btn-primary btn-centered btnNext">Siguiente >></button>
                              </div>
                            </div>
                          </div>
                          <div id="fechayp" class="container tab-pane"><br>
                            <div class="form-row" align="center">
                              <div class="form-group col-md-12"> 
                                <h4 class="font-weight-bold">Publicación</h4>
                                <hr/>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="periodico" class="font-weight-bold">Periodico de ofertas <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="periodico"  value="Si" checked>
                                  <label class="form-check-label" for="periodico">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="periodico"  value="No">
                                  <label class="form-check-label" for="periodico">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="PortalEmpleo" class="font-weight-bold">Portal de empleo <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="PortalEmpleo"  value="Si" checked>
                                  <label class="form-check-label" for="PortalEmpleo">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="PortalEmpleo"  value="No">
                                  <label class="form-check-label" for="PortalEmpleo">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="FeriaEmpleo" class="font-weight-bold">Feria del Empleo <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="FeriaEmpleo"  value="Si" checked>
                                  <label class="form-check-label" for="feria">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="FeriaEmpleo"  value="No">
                                  <label class="form-check-label" for="FeriaEmpleo">No</label>
                                </div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="RadioMex" class="font-weight-bold">Radio Mexiquence <font color="red">*</font></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="RadioMex"  value="Si" checked>
                                  <label class="form-check-label" for="RadioMex">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="RadioMex"  value="No">
                                  <label class="form-check-label" for="RadioMex">No</label>
                                </div>
                              </div>
                              <hr/>
                              <div class="form-group col-md-12">
                                <button type="button" class="btn btn-primary btn-centered btnPrevious"><< Anterior</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Crear Vacante</button>
                      </form>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fin Modal -->
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
  <script src="https://kit.fontawesome.com/b2d5760d1d.js" crossorigin="anonymous"></script>  
</body>
</html>
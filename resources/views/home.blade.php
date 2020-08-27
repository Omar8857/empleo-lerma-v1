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
  <center>
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
  </center>
  <!-- Search -->
  <section> 
    <div class="container my-md-5">
      <figure class="bg-about">
        <img src="{{asset('assets/img/bg.jpg')}}" class="d-block w-100" alt="...">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-8 text-white text-center description">
            <h3>Empleo Lerma </h3>
            <p>Aquí encuentra mas de <span> 10,000</span> empleos..</p>
          </div>
        </div>
      </figure>
      <div class="row justify-content-md-center">
        <div class="col-12 col-md-8 shadow">     
          <form action="{{ route('buscar') }}" class="row data-form form-search mt-md-n6" method="GET">    
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
              <div class="form-group">
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
  <!--Companies-->
  <section class="bg-light">
    <div class="container my-md-5">
      <div class="row companies">
        <div class="col-12 col-md-4 text-center p-4">
          <h3 class="lerma px-4">Empresas con vacantes para ti</h3>
          <p>Estas son algunas empresas que tienen vacantes disponibles para ti</p>
        </div>
        <div class="col-12 col-md-8 p-4">
          <div class="card-columns">
            @foreach ($empresas as $empresa)
              <div class="card">
                <img class="card-img-top" src="{{asset('archivo/'.$empresa->foto_perfil)}}" width="100px" height="100px" alt="{{$empresa->nombre_RS}}" title="{{$empresa->nombre_RS}}">
              </div>
            @endforeach                
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Vacancies-->
  <section class="events my-5">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-12 text-center mb-4">
          <h3 class="lerma mb-5">Vacantes Recientes</h3>
        </div>
        <!-- filters-->
        <div class="col-12 col-md-4">
          <div class="mb-4">
            <div class="list-group">
              <li class="list-group-item bg-info text-white">
                <h5 class="text-center">Búsquedas Recientes</h5>  
              </li>
              @foreach ($recientes as $reciente)
              <a href="{{ route('vacante', $reciente->slug) }}" class="list-group-item list-group-item-action bg-light">{{$reciente->nombre_reciente}}</a>
              @endforeach
            </div>
          </div>
          <div class="mb-4">
            <div class="list-group">
              <li class="list-group-item bg-info text-white">
                <h5 class="text-center">Categorías</h5>
              </li>
              <a href="#" class="list-group-item list-group-item-action bg-light">Cras justo odio</a>
              <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-action bg-light">Morbi leo risus</a>
            </div>
          </div>
        </div>
        <!-- vacancies-->
        <div class="col-12 col-md-8">
          <div class="card-content">
            <ul class="list-unstyled">
              @foreach($vacantes as $vacante)
                <a href="{{ route('vacante', $vacante->slug) }}" class="media mb-4">
                  <img src="{{asset('archivo/'.$vacante->foto_perfil)}}" width="100px" height="100px" class="mr-3 shadow" alt="...">
                  <div class="media-body">
                    <h5><small class="float-right txt-info">$ {{$vacante->salario_mensual}}</small></h5>
                    <h5>{{$vacante->titulo_puesto}}</h5>
                    <p>{{$vacante->descripcion_breve}}.</p>
                    <small class="txt-accent"><span>{{$vacante->lugar_vacante}}</span> / <span> {{date('d-m-o  h:i a', strtotime($vacante->fecha))}}</span></small>                
                  </div>
                </a>
                <hr>
              @endforeach
            </ul>
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
@endsection

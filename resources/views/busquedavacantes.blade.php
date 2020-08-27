<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="{{asset('assets/css/src/style.min.css')}}">
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
    <!-- Search -->
    <section> 
      <div class="container my-md-5">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-8">
            <form action="{{ route('buscar') }}" class="row data-form form-search" method="GET">    
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="searchText">¿Qué trabajo buscas?</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-briefcase"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" id="vacantes" name="titulo_puesto" placeholder="Puesto o Área Deseada" value="{{old('titulo_puesto',$titulo)}}">
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
                    <input type="text" class="form-control" id="municipio" name="lugar_vacante" placeholder="Municipio, Colonia o Ciudad" value="{{old('lugar_vacante',$lugar)}}">
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
    <!--Vacancies-->
    <section class="events py-5 bg-light">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-12 text-center mb-4">
            <h3 class="lerma mb-5">Vacantes Encontradas</h3>
          </div>
          <!--Vacancies types-->
          <div class="col-12 col-md-4">  
            <div class="vacancies-filter shadow mb-4 mx-4">
              <div class="list-group">
                <li class="list-group-item bg-info text-white">
                  <h5 class="text-center">Tipos de Vacante</h5>
                </li>
                <a href="#" class="list-group-item list-group-item-action">
                  Cras justo odio</a>
                <a href="#" class="list-group-item list-group-item-action">
                  Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item list-group-item-action">
                  Morbi leo risus</a>
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
                    <h5>{{$vacante->titulo_puesto}}  <small class="float-right txt-info">$ {{$vacante->salario_mensual}}</small></h5>
                    <p>{{$vacante->descripcion_breve}}.</p>
                    <small class="txt-accent"><span>{{$vacante->lugar_vacante}}</span> / <span> {{date('d-m-o  h:i a', strtotime($vacante->fecha))}}</span></small>                
                    </div>
                  </a>
                  <hr>
                @endforeach
                  {{ $vacantes->appends(request()->query())->links() }}
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b2d5760d1d.js" crossorigin="anonymous"></script>
</body>
</html>
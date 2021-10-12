<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <!-- CSRF Token -->
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
  @laravelPWA
</head>

<body>
  @laravelPWA
  <!--header-->
  <header>
    <div class="brand text-center">
      <a href="{{url('/')}}">
        <img src="{{asset('assets/img/logos-lerma.png')}}" alt="lerma">
      </a>
    </div>
    <div class="social-icons">
      <div class="container">
        <nav class="navbar navbar-expand-md navbar-light p-0">
          <div class="btn"><i class="fas fa-user fa-sm pr-1"></i>@auth {{ Auth::user()->nombre }}@endauth</div>          
          <button style="border-color:white;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerAccount" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-ellipsis-h"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerAccount">
            <ul class="ml-auto p-0">
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
                <a href="{{ route('micuenta') }}" class="btn">{{ __('Mi Cuenta') }}</a>
              </li>
              <li><a class="btn" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                  {{ __('Cerrar Sesión') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
              @endguest
              <li class="facebook">
                <a href="https://www.facebook.com/Ayuntamiento-de-Lerma-467953823268730" class="s-i" target="_blank"></a>
              </li>
              <li class="youtube">
                <a href="https://www.youtube.com/channel/UC8IK9ozLAiYcvIftlzb1NWw" class="s-i" target="_blank"></a>
              </li>
          </div>
        </nav>
      </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark gradient-brand">
      <div class="container">
        <button class="navbar-toggler ri" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/busco_empleo">Busco Empleo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/ofrezco_empleo">Ofrezco Empleo</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  @yield('content')
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
            <i class="far fa-envelope fa-xs fa-footer pr-3"></i><a href="mailto:empleolerma@gmail.com" class="text-light">empleo.lerma@gmail.com</a><br>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/b2d5760d1d.js" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('scripts')
</body>

</html>
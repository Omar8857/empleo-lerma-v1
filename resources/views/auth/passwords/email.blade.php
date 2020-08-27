@extends('layouts.app')

@section('content')
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
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card" style="border-width: 1px; border-style: solid; border-color: black;">
          <div class="card-header gradient-brand" style="color: white;">
            <h5>{{ __('Para poder restablecer tu contraseña, ingresa la información necesaria que se te pide a continuación.') }}</h5>
          </div>
          <div class="card-body">
            <center>
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
            </center>
            <form method="POST" action="{{ route('password.email') }}" class="data-form">
              @csrf
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Ingrese su correo electrónico." autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <br>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Recuperar Contraseña') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br>
  <!--footer-->
  <footer>
    <div class="container-fluid bg-dark text-light">
      <div class="container">
        <div class="row py-5 justify-content-center">
          <div class="col-4 col-md-1">
            <img src="assets/img/lerma-footer.png" alt="" class="img-fluid">
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

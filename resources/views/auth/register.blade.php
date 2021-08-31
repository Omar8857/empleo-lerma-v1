@extends('layouts.register')
@section('content')
<body class="gradient-brand">
    <div class="container">
      <div class="row justify-content-md-center align-items-center vh-100">
        <div class="col-12 col-md-5 bg-white shadow p-4">
          <div class="brand text-center mb-2">
            <a href="{{url('/')}}">
              <img src="{{asset('assets/img/logos-lerma.png')}}" alt="lerma">
            </a> 
          </div>
          <form method="POST" action="{{ route('register') }}" class="data-form">
          @csrf
            <div class="form-group">
              <label for="typeUser" class="font-weight-bold">{{ __('Soy') }}</label>
              <select name="tipo_user" class="form-control" required>
                <option value="user">Ciudadano</option>
                <option value="company">Empresa</option>
              </select>
            </div>
            <div class="form-group">
              <label for="userName">{{ __('Nombre Completo') }}</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Escribe tu nombre completo" required autocomplete="name" aria-describedby="emailHelp">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="mailUser">{{ __('Correo Electrónico') }}</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Escribe tu correo electrónico" required autocomplete="email">
              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="phoneUser">{{ __('Teléfono') }}</label>
              <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ingresa tu número de teléfono" pattern="[0-9]{10}" title="Ingrese número a 10 dígitos" required autocomplete="telefono">
              <p id="errortelefono"></p>
              @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="passwdUser">{{ __('Contraseña') }}</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Escribe tu contraseña" required autocomplete="new-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="passwdUser">{{ __('Confirma tu Contraseña') }}</label>
              <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required placeholder="Vuelve a escribir tu contraseña" autocomplete="new-password">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="keepConnected" onclick="registrar.disabled = !this.checked">
              <label class="form-check-label" for="keepConnected">He leído y acepto la <a style="text-decoration-line: underline;" href="https://lerma.gob.mx/ayuntamiento/aviso-de-privacidad/" target="_blank">política de privacidad</a>.</label>
            </div>
            <button type="submit" name="registrar" class="btn btn-primary" disabled>Registrarme</button>
        </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b2d5760d1d.js" crossorigin="anonymous"></script>
@endsection

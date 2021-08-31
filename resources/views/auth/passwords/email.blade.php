
@extends('layouts.register')

@section('content')
<body class="gradient-brand">
  <div class="container">
    <div class="row justify-content-md-center align-items-center vh-100">
      <div class="col-12 col-md-7 bg-white shadow">
        <div class="brand text-center mb-2">
          <a href="{{url('/')}}">
            <img src="{{asset('assets/img/logos-lerma.png')}}" alt="lerma">
          </a> 
        </div>
        <div class="p-4">
          <h5 class="card-title">{{ __('Restablecer contraseña') }}</h5>
          <hr />
          @if (session('status'))
              <div class="alert alert-info" role="alert">
                {{ session('status') }}
              </div>
          @endif
          <p>{{ __('Para poder restablecer tu contraseña, ingresa la información necesaria que se te pide a continuación.') }}</p><br/>
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
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/b2d5760d1d.js" crossorigin="anonymous"></script>
</body>
@endsection

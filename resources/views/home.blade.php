@extends('layouts.base') 

@section('content')
  <center>
    @if (session('status'))
      <div class="alert alert-info" role="alert">
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
            <h3 class="font-weight-bolder">Portal de Empleo Lerma </h3>
						<p class="font-weight-light">
							Permite la publicación, promoción y vinculación de empleos promovidos por el gobierno local 
							para contribuir a la disminución de tasas de desempleo en el municipio de Lerma.	
						</p>
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
                <div class="input-group mb-0">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-map-marker-alt"></i>
                    </div>
                  </div>
                  <select class="form-control" id="municipio" name="lugar_vacante" aria-label="Municipio">
									  <option selected disabled>Municipio</option>
									  @foreach ($municipios as $municipio)
									  <option value="{{$municipio->lugar_vacante}}">{{$municipio->lugar_vacante}}</option>
									  @endforeach 
									</select>
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
                <div style="height: 100px; width: 100px; 
                                          background: url('{{asset('archivo/'.$empresa->foto_perfil)}}') no-repeat center center; 
                                          -webkit-background-size: contain;
                                          -moz-background-size: contain;
                                          -o-background-size: contain;
                                          background-size: contain;" alt="{{$empresa->nombre_RS}}" title="{{$empresa->nombre_RS}}"></div>
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
              <a href="#" class="list-group-item list-group-item-action bg-light">Tiempo Completo</a>
              <a href="#" class="list-group-item list-group-item-action">Medio Dia</a>
              <a href="#" class="list-group-item list-group-item-action bg-light">Nocturno</a>
            </div>
          </div>
        </div>
        <!-- vacancies-->
        <div class="col-12 col-md-8">
          <div class="card-content">
            <ul class="list-unstyled">
              @foreach($vacantes as $vacante)
                <a href="{{ route('vacante', $vacante->slug) }}" class="media mb-4">
                  <div style="height: 100px; width: 100px; 
                          background: url('{{asset('archivo/'.$vacante->foto_perfil)}}') no-repeat center center; 
                          -webkit-background-size: contain;
                          -moz-background-size: contain;
                          -o-background-size: contain;
                          background-size: contain;" class="mr-3 shadow" alt="{{$empresa->nombre_RS}}" title="{{$empresa->nombre_RS}}"></div>
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

@endsection

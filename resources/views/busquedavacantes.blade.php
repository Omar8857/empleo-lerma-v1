@extends('layouts.base') 

@section('content')
  <!--Vacancies-->
  <section class="events py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
          <h3 class="lerma mb-5">Vacantes Encontradas</h3>
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
                                          background-size: contain;"class="mr-3 shadow"></div>
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
@endsection
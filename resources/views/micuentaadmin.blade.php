@extends('layouts.base')

@section('content')
<!--Dashboard-->
<section class="events py-5">
  <div class="container">
    <div class="row justify-content-between">
      <!--username-->
      <div class="col-12">
        <h4 class="ml-4 lerma">Administrador: {{Auth::user()->nombre}}</h4>
      </div>
      <!--menu-->
      <div class="col-12 col-md-4">
        <div class="nav flex-column nav-pills shadow m-4 bg-white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Resumen</a>
          <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Usuarios</a>
          <a class="nav-link" id="v-pills-applications-tab" data-toggle="pill" href="#v-pills-applications" role="tab" aria-controls="v-pills-applications" aria-selected="false">Empresas</a>
          <a class="nav-link" id="v-pills-vacancies-tab" data-toggle="pill" href="#v-pills-vacancies" role="tab" aria-controls="v-pills-vacancies" aria-selected="false">Vacantes</a>
        </div>
      </div>
      <div class="col-12 col-md-8">
        <div class="tab-content m-4" id="v-pills-tabContent">
          <!--home-->
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <h5 class="text-center font-weight-bold">Resumen</h5>
            <hr>
            <div class="row row-cols-1 row-cols-md-3">
              <div class="col mb-4">
                <div class="card">
                  <div class="card-body text-center">
                    Usuarios Totales:
                    <h5 class="card-title text-info">{{$contciudadanos}}</h5>
                  </div>
                </div>
              </div>
              <div class="col mb-4">
                <div class="card">
                  <div class="card-body text-center">
                    Usuarios Postulados:
                    <h5 class="card-title text-info">{{$contpostulados}}</h5>
                  </div>
                </div>
              </div>
              <div class="col mb-4">
                <div class="card">
                  <div class="card-body text-center">
                    Usuarios Contratados:
                    <h5 class="card-title text-info">/</h5>
                  </div>
                </div>
              </div>
              <div class="col mb-4">
                <div class="card">
                  <div class="card-body text-center">
                    Vacantes Totales:
                    <h5 class="card-title text-info">{{$contvacantes}}</h5>
                  </div>
                </div>
              </div>
              <div class="col mb-4">
                <div class="card">
                  <div class="card-body text-center">
                    Vacantes Activas:
                    <h5 class="card-title text-info">{{$contvacactivas}}</h5>
                  </div>
                </div>
              </div>
              <div class="col mb-4">
                <div class="card">
                  <div class="card-body text-center">
                    Empresas Activas:
                    <h5 class="card-title text-info">{{$contempactivas}}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--users-->
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <h5 class="text-center font-weight-bold">Usuarios</h5>
            <!--<a href="http://" class="btn btn-primary" style="width: 100%;">Nueva Usuario</a>-->
            <br>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($datosciudadanos as $ciudadano)
                  <tr>
                    <th scope="row"><a href="/editar/">{{$ciudadano->id_persona}}</a></th>
                    <td>{{$ciudadano->nombre_completo}}</td>
                    <td>{{$ciudadano->telefono}}</td>
                    <td>{{$ciudadano->email}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $datosciudadanos->appends(request()->query())->links() }}
            </div>
          </div>
          <!--companies-->
          <div class="tab-pane fade" id="v-pills-applications" role="tabpanel" aria-labelledby="v-pills-applications-tab">
            <h5 class="text-center font-weight-bold">Empresas</h5>
            <!--<a href="http://" class="btn btn-primary" style="width: 100%;">Nueva Empresa</a>-->
            <br>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($datosempresas as $empresa)
                  <tr>
                    <th scope="row"><a href="/editar/">{{$empresa->id_empresa}}</a></th>
                    <td>{{$empresa->nombre_RS}}</td>
                    <td>{{$empresa->tel1}}</td>
                    <td>{{$empresa->email}}</td>
                    <td>
                      <span id="is_active{{$empresa->id_empresa}}">{{$empresa->is_active ? "Activa": "Inactiva"}}</span>
                      <a data-id="{{$empresa->id_empresa}}" href="#" class="bg-light rounded m-1 text-secondary toggle-class">&nbsp;
                        <small id="update_active{{$empresa->id_empresa}}">{{$empresa->is_active ? "desactivar": "activar"}}</small>&nbsp;
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $datosempresas->appends(request()->query())->links() }}
            </div>
          </div>
          <!--vacancies-->
          <div class="tab-pane fade" id="v-pills-vacancies" role="tabpanel" aria-labelledby="v-pills-vacancies-tab">
            <h5 class="text-center font-weight-bold">Vacantes</h5>
            <!--<a href="http://" class="btn btn-primary" style="width: 100%;">Nueva Vacante</a>-->
            <br>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Vacante</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($vacantes as $vacante)
                  <tr>
                    <th scope="row"><a href="/editar/">{{$vacante->id_vacante}}</a></th>
                    <td>{{$vacante->nombre_RS}}</td>
                    <td>{{$vacante->titulo_puesto}}</td>
                    <td>Activa</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $vacantes->appends(request()->query())->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('.toggle-class').click(function() {
      var empresa_id = $(this).data('id');
      $("#update_active"+empresa_id).text("aplicando cambios...");
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '/modificarestadoemp',
        data: {
          'emp_id': empresa_id
        },
        success: function(data) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: data.name, 
            text: data.success,
            showConfirmButton: false,
            timer: 1500
          });
          //changes by new vaules
          $("#is_active"+empresa_id).text(data.is_active ? "Activa" : "Inactiva");
          $("#update_active"+empresa_id).text(data.is_active ? "desactivar" : "activar");
        }
      });
    });
  });
</script>
@endsection
@extends('layouts.base')

@section('content')

<!--Vacancies-->
<section class="pt-md-3 m-3">
  <div class="container my-md-5">
    <div class="row justify-content-md-center">
      @if (empty($update))
      <form action="/vacante/{{$vacante->id_vacante}}/actualizar" method="post" class="data-form">
        @csrf
        <ul class="nav nav-pills justify-content-center siguiente bg-light" role="tablist">
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
        <div class="tab-content px-5">
          <div id="datosvacante" class="container tab-pane active"><br>
            <div class="form-row">
              <div class="form-group col-md-12">
                <h4 class="font-weight-bold">Datos de la Vacante</h4>
                <hr />
              </div>
              <div class="form-group col-md-12">
                <label for="title" class="font-weight-bold">Título del puesto: <font color="red">*</font></label>
                <input type="text" class="form-control" id="title" name="title" required value="{{$vacante->titulo_puesto}}">
              </div>
              <div class="form-group col-md-12">
                <label for="description" class="font-weight-bold">Breve Descripción: <font color="red">*</font></label>
                <input type="text" class="form-control" id="description" name="description" required value="{{$vacante->descripcion_breve}}">
              </div>
              <div class="form-group col-md-12">
                <label for="FuncionActividad" class="font-weight-bold">Funciones y actividades a realizar: <font color="red">*</font></label><br>
                <input type="text" class="form-control" name="FuncionActividad" required value="{{$vacante->FunActi_realizar}}">
              </div>
              <div class="form-group col-md-12">
                <label for="conocimientos" class="font-weight-bold">Conocimientos y habilidades requeridas: <font color="red">*</font></label><br>
                <input type="text" class="form-control" name="conocimientos" required value="{{$vacante->conocimientos_requeridos}}">
              </div>
              <div class="form-group col-md-12">
                <label for="direccion" class="font-weight-bold">Dirección donde se ubica la vacante: <font color="red">*</font></label><br>
                <input type="text" class="form-control" name="direccioncompleta" required value="{{$vacante->direccioncompleta}}">
              </div>
              <div class="form-group col-md-6">
                <label for="tipoempleo" class="font-weight-bold">Tipo de empleo: <font color="red">*</font></label>
                <select id="TipoEmpleo" name="tipoempleo" class="form-control" required>
                  @foreach ($tiposemp as $tipoemp)
                  @if ($tipoemp->TipoEmpleo===$vacante->tipo_empleo)
                  <option value='{{ $tipoemp->TipoEmpleo }}' selected> {{ $tipoemp->TipoEmpleo }}</option>
                  @else
                  <option value='{{ $tipoemp->TipoEmpleo }}'> {{ $tipoemp->TipoEmpleo }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="salario" class="font-weight-bold">Salario mensual ofrecido: <font color="red">*</font></label>
                <input type="text" class="form-control" id="salario" name="salario" Placeholder="$" required value="{{$vacante->salario_mensual}}">
              </div>
              <div class="form-group col-md-6">
                <label for="ubicacion" class="font-weight-bold">Municipio donde de ubica la vacante: <font color="red">*</font></label>
                <select name="ubicacion" id="ubicacion" class="form-control" required>
                  <option disabled>Selecciona</option>
                  @foreach ($munvacante as $mun)
                  @if ($mun->Municipio===$vacante->lugar_vacante)
                  <option value='{{ $mun->Municipio }}' selected> {{ $mun->Municipio }}</option>
                  @else
                  <option value='{{ $mun->Municipio }}'> {{ $mun->Municipio }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="diaslaboral" class="font-weight-bold">Días a laborar: <font color="red">*</font></label>
                <input type="text" class="form-control" id="DiasLaboral" name="DiasLaboral" required value="{{$vacante->dias_laboral}}">
              </div>
              <div class="form-group col-md-6">
                <label for="entrada" class="font-weight-bold">Hora de entrada:</label>
                <input type="time" class="form-control" id="entrada" name="entrada" value="{{$vacante->hora_entrada}}">
              </div>
              <div class="form-group col-md-6">
                <label for="salida" class="font-weight-bold">Hora de salida:</label>
                <input type="time" class="form-control" id="salida" name="salida" value="{{$vacante->hora_salida}}">
              </div>
              <div class="form-group col-md-6">
                <label for="plazas" class="font-weight-bold">Número de plazas: <font color="red">*</font></label>
                <input type="number" class="form-control" id="NumPlazas" name="NumPlazas" required value="{{$vacante->numero_plazas}}">
              </div>
              <div class="form-group col-md-6">
                <label for="vigencia" class="font-weight-bold">Vigencia de la vacante: <font color="red">*</font></label>
                <input type="date" class="form-control" id="VigenciaVacante" name="VigenciaVacante" required value="{{$vacante->vigencia_vacante}}">
              </div>
            </div>
          </div>
          <div id="requisitos" class="container tab-pane"><br>
            <div class="form-row">
              <div class="form-group col-md-12">
                <h4 class="font-weight-bold">Requisitos de la Vacante</h4>
                <hr />
              </div>
              <div class="form-group col-md-6">
                <label for="discapacidad" class="font-weight-bold">¿Acepta personas con discapacidad? <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($requisitos->personas_con_discapacidad=='Si')
                  <input class="form-check-input" type="radio" name="discapacidad" value="Si" checked>
                  @else
                  <input class="form-check-input" type="radio" name="discapacidad" value="Si">
                  @endif
                  <label class="form-check-label" for="discapacidad">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($requisitos->personas_con_discapacidad=='No')
                  <input class="form-check-input" type="radio" name="discapacidad" value="No" checked>
                  @else
                  <input class="form-check-input" type="radio" name="discapacidad" value="No">
                  @endif
                  <label class="form-check-label" for="discapacidad">No</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="MenDiscapacidad" class="font-weight-bold">Mencione que discapacidad <font color="red">*</font></label>
                <input type="text" class="form-control" id="MenDiscapacidad" name="MenDiscapacidad" required value="{{$requisitos->mencione_discapacidad}}">
              </div>
              <div class="form-group col-md-6">
                <label for="AdultoMayor" class="font-weight-bold">¿Acepta adultos mayores de 55 años? <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($requisitos->adultos_mayores=='Si')
                  <input class="form-check-input" type="radio" name="AdultoMayor" required value="Si" checked>
                  @else
                  <input class="form-check-input" type="radio" name="discapacidad" value="Si">
                  @endif
                  <label class="form-check-label" for="AdultoMayor">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($requisitos->adultos_mayores=='No')
                  <input class="form-check-input" type="radio" name="AdultoMayor" value="No" checked>
                  @else
                  <input class="form-check-input" type="radio" name="AdultoMayor" value="No">
                  @endif
                  <label class="form-check-label" for="AdultoMayor">No</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="CausaVacante" class="font-weight-bold">Causa que origina la vacante <font color="red">*</font></label>
                <input type="text" class="form-control" id="CausaVacante" name="CausaVacante" required value="{{$requisitos->causa_origina_vacante}}">
              </div>
              <div class="form-group col-md-6">
                <label for="escolaridad" class="font-weight-bold">Escolaridad: <font color="red">*</font></label>
                <input type="text" class="form-control" id="escolaridad" name="escolaridad" required value="{{$requisitos->escolaridad}}">
              </div>
              <div class="form-group col-md-6">
                <label for="CarreraEspe" class="font-weight-bold">Carrera o Especialidad: <font color="red">*</font></label>
                <input type="text" class="form-control" id="CarreraEspe" name="CarreraEspe" required value="{{$requisitos->carrera_especialidad}}">
              </div>
              <div class="form-group col-md-6">
                <label for="idioma" class="font-weight-bold">Situación Académica: <font color="red">*</font></label>
                <select name="SituAcademica" class="form-control" required>
                  @if ($requisitos->situacion_academica=='Estudiante')
                  <option value="Estudiante" selected>Estudiante</option>
                  @else
                  <option value="Estudiante">Estudiante</option>
                  @endif
                  @if ($requisitos->situacion_academica=='Diploma o certificado')
                  <option value="Diploma o certificado" selected>Diploma o certificado</option>
                  @else
                  <option value="Diploma o certificado">Diploma o certificado</option>
                  @endif
                  @if ($requisitos->situacion_academica=='Trunca')
                  <option value="Trunca" selected>Trunca</option>
                  @else
                  <option value="Trunca">Trunca</option>
                  @endif
                  @if ($requisitos->situacion_academica=='Pasante')
                  <option value="Pasante" selected>Pasante</option>
                  @else
                  <option value="Pasante">Pasante</option>
                  @endif
                  @if ($requisitos->situacion_academica=='Titulado')
                  <option value="Titulado" selected>Titulado</option>
                  @else
                  <option value="Titulado">Titulado</option>
                  @endif
                  @if ($requisitos->situacion_academica=='Ninguna')
                  <option value="Ninguna" selected>Ninguna</option>
                  @else
                  <option value="Ninguna">Ninguna</option>
                  @endif
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="ExpeMin" class="font-weight-bold">Experiencia mínima requerida: <font color="red">*</font></label>
                <select name="exppuesto" class="form-control" required>
                  @foreach ($exppuestos as $exppuesto)
                  @if ($exppuesto->ExpPuesto == $requisitos->experiencia_MinRequerida)
                  <option value='{{ $exppuesto->ExpPuesto }}' selected> {{ $exppuesto->ExpPuesto }}</option>
                  @else
                  <option value='{{ $exppuesto->ExpPuesto }}'> {{ $exppuesto->ExpPuesto }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="rango" class="font-weight-bold">Rango de edad: <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  <p>De</p>
                </div>
                <div class="form-check form-check-inline col-md-3">
                  <input type="number" class="form-control" id="EdadMinima" name="EdadMinima" Placeholder="Min." required value="{{$requisitos->minima_edad}}">
                </div>
                <div class="form-check form-check-inline">
                  <p>A</p>
                </div>
                <div class="form-check form-check-inline col-md-3">
                  <input type="number" class="form-control" id="EdadMaxima" name="EdadMaxima" Placeholder="Max." required value="{{$requisitos->maxima_edad}}">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="idioma" class="font-weight-bold">Idioma Requerido: <font color="red">*</font></label>
                <input type="text" class="form-control" id="idioma" name="idioma" required value="{{$requisitos->idioma}}">
              </div>
              <div class="form-group col-md-6">
                <label for="computacion" class="font-weight-bold">¿Requiere conocimientos en computación? <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($requisitos->computacion=='Si')
                  <input class="form-check-input" type="radio" name="computacion" required value="Si" checked>
                  @else
                  <input class="form-check-input" type="radio" name="computacion" required value="Si">
                  @endif
                  <label class="form-check-label" for="computacion">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($requisitos->computacion=='No')
                  <input class="form-check-input" type="radio" name="computacion" value="No" checked>
                  @else
                  <input class="form-check-input" type="radio" name="computacion" value="No">
                  @endif
                  <label class="form-check-label" for="computacion">No</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="genero" class="font-weight-bold">Género <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($requisitos->sexo=='Hombre')
                  <input class="form-check-input" type="radio" name="genero" value="Hombre" checked>
                  @else
                  <input class="form-check-input" type="radio" name="genero" value="Hombre">
                  @endif
                  <label class="form-check-label" for="genero">Hombre</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($requisitos->sexo=='Mujer')
                  <input class="form-check-input" type="radio" name="genero" value="Mujer" checked>
                  @else
                  <input class="form-check-input" type="radio" name="genero" value="Mujer">
                  @endif
                  <label class="form-check-label" for="genero">Mujer</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($requisitos->sexo=='Indistinto')
                  <input class="form-check-input" type="radio" name="genero" value="Indistinto" checked>
                  @else
                  <input class="form-check-input" type="radio" name="genero" value="Indistinto">
                  @endif
                  <label class="form-check-label" for="genero">Indistinto</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="RadicarFuera" class="font-weight-bold">¿Requiere disponibilidad para radicar fuera? <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($requisitos->disponibilidad_RadicarFuera=='Si')
                  <input class="form-check-input" type="radio" name="RadicarFuera" value="Si" checked>
                  @else
                  <input class="form-check-input" type="radio" name="RadicarFuera" value="Si">
                  @endif
                  <label class="form-check-label" for="RadicarFuera">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($requisitos->disponibilidad_RadicarFuera=='No')
                  <input class="form-check-input" type="radio" name="RadicarFuera" value="No" checked>
                  @else
                  <input class="form-check-input" type="radio" name="RadicarFuera" value="No">
                  @endif
                  <label class="form-check-label" for="RadicarFuera">No</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="DispoViajar" class="font-weight-bold">¿Requiere disponibilidad para viajar? <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($requisitos->disponibilidad_viajar=='Si')
                  <input class="form-check-input" type="radio" name="DispoViajar" value="Si" checked>
                  @else
                  <input class="form-check-input" type="radio" name="DispoViajar" value="Si">
                  @endif
                  <label class="form-check-label" for="DsipoViajar">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($requisitos->disponibilidad_viajar=='No')
                  <input class="form-check-input" type="radio" name="DispoViajar" value="No" checked>
                  @else
                  <input class="form-check-input" type="radio" name="DispoViajar" value="No">
                  @endif
                  <label class="form-check-label" for="DispoViajar">No</label>
                </div>
              </div>
              <div class="form-group col-md-12">
                <label for="prestaciones" class="font-weight-bold">Otras prestaciones: </label><br>
                <input type="text" class="form-control" name="prestaciones" value="{{$requisitos->prestaciones_ofrecidas}}">
              </div>
              <div class="form-group col-md-12">
                <label for="observaciones" class="font-weight-bold">Observaciones:</label><br>
                <input type="text" class="form-control" name="observaciones" value="{{$requisitos->observaciones}}">
              </div>
            </div>
          </div>
          <div id="infocontacto" class="container tab-pane"><br>
            <div class="form-row">
              <div class="form-group col-md-12">
                <h4 class="font-weight-bold">Información de Contacto</h4>
                <hr />
              </div>
              <div class="form-group col-md-6">
                <label for="nameC" class="font-weight-bold">Nombre: <font color="red">*</font></label>
                <input type="text" class="form-control" id="nameC" name="nameC" required value="{{$contacto->nombre_contacto}}" />
              </div>
              <div class="form-group col-md-6">
                <label for="Cargo" class="font-weight-bold">Cargo: <font color="red">*</font></label>
                <input type="text" class="form-control" id="Cargo" name="Cargo" required value="{{$contacto->cargo}}" />
              </div>
              <div class="form-group col-md-6">
                <label for="tel" class="font-weight-bold">Teléfono: <font color="red">*</font></label>
                <input type="text" class="form-control" id="tel" name="tel" required value="{{$contacto->telefono}}" />
              </div>
              <div class="form-group col-md-6">
                <label for="email" class="font-weight-bold">Correo Electrónico: <font color="red">*</font></label>
                <input type="email" class="form-control" id="email" name="email" required value="{{$contacto->email}}" />
              </div>
              <div class="form-group col-md-6">
                <label for="contacto" class="font-weight-bold">Medio Preferente contacto: <font color="red">*</font></label>
                <input type="text" class="form-control" id="contacto" name="contacto" required value="{{$contacto->medio_preferente_contacto}}" />
              </div>
              <div class="form-group col-md-6">
                <label for="DiaEntrevista" class="font-weight-bold">Días de entrevista: <font color="red">*</font></label>
                <input type="text" class="form-control" id="" name="DiaEntrevista" value="{{$contacto->dias_entrevista}}" />
              </div>
              <div class="form-group col-md-12">
                <label for="rango" class="font-weight-bold">Horario de Entrevista: </label><br>
                <div class="form-check form-check-inline">
                  <p>De</p>
                </div>
                <div class="form-check form-check-inline col-md-5">
                  <input type="time" class="form-control" id="horaentrevistaI" name="HorarioInicial" value="{{$contacto->horario_entrevista_inicial}}" />
                </div>
                <div class="form-check form-check-inline">
                  <p>A</p>
                </div>
                <div class="form-check form-check-inline col-md-5">
                  <input type="time" class="form-control" id="horaentrevistaF" name="HorarioFinal" value="{{$contacto->horario_entrevista_final}}" />
                </div>
              </div>
            </div>
          </div>
          <div id="fechayp" class="container tab-pane"><br>
            <div class="form-row">
              <div class="form-group col-md-12">
                <h4 class="font-weight-bold">Publicación</h4>
                <hr />
              </div>
              <div class="form-group col-md-6">
                <label for="periodico" class="font-weight-bold">Periodico de ofertas <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($fecha->periodico_ofertas=='Si')
                  <input class="form-check-input" type="radio" name="periodico" value="Si" checked />
                  @else
                  <input class="form-check-input" type="radio" name="periodico" value="Si" />
                  @endif
                  <label class="form-check-label" for="periodico">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($fecha->periodico_ofertas=='No')
                  <input class="form-check-input" type="radio" name="periodico" value="No" checked />
                  @else
                  <input class="form-check-input" type="radio" name="periodico" value="No" />
                  @endif
                  <label class="form-check-label" for="periodico">No</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="PortalEmpleo" class="font-weight-bold">Portal de empleo <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($fecha->portal_empleo=='Si')
                  <input class="form-check-input" type="radio" name="PortalEmpleo" value="Si" checked />
                  @else
                  <input class="form-check-input" type="radio" name="PortalEmpleo" value="Si">
                  @endif
                  <label class="form-check-label" for="PortalEmpleo">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($fecha->portal_empleo=='No')
                  <input class="form-check-input" type="radio" name="PortalEmpleo" value="No" checked />
                  @else
                  <input class="form-check-input" type="radio" name="PortalEmpleo" value="No">
                  @endif
                  <label class="form-check-label" for="PortalEmpleo">No</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="FeriaEmpleo" class="font-weight-bold">Feria del Empleo <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($fecha->feria_empleo=='Si')
                  <input class="form-check-input" type="radio" name="FeriaEmpleo" value="Si" checked />
                  @else
                  <input class="form-check-input" type="radio" name="FeriaEmpleo" value="Si" />
                  @endif
                  <label class="form-check-label" for="feria">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($fecha->feria_empleo=='No')
                  <input class="form-check-input" type="radio" name="FeriaEmpleo" value="No" checked />
                  @else
                  <input class="form-check-input" type="radio" name="FeriaEmpleo" value="No" />
                  @endif
                  <label class="form-check-label" for="FeriaEmpleo">No</label>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="RadioMex" class="font-weight-bold">Radio Mexiquense <font color="red">*</font></label><br>
                <div class="form-check form-check-inline">
                  @if ($fecha->radio_mexiquense=='Si')
                  <input class="form-check-input" type="radio" name="RadioMex" value="Si" checked />
                  @else
                  <input class="form-check-input" type="radio" name="RadioMex" value="Si" />
                  @endif
                  <label class="form-check-label" for="RadioMex">Si</label>
                </div>
                <div class="form-check form-check-inline">
                  @if ($fecha->radio_mexiquense=='No')
                  <input class="form-check-input" type="radio" name="RadioMex" value="No" checked />
                  @else
                  <input class="form-check-input" type="radio" name="RadioMex" value="No" />
                  @endif
                  <label class="form-check-label" for="RadioMex">No</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <button type="submit" class="btn btn-primary float-right">Actualizar Vacante</button>
      </form>
      @else
        <div class="p-5">
          <h4 class="text-center mb-5">La vacante <strong>{{$vacante->titulo_puesto}}</strong> se ha actualizado con exito.</h4>
          <p class="text-center">
            <a href="/micuenta" class="btn btn-primary">aceptar</a>
          </p>
        </div>

      @endif
    </div>
  </div>
</section>
@endsection
<!DOCTYPE html>
<html lang="es">
  <head>   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Currículum Vitae</title>
  </head>
  <body>
    <div class="page-content">
      <div class="panel">
        <h2 align="center"><Font size="6">Currículum Vitae</Font></h2>
        <p> 
          @if($datos)
            @foreach ($datos as $d)
              <img style="margin-right: 15px" src="archivo/{{$d->foto_perfil}}" width="105px" height="105px" align="left">
            @endforeach
          @else
            <img style="margin-right: 15px" src="images/perfil.png" width="105px" height="105px" align="left">
          @endif
          <h4>Nombre: {{Auth::user()->nombre}}</h4> 
          <h4>Teléfono: {{Auth::user()->telefono}}</h4>
          <h4>Correo electrónico: {{Auth::user()->email}}</h4>
        </p>
        <hr/>

        <h3 style="color: blue">Objetivo Profesional</h3>
        @foreach($puesto as $pu)
        <p><b>Puesto deseado: </b>{{$pu->puesto_deseado}}</p>
        <p><b>Ocupación: </b>{{$pu->ocupacion}}</p>
        @endforeach
        <hr/>

        <h3 style="color: blue">Experiencia Profesional</h3>
        @foreach($perfil as $p)
        <p><b>Nombre de la Empresa o Razón Social: </b>{{$p->nombre_RS}} (De {{$p->fecha_ingreso}} al {{$p->fecha_separacion}})</p>
        <p><b>Puesto ocupado: </b>{{$p->titulo_puesto}}</p>
        <p><b>Actividades Realizadas: </b>{{$p->funciones_actividades}}</p>
        @endforeach
        <hr/>

        <h3 style="color: blue">Educación</h3>
        @foreach($escolaridad as $e)
        <p><b>Ultimo grado de estudios: </b>{{$e->grado_estudios}} ({{$e->situacion_academica}})</p>
        <hr/>

        <h3 style="color: blue">Área de especialidad</h3>
        <p><b>Carrera o Especialidad: </b>{{$e->carrera_especialidad}}</p>
        <hr/>

        <h3 style="color: blue">Habilidades y Conocimientos</h3>
        <p><b>Habilidades:</b> {{$e->conocimientos_esp}}</p>
        <p><b>Conocimientos:</b> {{$e->habilidades_esp}}</p>
        @endforeach
        <hr/>

        <h3 style="color: blue">Idiomas</h3>
        @foreach($escolaridad as $e)
        <p><b>Idioma: </b>{{$e->idioma}} ({{$e->dominio}})</p>
        @endforeach
        <hr/>

        <h3 style="color: blue">Cursos y Certificaciones</h3>
        @foreach($escolaridad as $e)
        <p>{{$e->cursos}}</p>
        @endforeach
        <hr/>
        
      </div>
    </div>
  </body>
</html>
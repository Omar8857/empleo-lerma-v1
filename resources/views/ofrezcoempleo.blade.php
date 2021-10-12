@extends('layouts.base')

@section('content')
<!-- Search -->
<section>
	<div class="container my-md-5">
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-8 p-4">
			  <h3>Ofrezco Empleo</h3>
		    <p>¡Muchas gracias por usar la aplicación!</p>
		    <p>Si tienes necesitas personal para laborar contigo puedes publicar y contactar a personas desde esta plataforma.<br/>
		    	Es muy sencillo, solo necesitas seguir los siguientes pasos:
		    </p>
			</div>
      <div class="col-12 col-md-8 p-4">
		    <h4>Registrate</h4>
		    <ul>
		    	<li>Selecciona en la opción registrarse.</li>
		    	<li>Se mostrará un formulario para tu registro. Selecciona la opción de empresa, posteriormente los datos solicitados (guarda tu contraseña).</li>
		    	<li>Recibirás un correo de confirmación de cuenta. Da clic en Confirmar Cuenta o sigue el enlace que aparece en el correo</li>
		    	<li>Te regresará nuevamente a la página principal, posterior selecciona Mi cuenta.</li>
		    	<li>Completa la información restante con tu perfil empresarial.</li>
		    	<li>Empleo Lerma validará tu perfil empresarial</li>
		    	<li>Recibirás un correo de activacion de perfil</li>
		    	<li>Ahora ya puedes registrar tus vacantes!</li>
		    </ul>
      </div>
      <div class="col-12 col-md-8 p-4">
		    <h4>Publica Vacantes</h4>
		    <ul>
		    	<li>Da click en la opción de NUEVA VACANTE.</li>
		    	<li>Llena todos los campos de la vacante.</li>
		    	<li>Cubre los requisitos de la vacante.</li>
		    	<li>Ingresa la información del contacto.</li>
		    	<li>Selecciona la opción de publicación de periódico de ofertas y portal de Empleo.</li>
		    	<li>Una vez finalizado el llenado COMPLETO de las vacantes selecciona crear vacante.</li>
		    	<li>Listo, se visualizará de la vacante publicada.</li>
		    </ul>
      </div>
      <div class="col-12 col-md-8 p-4">
		    <a href="{{asset('archivo/ofrezco_empleo_lerma.pdf')}}" target="_blank">Aquí tienes un tutorial mas detallado</a>
      </div>
		</div>
	</div>
</section>
@endsection
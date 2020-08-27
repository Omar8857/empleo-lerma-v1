<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>La empresa {{$mensaje['nomemp']}} se quiere contactar contigo.</title>
        <style>
            img{ 
                width: 150px;
                height: 50px;
            }
            p{
                font-family: Helvetica; 
            }
            table {
                background: #ebebe0;
                border: hidden; 
            }
        </style>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="15">
            <tr>
                <td>
                    <center>
                        <img src="https://lerma.gob.mx/wp-content/uploads/logos-lerma.png" alt="lerma">
                    </center>
                    <hr>
                    <h3><b>Hola, {{$datosciudadano->nombre_completo}}.</b></h3>
                    <p style="text-align: justify;">La empresa <b>"{{$mensaje['nomemp']}}"</b> con 
                        la vacante <b>"{{$datosvacante->titulo_puesto}}"</b> a la que anteriormente
                         te postulaste, se quiere contactar contigo. Te dejamos la información de
                         contacto para que te comuniques via correo electronico o via telefonica.</p>
                    <hr>
                    <center> <h4><b>Datos de Contacto:</b><h4></center>
                    <p><b>Nombre: </b>{{$datoscontacto->nombre_contacto}}</p>
                    <p><b>Cargo: </b>{{$datoscontacto->cargo}}</p>
                    <p><b>Teléfono: </b>{{$datoscontacto->telefono}}</p>
                    <p><b>Email: </b>{{$datoscontacto->email}}</p>
                    <p><b>Medio Preferente: </b>{{$datoscontacto->medio_preferente_contacto}}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                    Saludos,<br>
                    Bolsa de Trabajo - Lerma
                </td>
            </tr>
        </table>
    </body>
</html>
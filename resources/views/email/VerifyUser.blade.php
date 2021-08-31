<!DOCTYPE html>
<html lang="es">
<head>
    <title>Bienvenido a Empleo Lerma</title>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{ $name }}, gracias por registrarte en <strong>Empleo Lerma</strong> !</h2>
    <p>Por favor confirma tu correo electrónico {{$user['email']}}.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>
    <a href="{{ url('user/verify', $user->verifyUser->token) }}">Clic para confirmar email</a>

</body>
</html>
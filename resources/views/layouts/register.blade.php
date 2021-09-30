<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleo Lerma</title>
    <link href="{{asset('assets/img/escudo-de-armas-lerma.png')}}" rel="shortcut icon">
    <meta name="robots" content="index,follow">
    <meta name="description" content="Empleo Lerma">
    <meta name="author" content="LERMA.GOB.MX">
    <meta name="keywords" content="lerma, empleo, municipio">
    <meta name="copyright" content="Copyright 2020 Ayuntamiento de Lerma">
    <link rel="canonical" href="https://empleo.lerma.gob.mx">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://empleo.lerma.gob.mx">
    <meta property="og:title" content="Empleo Lerma">
    <meta property="og:description" content="Empleo Lerma">
    <meta property="og:image" content="https://empleo.lerma.gob.mx/img/logos-lerma.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/src/style.min.css')}}">
    @laravelPWA
</head>
@laravelPWA
@yield('content')

</html>
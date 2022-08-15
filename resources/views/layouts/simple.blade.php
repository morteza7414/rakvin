<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>راکوین - {{$title ?? ''}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="بهترین نمونه تبلیغات را در راکوین تماشا کنید">
    <meta name="keywords" content="تبلیغات / طراحی لوگو">
    <meta name="author" content="Morteza Jaladat">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- programmer styles -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link rel="icon" href="{{asset('images/logo-test.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('images/logo-test.png')}}" type="image/x-icon">

    {{$link ?? ''}}
</head>

{{$slot}}


</html>

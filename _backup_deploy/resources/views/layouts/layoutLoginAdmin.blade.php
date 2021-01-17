<!DOCTYPE html>
<html>
<head>
    <title>Franquiciar Admin</title>
    <meta charset="UTF-8">
    <meta name="description" content="Franquiciar"/>
    <meta name="keywords" content="Franquiciar"/>
    <meta name="author" content="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="apple-mobile-web-app-title" content="Franquiciar">
    <meta name="format-detection" content="telephone=no">

    <!--FAVICON-->
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-TileImage" content="{{ Config::get('app.url') }}admin/img/favicon/mstile-144x144.png">
    <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}admin/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}admin/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}admin/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ Config::get('app.url') }}admin/img/favicon/apple-touch-icon-152x152.png">

    <link rel="stylesheet" href="{{ Config::get('app.url') }}admin/css/normalize.css">
    <link rel="stylesheet" href="{{ Config::get('app.url') }}admin/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ Config::get('app.url') }}admin/css/main.css">
</head>
<body class="grey lighten-5 grey-text text-darken-3">
<div class="center-full">
    <div class="center-full__container">
        @yield('content')
    </div>
</div>
<script src="{{ Config::get('app.url') }}admin/js/jquery-3.1.1.min.js"></script>
<script src="{{ Config::get('app.url') }}admin/js/materialize.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btlogin', function(){
            $("#login-form").submit();
        });
    });
</script>
</html>
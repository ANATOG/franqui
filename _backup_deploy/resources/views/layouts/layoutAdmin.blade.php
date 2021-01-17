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

        <script src="{{ Config::get('app.url') }}admin/js/jquery-3.1.1.min.js"></script>
        <script src="{{ Config::get('app.url') }}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

        <style>
            .botton-top{
                position: fixed!important;
                left: 83%;
                top: 1.5%;
                z-index: 15!important;
                width: 270px;
                right: 10px;
                left: auto;
            }


            @media (max-width: 1023px) {
                .botton-top{
                    display: none!important;
                }
            }


            main .container{
                padding-top: 75px;
            }

            .top-nav{
                position: fixed !important;
                z-index: 10 !important;
            }

            .top-nav .container{
                width: 90%;
                max-width: none;
            }

            div.row label::after{
                display:none!important;
            }
        </style>
    </head>
    <body class="grey lighten-5 grey-text text-darken-3">
        @section('navbar')
            <header>
                <nav class="top-nav blue-grey darken-4">
                    <div class="container">
                        <div class="nav-wrapper">
                            <div>
                                @section('breadcrumbs')
                                    <a href="javascript:void(0)" class="breadcrumb">{{ trans('custom.breadcrumbs_dashboard') }}</a>
                                @show
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons menu-mobile">menu</i></a></div>
                @if($logged_user->hasRole(['root', 'admin']))
                    @include('admin.nav.nav_root')
                @elseif($logged_user->hasRole(['content_manager']))
                    @include('admin.nav.nav_content')
                @endif
            </header>
        @show

        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12">

                            @if (Session::has('errors'))
                                @if(!empty($errors))
                                    <div class="input-field col s12 msg-error">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif
                            @endif



                            @if (Session::has('message_success'))
                                <div class="input-field col s12 msg-success">
                                    {{ Session::get('message_success') }}
                                </div>
                            @endif


                        @yield('search')
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        <script src="{{ Config::get('app.url') }}admin/js/materialize.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".button-collapse").sideNav();
            });
        </script>
        @yield('scripts')
        @if (Session::has('errors'))
            @if(!empty($errors))
                <script>
                    $(document).ready(function() {
                        @foreach($errors->messages() as $field => $value)
                            $('#{{$field}}').addClass('validate invalid');
                            $('.{{$field}}').parent().find('input').addClass('validate invalid');
                        @endforeach
                    });
                </script>
            @endif
        @endif

    </body>
</html>
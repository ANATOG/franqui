@extends('layouts.layoutLoginAdmin')
@section('content')
    <div class="container" id="login">
        <div class="row">
            <div class="col s12 m6 offset-m3">

                <h3 class="center-text">Plataforma exclusiva<br><strong>Franquicias</strong></h3>
                <div class="card">
                    {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/login', 'name' => 'login-form', 'id' => 'login-form')) }}
                    <div class="card-content">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="form-user" name="user" type="text" value="" placeholder="Usuario">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="form-password" name="password" type="password" value="" placeholder="Contraseña">
                            </div>
                        </div>
                        @if(Session::has('error'))

                        @endif
                        @if (Session::has('errors'))
                            @if(!empty($errors))
                                <div>
                                    @foreach($errors->all() as $error)
                                        <p class="left-align red-text text-darken-2">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="card-action right-align">
                    <p class="center-text">
                        {{ Form::button('Ingresar a mi plataforma exclusiva', array('type' => 'submit', 'class' => 'btn waves-effect waves-light btlogin blue-grey darken-4', 'style' => 'width: 100%;')) }}
                    </p>

                    <p class="center-text"><a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/password/reset' }}" class=" text-darken-2">¿Olvidaste tu contraseña?</a></p>
                        
                        
                    </div>
                    {{ Form::hidden('_token', csrf_token()) }}
                    {{ Form::close() }}
                </div>

                <figure class="center-horizontal">
                    <a href="{{ Config::get('app.url') }}"><img class="center-horizontal__container" src="{{ Config::get('app.url') }}admin/img/logo_color.png" alt=""/></a>
                </figure>
            </div>
        </div>
    </div>
@endsection
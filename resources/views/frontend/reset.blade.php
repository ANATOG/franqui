@extends('layouts.layout')
@section('content')
    
    <div class="section__reset-password">
        
        <div class="center-wrapper">
            <div class="reset-password__wrapper">
                
                <h2 class="reset-password__title">Restablecer contraseña</h2>

        
                <form class="reset-password__form" name="reset" method="post" action="{{ Config::get('app.url') }}password/reset">

                    {{ Form::hidden('_token', csrf_token()) }}
                    {{ Form::hidden('token', $token) }}

                    <label>
                        <p class="form__text">Email</p>
                        <input class="form__input" name="email">
                        @if ($errors->has('email'))                        
                            <p class="form__error">{{ $errors->first('email') }}</p>
                        @endif
                    </label>


                    <label>
                        <p class="form__text">Contraseña</p>
                        <input class="form__input" type="password" name="password">
                        @if ($errors->has('password'))                        
                            <p class="form__error">{{ $errors->first('password') }}</p>
                        @endif
                    </label>

                    <label>
                        <p class="form__text">Repetir contraseña</p>
                        <input class="form__input" type="password" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))                        
                            <p class="form__error">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </label>

                    @if (session('status'))
                        <p class="form__ok">{{ session('status') }}</p>
                    @endif

                    <button class="form__button || button-simple--2 button-simple--2--blue-1" type="submit">Enviar</button>

                </form>


            </div>
        </div>
        
    </div>


@endsection
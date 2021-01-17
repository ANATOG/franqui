@extends('layouts.layout')
@section('content')

    <div class="section__reset-password">
        <div class="center-wrapper">
            
            <div class="reset-password__wrapper">

                <h2 class="reset-password__title">¿Olvidaste tu contraseña?</h2>

                <form class="reset-password__form" name="forgot" method="post" action="{{ Config::get('app.url') }}password/email">

                    {{ Form::hidden('_token', csrf_token()) }}

                    <label>
                        <p class="form__text">Email</p>
                        <input class="form__input" name="email">
                        @if ($errors->has('email'))                        
                            <p class="form__error">{{ $errors->first('email') }}</p>
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
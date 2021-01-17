@extends('layouts.layout')
@section('content')
    

    <div class="section__profile">
        <div class="center-wrapper">
            

            <div class="profile__wrapper">
                
                
                <div class="profile__form">

                    <h2 class="profile__title">Tus datos</h2>

                    {{ Form::open(array('url' => Config::get('app.url').'editUser', 'name' => 'edit-form', 'method' => 'put')) }}
                        
                        <label class="form__label__required" for="first_name" data-error="wrong" data-success="right" data-label="first_name">
                            <p class="form__text">Nombre y Apellido</p>
                            {{ Form::text('first_name',(isset($item->first_name))?$item->first_name:old('first_name'), array('id' => 'first_name')) }}
                            <p class="form__error"></p>
                        </label>

                        <label class="form__label__required" for="email" data-error="wrong" data-success="right" data-label="email">
                            <p class="form__text">Email</p>
                            {{ Form::email('email',(isset($item->email))?$item->email:old('email'), array('id' => 'email')) }}
                            <p class="form__error"></p>
                        </label>

                        <label class="form__label__required" for="password" data-label="password">
                            <p class="form__text">Password</p>
                            {{ Form::password('password',array('id' => 'password')) }}
                            <p class="form__error"></p>
                        </label>

                        <p class="form__ok">Tus cambios fueron guardados correctamente.</p>
                        
                        <button class="form__button || button-simple--2 button-simple--2--blue-1" type="submit">
                            Guardar
                            <i class="spinner">
                                <div class="spinner__wrapper"></div>
                            </i>
                        </button>

                    {{ Form::close() }}

                    <p class="text__help">Para modificar tus datos, reescribilos y hacé click en "Guardar"</p>

                </div>

                <div class="profile__favorites">
                    <h2 class="profile__title">Tus favoritos</h2>
                    @if(count($favorites) > 0)
                        <ul class="favorites__list">
                            @foreach($favorites as $favorite => $value)
                                <li class="favorite__item"><a href="{{ Config::get('app.url') }}franquicia/{{ $favorite }}">{{ $value }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>No tiene favoritos aun</p>
                    @endif
                </div>
            
            </div>
            
        </div>
    </div>

@endsection
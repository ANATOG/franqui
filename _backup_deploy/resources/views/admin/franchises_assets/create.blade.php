@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises-assets/create/'.$franchise_id, 'name' => 'login-form', 'id' => 'login-form', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        Para evitar que su Perfil se vea incompleto, aconsejamos tener el video y las imágenes preparadas al momento de la carga inicial, para realizar la misma de manera completa, en un solo paso. Luego podrá modificarlas individualmente.
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('video', old('video'), array('id' => 'video')) }}
                        <label for="video" data-error="wrong" data-success="right">Video</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn waves-light btlogin blue-grey darken-4">
                                <span>Logo</span>
                                {{ Form::file('logo', array('id' => 'logo')) }}
                            </div>
                            <div class="file-path-wrapper">
                                {{ Form::text('file-path',null, array('class' => 'file-path', 'placeholder' => 'Ancho:220px - Alto:150px')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn waves-light btlogin blue-grey darken-4">
                                <span>Imagen Superior</span>
                                {{ Form::file('image_top', array('id' => 'image_top')) }}
                            </div>
                            <div class="file-path-wrapper">
                                {{ Form::text('file-path',null, array('class' => 'file-path', 'placeholder' => 'Ancho:1920px - Alto:576px')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn waves-light btlogin blue-grey darken-4">
                                <span>Imagen Derecha</span>
                                {{ Form::file('right_one', array('id' => 'right_one')) }}
                            </div>
                            <div class="file-path-wrapper">
                                {{ Form::text('file-path',null, array('class' => 'file-path', 'placeholder' => 'Ancho:560px - Alto:330px - (Se visualizará en el listado por rubros, temáticas y buscador)')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn waves-light btlogin blue-grey darken-4">
                                <span>Imagen Izquierda 1</span>
                                {{ Form::file('left_one', array('id' => 'left_one')) }}
                            </div>
                            <div class="file-path-wrapper">
                                {{ Form::text('file-path',null, array('class' => 'file-path', 'placeholder' => 'Ancho:690px - Alto:330px')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn waves-light btlogin blue-grey darken-4">
                                <span>Imagen Izquierda 2</span>
                                {{ Form::file('left_two', array('id' => 'left_two')) }}
                            </div>
                            <div class="file-path-wrapper">
                                {{ Form::text('file-path',null, array('class' => 'file-path', 'placeholder' => 'Ancho:690px - Alto:330px')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn waves-light btlogin blue-grey darken-4">
                                <span>Imagen Izquierda 3</span>
                                {{ Form::file('left_three', array('id' => 'left_three')) }}
                            </div>
                            <div class="file-path-wrapper">
                                {{ Form::text('file-path',null, array('class' => 'file-path', 'placeholder' => 'Ancho:690px - Alto:330px')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-align">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'class' => 'btn waves-effect waves-light btlogin blue-grey darken-4')) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $( "#btsubmit" ).on( "click", function() {
                $( "#btsubmit" ).hide();
            });
            $('select').material_select();
        });
    </script>
@endsection
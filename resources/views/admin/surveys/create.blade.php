@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/surveys/create', 'name' => 'login-form', 'id' => 'login-form', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="row">

                    <div class="input-field col s12">
                        {{ Form::text('question',old('question'), array('id' => 'question')) }}
                        <label for="question" data-error="wrong" data-success="right">Pregunta</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('answers[]', session('answers.0'), array('id' => 'answersOne')) }}
                        <label for="answersOne" data-error="wrong" data-success="right">Respuesta 1</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('answers[]', session('answers.1'), array('id' => 'answersTwo')) }}
                        <label for="answersTwo" data-error="wrong" data-success="right">Respuesta 2</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('answers[]', session('answers.2'), array('id' => 'answersThree')) }}
                        <label for="answersThree" data-error="wrong" data-success="right">Respuesta 3</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('answers[]', session('answers.3'), array('id' => 'answersFour')) }}
                        <label for="answersFour" data-error="wrong" data-success="right">Respuesta 4</label>
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
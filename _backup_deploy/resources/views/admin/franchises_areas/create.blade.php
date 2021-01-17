@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises-areas/create/'.$franchise_id, 'name' => 'login-form', 'id' => 'login-form', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="input-field col s12">
                    {{ Form::text('name', old('name')) }}
                    <label for="name" data-error="wrong" data-success="right">Título</label>
                </div>

                <div class="right-align">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'class' => 'btn waves-effect waves-light btlogin blue-grey darken-4')) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/user/edit/'.$item->id, 'name' => 'login-form', 'id' => 'login-form', 'method' => 'put')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('first_name',(isset($item->first_name))?$item->first_name:old('first_name'), array('id' => 'first_name')) }}
                        <label for="first_name" data-error="wrong" data-success="right">Nombre</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::email('email',(isset($item->email))?$item->email:old('email'), array('id' => 'email')) }}
                        <label for="email" data-error="wrong" data-success="right">Email</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::password('password', '', array('id' => 'password')) }}
                        <label for="password">Password</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::select('role_id', array(
                            ''		=>	trans('custom.choose_role'),
                            '4'		=>	trans('custom.investor_user')
                            ), (isset($item->role_id))?$item->role_id:'', array('class' => 'role_id'))
                        }}
                        <label>Role</label>
                    </div>
                </div>

                <div class="right-align">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'class' => 'btn waves-effect waves-light btlogin blue-grey darken-4')) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.role_id option:first').attr('disabled','disabled');
            $('select').material_select();
        });
    </script>
@endsection

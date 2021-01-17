@extends('layouts.layoutLoginAdmin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3">

                <div class="card">

                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url(Config::get('app.admin_directory').'/password/reset') }}">
                        <div class="card-content">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">{{ trans('custom.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">{{ trans('custom.password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">{{ trans('custom.confirm_password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                    @endif
                                </div>


                                <div class="right-align">
                                    @if (session('status'))
                                        <div class="row">
                                            <div>
                                                {{ session('status') }}
                                            </div>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn waves-effect waves-light btlogin blue-grey darken-4">
                                        {{ trans('custom.reset_password') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <figure class="center-horizontal">
                    <img class="center-horizontal__container" src="{{ Config::get('app.url') }}admin/img/logo.png"
                         alt=""/>
                </figure>
            </div>
        </div>
    </div>
@endsection

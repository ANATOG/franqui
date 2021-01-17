@extends('layouts.layoutLoginAdmin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3">

                <div class="card">


                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url(Config::get('app.admin_directory').'/password/email') }}">
                        <div class="card-content">

                            <span class="card-title black-text">{{ trans('custom.reset_password') }}</span>
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">{{ trans('custom.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="right-align">
                                @if (session('status'))
                                    <div class="row">
                                        <div>
                                            <p class="left-align green-text"> {{ session('status') }}</p>
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="btn waves-effect waves-light btlogin blue-grey darken-4">
                                    {{ trans('custom.sent') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <figure class="center-horizontal">
                    <a href="{{ Config::get('app.url') }}"><img class="center-horizontal__container" src="{{ Config::get('app.url') }}public/admin/img/logo_color.png" alt=""/></a>
                </figure>
            </div>
        </div>
    </div>
@endsection

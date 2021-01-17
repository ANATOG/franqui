@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/banners/create', 'name' => 'login-form', 'id' => 'login-form', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('title',old('title'), array('id' => 'title')) }}
                        <label for="title" data-error="wrong" data-success="right">Título</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('url',old('url'), array('id' => 'url')) }}
                        <label for="url" data-error="wrong" data-success="right">Url</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::select('position', array(
                            ''		                           =>	trans('custom.choose_banner'),
                            'banner_top_home'                  =>	trans('custom.banner_top_home'),
                            'banner_top_home_mobile'           =>	trans('custom.banner_top_home_mobile'),
                            'banner_middle_home'               =>	trans('custom.banner_middle_home'),
                            'banner_bottom_home'               =>	trans('custom.banner_bottom_home'),
                            'banner_bottom_home_mobile'        =>	trans('custom.banner_bottom_home_mobile'),
                            'banner_bottom_thematics'          =>	trans('custom.banner_bottom_thematics'),
                            'banner_bottom_thematics_mobile'   =>	trans('custom.banner_bottom_thematics_mobile'),
                            'banner_bottom_search'             =>	trans('custom.banner_bottom_search'),
                            'banner_bottom_search_mobile'      =>	trans('custom.banner_bottom_search_mobile'),
                            'banner_bottom_news'               =>	trans('custom.banner_bottom_news'),
                            'banner_bottom_news_mobile'        =>	trans('custom.banner_bottom_news_mobile'),
                            'banner_bottom_adviser'            =>	trans('custom.banner_bottom_adviser'),
                            'banner_bottom_adviser_mobile'     =>	trans('custom.banner_bottom_adviser_mobile'),
                            'banner_bottom_about'              =>	trans('custom.banner_bottom_about_mobile'),
                            'banner_bottom_about_mobile'       =>	trans('custom.banner_bottom_about_mobile'),
                            'banner_bottom_franchising'        =>	trans('custom.banner_middle_franchising'),
                            'banner_bottom_franchising_mobile' =>	trans('custom.banner_middle_franchising_mobile')
                            ), old('position'), array('class' => 'position'))
                        }}
                        <label>Position</label>
                    </div>
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn waves-light btlogin blue-grey darken-4">
                                <span>{{ trans('custom.image') }}</span>
                                {{ Form::file('image', array('id' => 'image')) }}
                            </div>
                            <div class="file-path-wrapper">
                                {{ Form::text('file-path',null, array('class' => 'file-path')) }}
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
        $(document).ready(function () {
            $(".position option:first").attr('disabled', 'disabled');
            $('select').material_select();
        });
    </script>
@endsection
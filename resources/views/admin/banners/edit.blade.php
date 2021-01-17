@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/banners/edit/'.$item->id, 'name' => 'login-form', 'id' => 'login-form', 'method' => 'put', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('title',(isset($item->title))?$item->title:old('title'), array('id' => 'title')) }}
                        <label for="title" data-error="wrong" data-success="right">Título</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('url',(isset($item->url))?$item->url:old('url'), array('id' => 'url')) }}
                        <label for="url" data-error="wrong" data-success="right">Url</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::select('position', array(
                            ''		                           =>	trans('custom.choose_banner'),
                            'banner_top_home'                  =>	trans('custom.banner_top_home'),
                            'banner_top_home_mobile'           =>	trans('custom.banner_top_home_mobile'),
                            'banner_middle_home'               =>   trans('custom.banner_middle_home'),
                            'banner_middle_home_mobile'               =>	trans('custom.banner_middle_home_mobile'),
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
                            'banner_bottom_about'              =>	trans('custom.banner_bottom_about'),
                            'banner_bottom_about_mobile'       =>	trans('custom.banner_bottom_about_mobile'),
                            'banner_middle_adviser'            =>	trans('custom.banner_middle_adviser'),
                            'banner_middle_adviser_mobile'     =>	trans('custom.banner_middle_adviser_mobile'),
                            'banner_bottom_franchising'        =>	trans('custom.banner_middle_franchising'),
                            'banner_bottom_franchising_mobile' =>	trans('custom.banner_middle_franchising_mobile'),
                            'banner_bottom_news_franchising'        =>  trans('custom.banner_bottom_news_franchising'),
                            'banner_bottom_news_franchising_mobile' =>  trans('custom.banner_bottom_news_franchising_mobile'),
                            'banner_bottom_asesor1'                   => trans('custom.banner_bottom_asesor1'),
                            'banner_bottom_asesor2'                   => trans('custom.banner_bottom_asesor2'),
                            'banner_bottom_asesor_mobile1'            => trans('custom.banner_bottom_asesor_mobile1'),
                            'banner_bottom_asesor_mobile2'            => trans('custom.banner_bottom_asesor_mobile2')
                            ), (isset($item->position))?$item->position:'', array('class' => 'position', 'disabled'))
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
                        <div>Medidas: </div>
                    </div>
                    <div class="input-field col s12">
                        @unless(empty($item->image))
                            <a href="{{ url('public/uploads/'.$item->image) }}" target="_blank"><img src="{{ url('public/uploads/'.$item->image) }}" width="100px"></a>
                            {{ Form::hidden('old_image', $item->image) }}
                        @endunless
                    </div>
                </div>

                <div class="right-align">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'class' => 'btn waves-effect waves-light btlogin blue-grey darken-4')) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".position option:first").attr('disabled','disabled');
            $('select').material_select();
        });
    </script>
@endsection

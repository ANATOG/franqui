@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/news/create', 'name' => 'login-form', 'id' => 'login-form', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('author',old('author'), array('id' => 'author')) }}
                        <label for="author" data-error="wrong" data-success="right">Autor</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::select('type', array(
                            'noticia'		=>	'Noticia',
                            'entrevista'	=>	'Entrevista',
                            'video'		    =>	'Video'
                            ), (isset($item->type))?$item->type:'', array('class' => 'type'))
                        }}
                        <label>Género</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('title',old('title'), array('id' => 'title')) }}
                        <label for="title" data-error="wrong" data-success="right">Título</label>
                    </div>
                    <div class="input-field col s12">
                        <b>Descripción</b>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::textarea('description',old('description'), array('id' => 'description', 'class' => 'materialize-textarea')) }}
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <div class="chips"></div>
                            <label for="tags" data-error="wrong" data-success="right">Tags</label>
                        </div>
                    </div>
                    {{ Form::hidden('tags', null, array('id' => 'tags')) }}

                    <div class="input-field col s12">
                        {{ Form::text('video', old('video'), array('id' => 'video')) }}
                        <label for="video" data-error="wrong" data-success="right">Video</label>
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
        $(document).ready(function() {
            $('#description').trigger('autoresize');
            CKEDITOR.replace( 'description' );

            $(".video_type option:first").attr('disabled','disabled');
            $('select').material_select();

            $('.chips').material_chip();

            $('.chips').on('chip.add', function(e, chip){
                $('#tags').val("");
                $('.chips').material_chip('data').forEach(ArrayElementsToHidden);
            });

            $('.chips').on('chip.delete', function(e, chip){
                $('#tags').val('');
                $('.chips').material_chip('data').forEach(ArrayElementsToHidden);
            });

            @if(old('tags') != "")
                $('.chips').material_chip({
                    data: [
                            @foreach(explode(',',old('tags')) as $tag)
                        { tag: '{{ $tag }}', },
                        @endforeach
                    ],
                });
            @endif

        });

        function ArrayElementsToHidden(element, index, array) {
            console.log();
            var text = $('#tags');
            if(text.val() == '') {
                text.val(element.tag);
            }else{
                text.val(text.val()+','+element.tag);
            }
        }
    </script>
@endsection
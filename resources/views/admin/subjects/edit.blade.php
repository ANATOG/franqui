@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/subjects/edit/'.$item->id, 'name' => 'login-form', 'id' => 'login-form', 'method' => 'put', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('name',(isset($item->name))?$item->name:old('name'), array('id' => 'name')) }}
                        <label for="name" data-error="wrong" data-success="right">Nombre</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div class="chips"></div>
                        <label for="tags" data-error="wrong" data-success="right">Tags</label>
                    </div>
                </div>
                {{ Form::hidden('tags', implode(",",$tags), array('id' => 'tags')) }}

                <div class="input-field col s12">
                    <div class="file-field input-field">
                        <div class="btn waves-light btlogin blue-grey darken-4">
                            <span>{{ trans('custom.image') }}</span>
                            {{ Form::file('image', array('id' => 'image')) }}
                        </div>
                        <div class="file-path-wrapper">
                            {{ Form::text('file-path',null, array('class' => 'file-path', 'placeholder' => 'Ancho:220px - Alto:440px')) }}
                        </div>
                    </div>
                </div>
                <div class="input-field col s12">
                    @unless(empty($item->image))<a href="{{ url("public/uploads/".$item->image) }}" target="_blank"><img src="{{ url("public/uploads/".$item->image) }}" width="100px"></a>@endunless
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

            @if(isset($tags[0]) && $tags[0] != "")
                $('.chips').material_chip({
                    data: [
                            @foreach($tags as $tag)
                        { tag: '{{ $tag }}', },
                        @endforeach
                    ],
                });
            @else
                $('.chips').material_chip();
            @endif

            @if(old('tags') != "")
                $('.chips').material_chip({
                    data: [
                            @foreach(explode(',',old('tags')) as $tag)
                        { tag: '{{ $tag }}', },
                        @endforeach
                    ],
                });
            @endif

            $('.chips').on('chip.add', function(e, chip){
                $('#tags').val('');
                $('.chips').material_chip('data').forEach(ArrayElementsToHidden);
            });

            $('.chips').on('chip.delete', function(e, chip){
                $('#tags').val("");
                $('.chips').material_chip('data').forEach(ArrayElementsToHidden);
            });

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

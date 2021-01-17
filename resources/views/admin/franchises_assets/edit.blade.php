@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises-assets/edit/'.$franchise_id.'/'.$item->id, 'name' => 'login-form', 'id' => 'login-form', 'method' => 'put', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>
                
                <div class="row">
                    @if($item->position == 'logo')
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
                    @else
                    <div class="input-field col s12">
                        <div id="image-cropper" class="{{ $item->position }}">
                            <div class="safe-zone">&nbsp;</div>
                            <div class="cropit-preview"></div>
                            <p class="range-field">
                                Zoom: <input type="range" class="cropit-image-zoom-input" />    
                            </p>
                            <input type="file" class="cropit-image-input" />
                        </div>
                        <input type="hidden" name="imagedata" id="imagedata"/>
                    </div>
                    @endif
                    <div class="input-field col s12">
                        {{ Form::hidden('position', $item->position) }}
                        @unless(empty($item->image))
                            Imágen actual: <a href="{{ url('uploads/'.$item->image) }}" target="_blank"><img
                                        src="{{ url('/public/uploads/'.$item->image) }}" width="100px"></a>
                            {{ Form::hidden('old_image', $item->image) }}
                        @endunless
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <p>Para una correcta visualización en el Website asegúrese que la imagen complete todo el área sugerido en pantalla y que el contenido importante quede dentro del área grisada (el contenido por fuera de ella puede no visualizarse en algunas aplicaciones)</p>
                    </div>
                </div>

                <div class="right-align">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'class' => 'btn waves-effect waves-light btlogin blue-grey darken-4', 'id' => 'submit-btn')) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    @if($item->position !== 'logo')
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>
    <script src="{{url('/public/admin/js/jquery.cropit.js')}}"></script>
    <script>
        $(document).ready(function() {
            var $cropper = $('#image-cropper').cropit({
                initialZoom: 'image',
                smallImage: 'allow',
                freeMove: true,
                @if($item->position == 'image_top')
                exportZoom: 1.875
                @endif
            });

            $('#submit-btn, #btsubmit').on('click', function(e) {
                e.preventDefault();
                var imageData = $('#image-cropper').cropit('export');
                $('#imagedata').val(imageData);
                $('#login-form').submit();
                
            });
        });
    </script>
    @endif
@endsection
@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('search')
    <div class="row search_row">
        <div class="input-field col s12">

        </div>
    </div>
@stop

@section('content')
    <div class="right-align botton-top">
        <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{Config::get('app.url').Config::get('app.admin_directory').'/franchises/list'}}">Volver</a>
    </div>
    <div class="row"><h4>{{ $franchise['name'] }}</h4></div>
    <p>Para evitar que su Perfil se vea incompleto, aconsejamos tener el video y las imágenes preparadas al momento de la carga inicial, para realizar la misma de manera completa, en un solo paso. Luego podrá modificarlas individualmente.</p>
    <div class="row">
        @if(count($items) <= 0)
            <a class="waves-effect waves-light btn blue-grey darken-4" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises-assets/create/'.$franchise['id'] }}">{{ trans('custom.breadcrumbs_create') }}</a>
        @endif
    </div>
    <div class="row">
    @if(count($items) > 0)
        <table class="bordered highlight">
            <thead>
                <tr>
                    <!--th width="50px"></th-->
                    <th>Imagen / Video</th>
                    <th>Posición</th>
                    <th width="150px" class="center">{{ trans('custom.actions') }}</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <!--td><i class="material-icons">swap_vert</i></td-->
                    <td>
                        @if(!empty($franchise['video']))
                            <a href="https://www.youtube.com/watch?v={{$franchise['video']}}" target="_blank">Ver Video</a>
                        @else
                            No se cargo ningun video
                        @endif
                    </td>
                    <td>Video</td>
                    <td class="center">
                        <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises-assets/edit_video/'.$franchise['id'] }}"><i class="material-icons">mode_edit</i></a>
                    </td>
                </tr>
                @foreach($items as $item)
                    <tr data-id="{{ $item->id }}">
                        <!--td><i class="material-icons">swap_vert</i></td-->
                        <td>
                           @if(!empty($item->image))
                               <img src="{{ url('/public/uploads/'.$item->image) }}" width="150px">
                           @endif
                        </td>
                        <td>{{ trans('custom.'.$item->position)  }}</td>
                        <td class="center">
                            <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises-assets/edit/'.$item->franchise_id.'/'.$item->id }}"><i class="material-icons">mode_edit</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <table class="bordered highlight">
            <tbody>{{ trans('custom.no_results') }}</tbody>
        </table>
    @endif
    </div>
    {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises-assets/sort/'.$franchise['id'], 'name' => 'sort-form', 'id' => 'sort-form')) }}
        {{ Form::hidden('order', '', array('id' => 'order')) }}
    {{ Form::close() }}

    <div id="modaldelete" class="modal"></div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('select').material_select();
            //$('#modaldelete').modal();

            var url = '';

            $(document).on('click', '#deleteBtn', function(e){
                e.preventDefault();
                url = $(this).attr('href');

                $.ajax({
                    dataType: 'html',
                    type: 'get',
                    url:  url,
                    success: function (data) {
                        $('#modaldelete').html(data);
                        $('#modaldelete').modal('open');
                    }
                });
            });

            $(document).on('click', '.yesBtn', function(e){
                e.preventDefault();
                $('#delete-form').submit();
            });

            $(document).on('click', '.noBtn', function(e){
                e.preventDefault();
                $('#modaldelete').modal('close');
            });

        });
    </script>

    <script src="{{ Config::get('app.url') }}public/admin/js/jquery-ui.min.js"></script>

    <script>
        {{--$(document).ready(function() {--}}

            {{--$( '#sortable' ).sortable();--}}

            {{--$( '#sortable' ).on( 'sortstop', function( event, ui ) {--}}
                {{--var order = $('#sortable tr').map(function(){--}}
                    {{--return $(this).data('id');--}}
                {{--}).get();--}}

                {{--$('#order').val(order);--}}

                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: '{{ Config::get('app.url').Config::get('app.admin_directory') }}/franchises-assets/sort/{{ $franchise['id'] }}',--}}
                    {{--dataType: 'json',--}}
                    {{--data: $('#sort-form').serialize(),--}}
                    {{--success: function(order){--}}
                        {{--console.log(order)--}}
                    {{--}--}}
                {{--});--}}

            {{--} );--}}
        {{--});--}}
    </script>
@endsection

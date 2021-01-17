@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('search')
    <div class="row search_row">
        <div class="input-field col s12">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises/list', 'method' => 'get', 'class'=>'')) }}
                {{ Form::select('order', array(
                  'name'	    => 'Nombre',
                  'id'		=> 'Id'
                    ), Input::get('order'), array('class' => 'input-field col s2'))
                }}
                {{ Form::select('subject', $subjects, Input::get('subject'), array('class' => 'input-field col s2')) }}
                {{ Form::select('orderby', array(
                    'asc'	 	=> trans('custom.asc'),
                    'desc' 		=> trans('custom.des')
                    ), Input::get('orderby'), array('class' => 'input-field col s2'))
                }}
                {{ Form::select('limit', array(
                    '10'	 	=> trans('custom.limit').' (10)',
                    '50' 		=> '50',
                    '100' 		=> '100'
                    ), Input::get('limit'), array('class' => 'input-field col s2'))
                }}
                <div class="input-field col s2">
                    {{ Form::text('search', Input::get('search'), array('class' => 'col', 'placeholder' => trans('custom.search'))) }}
                </div>
                <div class="input-field col s2">
                    {{ Form::button('<i class="material-icons">search</i>', array('type' => 'submit', 'class' => 'btn-floating btn-small waves-effect waves-light blue-grey darken-4'))}}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        @if($logged_user->hasRole(['root', 'admin']))
            <a class="waves-effect waves-light btn blue-grey darken-4" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/create' }}">{{ trans('custom.breadcrumbs_create') }}</a> <a class="waves-effect waves-light btn blue-grey darken-4 right" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/order' }}">{{ trans('custom.franchises_order') }}</a>
        @endif
    </div>
    <div class="row">
    @if(count($items) > 0)
        <table class="bordered highlight">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Rubros</th>
                    <th width="100px" class="center">Imágenes / Video</th>
                    <th width="100px" class="center">Sucursales</th>
                    <th width="100px" class="center">Zonas Disponibles</th>
                    @if($logged_user->hasRole(['root', 'admin']))
                        <th width="100px" class="center">{{ trans('custom.weekly') }}</th>
                        <th width="100px" class="center">{{ trans('custom.highlights') }}</th>
                    @endif
                    @if($logged_user->hasRole(['root', 'admin']))
                        <th width="100px" class="center">{{ trans('custom.actions') }}</th>
                    @else
                        <th width="100px" class="center">{{ trans('custom.breadcrumbs_edit') }} {{ trans('custom.breadcrumbs_buttom_franchise_edit') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{Config::get('app.url')}}franquicia/preview/{{$item->slug}}" target="_blank" title="Click para previsualizar en el sitio">{{ $item->name }}</a></td>
                        <td>{{ $item->getSubjectName() }}</td>
                        <td class="center"><a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises-assets/list/'.$item->id }}"><i class="material-icons">playlist_add</i></a></td>
                        <td class="center"><a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises-offices/list/'.$item->id }}"><i class="material-icons">playlist_add</i></a></td>
                        <td class="center"><a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises-areas/list/'.$item->id }}"><i class="material-icons">playlist_add</i></a></td>
                    @if($logged_user->hasRole(['root', 'admin']))
                            <td class="center">
                                @if($item->weekly)
                                    <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/weekly/'.$item->id }}"><i class="material-icons">label</i></a>
                                @else
                                    <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/weekly/'.$item->id }}"><i class="material-icons">label_outline</i></a>
                                @endif
                            </td>
                            <td class="center">
                                @if($item->highlights)
                                    <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/highlights/'.$item->id }}"><i class="material-icons">label</i></a>
                                @else
                                    <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/highlights/'.$item->id }}"><i class="material-icons">label_outline</i></a>
                                @endif
                            </td>
                            <td class="center">
                                @if($item->visible)
                                    <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/visibility/'.$item->id }}"><i class="material-icons">visibility</i></a>
                                @else
                                    <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/visibility/'.$item->id }}"><i class="material-icons">visibility_off</i></a>
                                @endif
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/edit/'.$item->id }}"><i class="material-icons">mode_edit</i></a>

                                <a id="deleteBtn" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/delete/'.$item->id }}"><i class="material-icons">delete</i></a>
                            </td>
                        @else
                            <td class="center">
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/edit/'.$item->id }}"><i class="material-icons">mode_edit</i></a>
                            </td>
                        @endif

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
    <div class="row col s12 m6 offset-m4">{{ $items->appends(['order' => Input::get('order'), 'orderby' => Input::get('orderby'), 'limit' => Input::get('limit'), 'subject' => Input::get('subject')])->links() }}</div>

    <div id="modaldelete" class="modal"></div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('select').material_select();
            $('#modaldelete').modal();

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
@endsection

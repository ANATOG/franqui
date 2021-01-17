@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('search')
    <div class="row search_row">
        <div class="input-field col s12">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/videos/list', 'method' => 'get', 'class'=>'')) }}
                {{ Form::select('order', array(
                    'id'		=> 'Id',
                    'title'	    => 'Título',
                    ), Input::get('order'), array('class' => 'input-field col s2'))
                }}
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
    <div class="row"><a class="waves-effect waves-light btn blue-grey darken-4" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/videos/create' }}">{{ trans('custom.breadcrumbs_create') }}</a></div>
    <div class="row">
    @if(count($items) > 0)
        <table class="bordered highlight">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th width="150px" class="center">{{ trans('custom.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td class="center">
                            @if($item->visible)
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/videos/visibility/'.$item->id }}"><i class="material-icons">visibility</i></a>
                            @else
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/videos/visibility/'.$item->id }}"><i class="material-icons">visibility_off</i></a>
                            @endif
                            <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/videos/edit/'.$item->id }}"><i class="material-icons">mode_edit</i></a>

                            <a id="deleteBtn" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/videos/delete/'.$item->id }}"><i class="material-icons">delete</i></a>
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
    <div class="row col s12 m6 offset-m4">{{ $items->appends(['order' => Input::get('order'), 'orderby' => Input::get('orderby'), 'limit' => Input::get('limit')])->links() }}</div>

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
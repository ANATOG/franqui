@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('search')
    <div class="row search_row">
    </div>
@stop

@section('content')
    <div class="row"><a class="waves-effect waves-light btn blue-grey darken-4" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/consultants/create' }}">{{ trans('custom.breadcrumbs_create') }}</a></div>
    <div class="row">
    @if(count($items) > 0)
        <table class="bordered highlight">
            <thead>
                <tr>
                    <th width="50px"></th>
                    <th>#</th>
                    <th>Título</th>
                    <th width="150px" class="center">{{ trans('custom.actions') }}</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($items as $item)
                    <tr data-id="{{ $item->id }}">
                        <td><i class="material-icons">swap_vert</i></td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td class="center">
                            @if($item->visible)
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/consultants/visibility/'.$item->id }}"><i class="material-icons">visibility</i></a>
                            @else
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/consultants/visibility/'.$item->id }}"><i class="material-icons">visibility_off</i></a>
                            @endif
                            <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/consultants/edit/'.$item->id }}"><i class="material-icons">mode_edit</i></a>

                            <a id="deleteBtn" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/consultants/delete/'.$item->id }}"><i class="material-icons">delete</i></a>
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
    {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/answers/sort/', 'name' => 'sort-form', 'id' => 'sort-form')) }}
    {{ Form::hidden('order', '', array('id' => 'order')) }}
    {{ Form::close() }}

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
                    dataType: "html",
                    type: "get",
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

    <script src="{{ Config::get('app.url') }}admin/js/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {

            $( '#sortable' ).sortable();

            $( '#sortable' ).on( 'sortstop', function( event, ui ) {
                var order = $('#sortable tr').map(function(){
                    return $(this).data('id');
                }).get();

                $('#order').val(order);

                $.ajax({
                    type: 'POST',
                    url: '{{ Config::get('app.url').Config::get('app.admin_directory') }}/consultants/sort',
                    dataType: 'json',
                    data: $('#sort-form').serialize(),
                    success: function(order){
                        console.log(order)
                    }
                });

            } );
        });
    </script>
@endsection

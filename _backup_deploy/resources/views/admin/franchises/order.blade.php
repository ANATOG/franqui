@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('search')

    <div class="row search_row">
        <div class="input-field col s12">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises/order', 'method' => 'get', 'class' => 'sort_form')) }}
                <h4 class="left">Rubro: {{ $subjects[$subjects_id] }}</h4>
                {{ Form::select('subjectId', $subjects, $subjects_id, array('class' => 'input-field col s2 right', 'id' => 'subject_order')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('content')
    <div class="row"></div>
    <div class="row"><a class="waves-effect waves-light btn blue-grey darken-4" href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/list' }}">{{ trans('custom.return_to') }}</a></div>
    <div class="row">
    @if(count($items) > 0)
        <table class="bordered highlight">
            <thead>
                <tr>
                    <th width="50px"></th>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Rubro</th>
                    <th width="150px" class="center">{{ trans('custom.highlights') }}</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($items as $item)
                    <tr data-id="{{ $item->id }}">
                        <td><i class="material-icons">swap_vert</i></td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->getSubjectName() }}</td>
                        <td class="center">
                            @if($item->highlights)
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/highlights/'.$item->id }}"><i class="material-icons">label</i></a>
                            @else
                                <a href="{{ Config::get('app.url').Config::get('app.admin_directory').'/franchises/highlights/'.$item->id }}"><i class="material-icons">label_outline</i></a>
                            @endif
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
    {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises/sort/'.$subjects_id, 'name' => 'sort-form', 'id' => 'sort-form')) }}
        {{ Form::hidden('order', '', array('id' => 'order')) }}
    {{ Form::close() }}
    <div class="row col s12 m6 offset-m4">{{ $items->appends(["order" => Input::get('order'), "orderby" => Input::get('orderby'), "limit" => Input::get('limit')])->links() }}</div>

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

            $(document).on('change', '#subject_order', function(e){
                e.preventDefault();
                $('.sort_form').submit();
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
                    url: '{{ Config::get('app.url').Config::get('app.admin_directory') }}/franchises/sort',
                    dataType: "json",
                    data: $("#sort-form").serialize(),
                    success: function(order){
                        console.log(order)
                    }
                });

            } );
        });
    </script>

@endsection
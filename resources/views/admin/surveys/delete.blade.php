<div class="modal-content">
    <h4>{{ trans('custom.breadcrumbs_delete') }}</h4>
    <p>{{ trans('custom.are_you_sure', ['itemDelete' => $item->question]) }}</p>
</div>
<div class="modal-footer">
    <a href="#" class="noBtn modal-action modal-close waves-effect waves-green btn-flat">{{ trans('custom.no') }}</a>
    <a href="#" class="yesBtn modal-action modal-close waves-effect waves-green btn-flat">{{ trans('custom.yes') }}</a>
    {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/surveys/delete/'.$item->id, 'name' => 'delete-form', 'id' => 'delete-form', 'method' => 'delete')) }}
    {{ Form::close() }}
</div>
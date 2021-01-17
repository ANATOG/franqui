@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises-offices/edit/'.$franchise_id.'/'.$item->id, 'name' => 'login-form', 'id' => 'login-form', 'method' => 'put', 'enctype' => 'multipart/form-data')) }}
                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <div class="input-field col s12">
                    {{ Form::text('name', (isset($item->name))?$item->name:old('name')) }}
                    <label for="name" data-error="wrong" data-success="right">Nombre del local</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('full_direction', (isset($item->full_direction))?$item->full_direction:old('full_direction'), array('id' => 'autocomplete', 'placeholder'=>'')) }}
                    <label for="full_direction" data-error="wrong" data-success="right">Dirección</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('country', (isset($item->country))?$item->country:old('country')) }}
                    <label for="country" data-error="wrong" data-success="right">País de origen</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('latitud', (isset($item->lat))?$item->lat:old('lat'), array('id' => 'lat')) }}
                    <label for="latitud" data-error="wrong" data-success="right">Latitud</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('longitud', (isset($item->lng))?$item->lng:old('lng'), array('id' => 'lng')) }}
                    <label for="longitud" data-error="wrong" data-success="right">Longitud</label>
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

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsevE2_lfTi_IuLaOT3vv_tNMIKah49kg&libraries=places"></script>

    <script>
        var autocomplete;
        var componentForm = {
            country: 'long_name',
        };

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById('autocomplete')),{types: ['geocode']}
            );
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            var place = autocomplete.getPlace();

            // for (var component in componentForm) {
            //     document.getElementById(component).value = '';
            //     document.getElementById(component).disabled = false;
            // }

            // for (var i = 0; i < place.address_components.length; i++) {
            //     var addressType = place.address_components[i].types[0];
            //     if (componentForm[addressType]) {
            //         var val = place.address_components[i][componentForm[addressType]];
            //         document.getElementById(addressType).value = val;
            //     }
            // }

            $("#country").focusin();
            $("#lat").val(place.geometry.location.lat());
            $("#lng").val(place.geometry.location.lng());
        }

        $(document).ready(function() {
            initAutocomplete();
        });
    </script>
@endsection
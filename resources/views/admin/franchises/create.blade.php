@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises/create', 'name' => 'login-form', 'id' => 'login-form', 'enctype' => 'multipart/form-data')) }}

                <div class="right-align botton-top">
                    <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                    {{ Form::button(trans('custom.breadcrumbs_create'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                </div>

                <h5><u>Datos de Franquicia:</u></h5>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('name',old('name'), array('id' => 'name')) }}
                        <label for="name" data-error="wrong" data-success="right">Nombre (nombre visible en la ficha de Franquicia)</label>
                    </div>
                </div>

                <div class="input-field col s12">
                    {{ Form::select('subject_id', $subjects,(isset($item->subject_id))?$item->subject_id:'', array('class' => 'subject_id')) }}
                    <label>Rubro</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::select('thematic_id', $thematics,(isset($item->thematic_id))?$item->thematic_id:'', array('class' => 'thematic_id')) }}
                    <label>Temática</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::select('user_id', $users,(isset($item->user_id))?$item->user_id:'', array('class' => 'user_id')) }}
                    <label>Usuario</label>
                </div>

            <h5><u>Sugeridas:</u></h5>
                <div class="input-field col s12">
                    {{ Form::select('first_suggested', $franchises, (isset($item->first_suggested))?$item->first_suggested:old('first_suggested'), array('class' => 'first_suggested')) }}
                    <label for="first_suggested" data-error="wrong" data-success="right">Primer Sugerida</label>
                </div>
                <div class="input-field col s12">
                    {{ Form::select('second_suggested', $franchises, (isset($item->second_suggested))?$item->second_suggested:old('second_suggested'), array('class' => 'second_suggested')) }}
                    <label for="second_suggested" data-error="wrong" data-success="right">Segunda Sugerida</label>
                </div>
                <div class="input-field col s12">
                    {{ Form::select('third_suggested', $franchises, (isset($item->third_suggested))?$item->third_suggested:old('third_suggested'), array('class' => 'third_reasons')) }}
                    <label for="third_reasons" data-error="wrong" data-success="right">Tercera Sugerida</label>
                </div>


            <h5><u>Información de la Empresa para Facturación:</u></h5>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('business_name',old('business_name'), array('id' => 'business_name')) }}
                        <label for="business_name" data-error="wrong" data-success="right">Razón Social</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('vat_condition',old('vat_condition'), array('id' => 'vat_condition')) }}
                        <label for="vat_condition" data-error="wrong" data-success="right">Condición de IVA</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('cuit',old('cuit'), array('id' => 'cuit')) }}
                        <label for="cuit" data-error="wrong" data-success="right">CUIT</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('contact_address',old('contact_address'), array('id' => 'contact_address')) }}
                        <label for="contact_address" data-error="wrong" data-success="right">Dirección</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('authorizes_recruitment',old('authorizes_recruitment'), array('id' => 'authorizes_recruitment')) }}
                        <label for="authorizes_recruitment" data-error="wrong" data-success="right">Persona que autoriza la contratación</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('contrac_phone',old('contrac_phone'), array('id' => 'contrac_phone')) }}
                        <label for="contrac_phone" data-error="wrong" data-success="right">Teléfono de contacto</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('contact_email',old('contact_email'), array('id' => 'contact_email')) }}
                        <label for="contact_email" data-error="wrong" data-success="right">Email de contacto</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('contracting_period',old('contracting_period'), array('id' => 'contracting_period')) }}
                        <label for="contracting_period" data-error="wrong" data-success="right">Período de contratación</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::text('way_pay',old('way_pay'), array('id' => 'way_pay')) }}
                        <label for="way_pay" data-error="wrong" data-success="right">Forma de pago</label>
                    </div>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('contact_name',(isset($item->contact_name))?$item->contact_name:old('contact_name'), array('id' => 'contact_name')) }}
                    <label for="contact_name" data-error="wrong" data-success="right">Nombre y cargo del contacto</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('phone',(isset($item->phone))?$item->phone:old('phone'), array('id' => 'phone')) }}
                    <label for="phone" data-error="wrong" data-success="right">Teléfono</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('email',(isset($item->email))?$item->email:old('email'), array('id' => 'email')) }}
                    <label for="email" data-error="wrong" data-success="right">Email</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('website',(isset($item->website))?$item->website:old('website'), array('id' => 'website')) }}
                    <label for="website" data-error="wrong" data-success="right">Sitio Web</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('facebook',(isset($item->facebook))?$item->facebook:old('facebook'), array('id' => 'facebook')) }}
                    <label for="facebook" data-error="wrong" data-success="right">Facebook</label>
                </div>

                <div class="input-field col s12">
                    {{ Form::text('twitter',(isset($item->twitter))?$item->twitter:old('twitter'), array('id' => 'twitter')) }}
                    <label for="twitter" data-error="wrong" data-success="right">Twitter</label>
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
            $('.subjects_id option:first').attr('disabled','disabled');
            $('select').material_select();
        });
    </script>
@endsection
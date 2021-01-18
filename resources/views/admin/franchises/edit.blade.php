@extends('layouts.layoutAdmin')

@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <a href="javascript:void(0)" class="breadcrumb">{{ $breadcrumb }}</a>
    @endforeach
@endsection

@section('content')
    <div>
        <div class="row">
            {{ Form::open(array('url' => Config::get('app.url').Config::get('app.admin_directory').'/franchises/edit/'.$item->id, 'name' => 'login-form', 'id' => 'login-form', 'method' => 'put', 'enctype' => 'multipart/form-data')) }}
                <div class="row">

                    <div class="right-align botton-top">
                        <a class="btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1" href="{{ url()->previous() }}">Volver</a>
                        {{ Form::button(trans('custom.breadcrumbs_buttom_edit'), array('type' => 'submit', 'id' =>'btsubmit', 'class' => 'btn waves-effect waves-light btlogin blue-grey lighten-1 darken-1')) }}
                    </div>

                    <h5><u>Perfil de tu Franquicia:</u></h5>
                    <div class="input-field col s12">
                        {{ Form::text('name',(isset($item->name))?$item->name:old('name'), array('id' => 'name')) }}
                        <label for="name" data-error="wrong" data-success="right">Marca (nombre de tu franquicia)</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::select('subject_id', $subjects,(isset($item->subject_id))?$item->subject_id:'', array('class' => 'subject_id')) }}
                        <label>Rubro</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('description_red',(isset($item->description_red))?$item->description_red:old('description_red'), array('id' => 'description_red')) }}
                        <label for="description_red" data-error="wrong" data-success="right">Descripción rubro</label>
                    </div>

                    @if($logged_user->getRoleName() == 'root' || $logged_user->getRoleName() == 'admin')
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
                            {{ Form::select('first_suggested', $franchises, $item->first_suggested, array('class' => 'first_suggested')) }}
                            <label for="first_suggested" data-error="wrong" data-success="right">Primer Sugerida</label>
                        </div>
                        <div class="input-field col s12">
                            {{ Form::select('second_suggested', $franchises, $item->second_suggested, array('class' => 'second_suggested')) }}
                            <label for="second_suggested" data-error="wrong" data-success="right">Segunda Sugerida</label>
                        </div>
                        <div class="input-field col s12">
                            {{ Form::select('third_suggested', $franchises, $item->third_suggested, array('class' => 'third_reasons')) }}
                            <label for="third_reasons" data-error="wrong" data-success="right">Tercera Sugerida</label>
                        </div>

                    @endif

                    <h5><u>Información de la Empresa para Facturación:</u></h5>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('business_name',(isset($item->business_name))?$item->business_name:old('business_name'), array('id' => 'business_name')) }}
                            <label for="business_name" data-error="wrong" data-success="right">Razón Social</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('vat_condition',(isset($item->vat_condition))?$item->vat_condition:old('vat_condition'), array('id' => 'vat_condition')) }}
                            <label for="vat_condition" data-error="wrong" data-success="right">Condición de IVA</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('cuit',(isset($item->cuit))?$item->cuit:old('cuit'), array('id' => 'cuit')) }}
                            <label for="cuit" data-error="wrong" data-success="right">CUIT</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('contact_address',(isset($item->contact_address))?$item->contact_address:old('contact_address'), array('id' => 'contact_address')) }}
                            <label for="contact_address" data-error="wrong" data-success="right">Dirección</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('authorizes_recruitment',(isset($item->authorizes_recruitment))?$item->authorizes_recruitment:old('authorizes_recruitment'), array('id' => 'authorizes_recruitment')) }}
                            <label for="authorizes_recruitment" data-error="wrong" data-success="right">Persona que autoriza la contratación</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('contrac_phone',(isset($item->contrac_phone))?$item->contrac_phone:old('contrac_phone'), array('id' => 'contrac_phone')) }}
                            <label for="contrac_phone" data-error="wrong" data-success="right">Teléfono de contacto</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('contact_email',(isset($item->contact_email))?$item->contact_email:old('contact_email'), array('id' => 'contact_email')) }}
                            <label for="contact_email" data-error="wrong" data-success="right">Email de contacto</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('contracting_period',(isset($item->contracting_period))?$item->contracting_period:old('contracting_period'), array('id' => 'contracting_period')) }}
                            <label for="contracting_period" data-error="wrong" data-success="right">Período de contratación</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ Form::text('way_pay',(isset($item->way_pay))?$item->way_pay:old('way_pay'), array('id' => 'way_pay')) }}
                            <label for="way_pay" data-error="wrong" data-success="right">Forma de pago</label>
                        </div>
                    </div>

                    <h5><u>Perfil Operativo:</u></h5>
                    <div class="input-field col s12">
                        {{ Form::textarea('description',(isset($item->description))?$item->description:old('description'), array('id' => 'description', 'class' => 'materialize-textarea')) }}
                        <label for="description" data-error="wrong" data-success="right">Descripción (descripción de la franquicia)</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('country',(isset($item->country))?$item->country:old('country'), array('id' => 'country')) }}
                        <label for="country" data-error="wrong" data-success="right">País de origen</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('country_in',(isset($item->country_in))?$item->country_in:old('country_in'), array('id' => 'country_in')) }}
                        <label for="country_in" data-error="wrong" data-success="right">Países con presencia</label>
                    </div>
                    
                    <div class="input-field col s12">
                        <select 
                                class="selectpicker show-menu-arrow" id="countries_show" name="countries_show[]" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title="-- Seleccionar los países donde ofrecera franquicias --"
                                multiple="multiple">
                                @include('admin.franchises.options')                                                   
                        </select> 
                        <label for="countries_show" data-error="wrong" data-success="right">Países para ofertar (Seleccione al menos uno)</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::text('grand_open',(isset($item->grand_open))?$item->grand_open:old('grand_open'), array('id' => 'grand_open')) }}
                        <label for="grand_open" data-error="wrong" data-success="right">Año de inicio de la empresa</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('franchises_first_open',(isset($item->franchises_first_open))?$item->franchises_first_open:old('franchises_first_open'), array('id' => 'franchises_first_open')) }}
                        <label for="franchises_first_open" data-error="wrong" data-success="right">Apertura primera franquicia</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('franchises_local',(isset($item->franchises_local))?$item->franchises_local:old('franchises_local'), array('id' => 'franchises_local')) }}
                        <label for="franchises_local" data-error="wrong" data-success="right">Locales Propios</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('franchises_total',(isset($item->franchises_total))?$item->franchises_total:old('franchises_total'), array('id' => 'franchises_total')) }}
                        <label for="franchises_total" data-error="wrong" data-success="right">Locales Franquiciados</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('franchises_this_year',(isset($item->franchises_this_year))?$item->franchises_this_year:old('franchises_this_year'), array('id' => 'franchises_this_year')) }}
                        <label for="franchises_this_year" data-error="wrong" data-success="right">Franquicias otorgadas el último año</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('partners',(isset($item->partners))?$item->partners:old('partners'), array('id' => 'partners')) }}
                        <label for="partners" data-error="wrong" data-success="right">socio de</label>
                    </div>

                    {{-- @if($logged_user->getRoleName() == 'root' || $logged_user->getRoleName() == 'admin') --}}

                        <div class="input-field col s12">
                            {{ Form::text('contact_name',(isset($item->contact_name))?$item->contact_name:old('contact_name'), array('id' => 'contact_name')) }}
                            <label for="contact_name" data-error="wrong" data-success="right">Nombre y cargo del contacto (Este dato no se visualiza en el perfil)</label>
                        </div>
                        <div class="input-field col s12">
                            {{ Form::text('phone',(isset($item->phone))?$item->phone:old('phone'), array('id' => 'phone')) }}
                            <label for="phone" data-error="wrong" data-success="right">Teléfono (Este dato no se visualiza en el perfil)</label>
                        </div>
                        <div class="input-field col s12">
                            {{ Form::text('email',(isset($item->email))?$item->email:old('email'), array('id' => 'email')) }}
                            <label for="email" data-error="wrong" data-success="right">Email (Este dato no se visualiza en el perfil)</label>
                        </div>
                        <div class="input-field col s12">
                            {{ Form::text('website',(isset($item->website))?$item->website:old('website'), array('id' => 'website')) }}
                            <label for="website" data-error="wrong" data-success="right">Sitio Web (Este dato no se visualiza en el perfil)</label>
                        </div>
                        <div class="input-field col s12">
                            {{ Form::text('facebook',(isset($item->facebook))?$item->facebook:old('facebook'), array('id' => 'facebook')) }}
                            <label for="facebook" data-error="wrong" data-success="right">Facebook (Este dato no se visualiza en el perfil)</label>
                        </div>
                        <div class="input-field col s12">
                            {{ Form::text('twitter',(isset($item->twitter))?$item->twitter:old('twitter'), array('id' => 'twitter')) }}
                            <label for="twitter" data-error="wrong" data-success="right">Twitter (Este dato no se visualiza en el perfil)</label>
                        </div>

                    {{-- @endif --}}

                    <h5><u>Perfil Económico:</u></h5>
                    <div class="input-field col s12">
                        {{ Form::text('fee',(isset($item->fee))?$item->fee:old('fee'), array('id' => 'fee')) }}
                        <label for="fee" data-error="wrong" data-success="right">Canon/Fee de ingreso</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('total_investment',(isset($item->total_investment))?$item->total_investment:old('total_investment'), array('id' => 'total_investment')) }}
                        <label for="total_investment" data-error="wrong" data-success="right">Inversión total</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('royalty',(isset($item->royalty))?$item->royalty:old('royalty'), array('id' => 'royalty')) }}
                        <label for="royalty" data-error="wrong" data-success="right">Regalías/Royalty</label>
                    </div>
                    <div class="input-field col s12">
                        {{-- {{ Form::text('corporate_advertising',(isset($item->corporate_advertising))?$item->corporate_advertising:old('corporate_advertising'), array('id' => 'corporate_advertising')) }} --}}
                        {{ Form::select('corporate_advertising', array(
                            'Si'        =>  "Si",
                            'No'        =>  "No"
                            ), (isset($item->corporate_advertising))?$item->corporate_advertising:'', array('class' => 'role_id'))
                        }}
                        <label for="corporate_advertising" data-error="wrong" data-success="right">Publicidad corporativa</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('canon_advertising',(isset($item->canon_advertising))?$item->canon_advertising:old('canon_advertising'), array('id' => 'canon_advertising')) }}
                        <label for="canon_advertising" data-error="wrong" data-success="right">Canon de publicidad</label>
                    </div>
                    <div class="input-field col s12">
                        {{-- {{ Form::text('financing_available',(isset($item->financing_available))?$item->financing_available:old('financing_available'), array('id' => 'financing_available')) }} --}}
                        {{ Form::select('financing_available', array(
                            'Si'        =>  "Si",
                            'No'        =>  "No"
                            ), (isset($item->financing_available))?$item->financing_available:'', array('class' => 'role_id'))
                        }}
                        <label for="financing_available" data-error="wrong" data-success="right">Financiación disponible</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('average_annual',(isset($item->average_annual))?$item->average_annual:old('average_annual'), array('id' => 'average_annual')) }}
                        <label for="average_annual" data-error="wrong" data-success="right">Facturación promedio anual por local</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('recover_estimated',(isset($item->recover_estimated))?$item->recover_estimated:old('recover_estimated'), array('id' => 'recover_estimated')) }}
                        <label for="recover_estimated" data-error="wrong" data-success="right">Recupero estimado en meses</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('premises_size',(isset($item->premises_size))?$item->premises_size:old('premises_size'), array('id' => 'premises_size')) }}
                        <label for="premises_size" data-error="wrong" data-success="right">Dimensión mínima del local en m2</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('employees',(isset($item->employees))?$item->employees:old('employees'), array('id' => 'employees')) }}
                        <label for="employees" data-error="wrong" data-success="right">Empleados por local</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('contract_term',(isset($item->contract_term))?$item->contract_term:old('contract_term'), array('id' => 'contract_term')) }}
                        <label for="contract_term" data-error="wrong" data-success="right">Vigencia del contrato en años</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::select('exportable_franchise', array(
                            'Si'		=>	"Si",
                            'No'		=>	"No"
                            ), (isset($item->exportable_franchise))?$item->exportable_franchise:'', array('class' => 'role_id'))
					    }}
                        <label for="exportable_franchise" data-error="wrong" data-success="right">Franquicia exportable (Si/No)</label>
                    </div>

                    <h5><u>5 Razones para elegir nuestra franquicia:</u></h5>
                    <div class="input-field col s12">
                        {{ Form::text('first_reasons',(isset($item->first_reasons))?$item->first_reasons:old('first_reasons'), array('id' => 'first_reasons')) }}
                        <label for="first_reasons" data-error="wrong" data-success="right">Primera</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('second_reasons',(isset($item->second_reasons))?$item->second_reasons:old('second_reasons'), array('id' => 'second_reasons')) }}
                        <label for="second_reasons" data-error="wrong" data-success="right">Segunda</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('third_reasons',(isset($item->third_reasons))?$item->third_reasons:old('third_reasons'), array('id' => 'third_reasons')) }}
                        <label for="third_reasons" data-error="wrong" data-success="right">Tercera</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('fourth_reasons',(isset($item->fourth_reasons))?$item->fourth_reasons:old('fourth_reasons'), array('id' => 'fourth_reasons')) }}
                        <label for="fourth_reasons" data-error="wrong" data-success="right">Cuarta</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('fifth_reasons',(isset($item->fifth_reasons))?$item->fifth_reasons:old('fifth_reasons'), array('id' => 'fifth_reasons')) }}
                        <label for="fifth_reasons" data-error="wrong" data-success="right">Quinta</label>
                    </div>

                    @if($logged_user->getRoleName() == 'root' || $logged_user->getRoleName() == 'admin')

                    <h5><u>Metadatos:</u></h5>
                    <div class="input-field col s12">
                        {{ Form::text('meta_title',(isset($item->meta_title))?$item->meta_title:old('meta_title'), array('id' => 'meta_title')) }}
                        <label for="meta_title" data-error="wrong" data-success="right">Meta title</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('meta_description',(isset($item->meta_description))?$item->meta_description:old('meta_description'), array('id' => 'meta_description')) }}
                        <label for="meta_description" data-error="wrong" data-success="right">Meta Descripción</label>
                    </div>
                    <div class="input-field col s12">
                        {{ Form::text('meta_keywords',(isset($item->meta_keywords))?$item->meta_keywords:old('meta_keywords'), array('id' => 'meta_keywords')) }}
                        <label for="meta_keywords" data-error="wrong" data-success="right">Meta Keywords</label>
                    </div>

                    <div class="input-field col s12">
                        {{ Form::select('tags[]', $tags, $item->getTagsIds(), array('class' => 'tags', 'multiple')) }}
                        <label>Tags</label>
                    </div>
                    @else
                        {{ Form::hidden('meta_title',(isset($item->meta_title))?$item->meta_title:old('meta_title'), array('id' => 'meta_title')) }}
                        {{ Form::hidden('meta_description',(isset($item->meta_description))?$item->meta_description:old('meta_description'), array('id' => 'meta_description')) }}
                        {{ Form::hidden('meta_keywords',(isset($item->meta_keywords))?$item->meta_keywords:old('meta_keywords'), array('id' => 'meta_keywords')) }}
                    @endif

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
            $('#description').trigger('autoresize');

            $('.video_type option:first').attr('disabled','disabled');
            $('.tags option:first').attr('disabled','disabled');
            $('select').material_select();
            
        });
    </script>


    @php
     $texto=str_replace(['"','[',']'],'',$item->countries_show);
    @endphp
   <script>
        var values = "<?php echo $texto;?>";
        console.log(values);
        $.each(values.split(","), function(i,e){
            $("#countries_show option[value='" + e + "']").prop("selected", true);
        });
    </script>

    
@endsection

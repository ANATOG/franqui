@extends('layouts.layout')

@section('metadata')
    <title>Franquiciar - {{ $franchise[0]->meta_title }}</title>
    <meta name="description" content="{{ $franchise[0]->meta_description }}"/>
    <meta name="keywords" content="{{ $franchise[0]->meta_keywords }}"/>

    <meta property="og:url"                content="{{ Config::get('app.url') }}franquicia/{{ $franchise[0]->slug }}" />
    <meta property="og:title"              content="Franquiciar - {{ $franchise[0]->meta_title }}" />
    <meta property="og:description"        content="{{ str_limit($franchise[0]->description, $limit = 150, $end = '...') }}" />
    <meta property="og:image"              content="{{ Config::get('app.url') }}uploads/{{ $franchiseImages['image_top'] }}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@franquiciar" />
    <meta name="twitter:title" content="Franquiciar - {{ $franchise[0]->meta_title }}" />
    <meta name="twitter:description" content="{{ str_limit($franchise[0]->description, $limit = 150, $end = '...') }}" />
    <meta name="twitter:image" content="{{ Config::get('app.url') }}uploads/{{ $franchiseImages['image_top'] }}" />
@endsection

@section('content')

    <section class="section__franchise-item">

        <aside class="franchise-item__fixed-info" data-show-info="false">

            <div class="center-wrapper">
                <h1 class="fixed-info__title">{{ $franchise[0]->name }}</h1>

                <div class="fixed-info__wrapper">
                    <div class="center-wrapper">
                        <ul class="fixed-info__list">

                            <li class="fixed-info__item">
                                <h2 class="fixed-info__item__title">Año de inicio</h2>
                                <p class="fixed-info__item__text">{{ (isset($franchise[0]->grand_open) && !empty($franchise[0]->grand_open)) ? $franchise[0]->grand_open : '-' }}</p>
                            </li>

                            <li class="fixed-info__item">
                                <h2 class="fixed-info__item__title">Locales propios</h2>
                                <p class="fixed-info__item__text">{{ (isset($franchise[0]->franchises_local) && !empty($franchise[0]->franchises_local)) ? $franchise[0]->franchises_local : '-' }}</p>
                            </li>

                            <li class="fixed-info__item">
                                <h2 class="fixed-info__item__title">Locales franquiciados</h2>
                                <p class="fixed-info__item__text">{{ (isset($franchise[0]->franchises_total) && !empty($franchise[0]->franchises_total)) ? $franchise[0]->franchises_total : '-' }}</p>
                            </li>

                            <li class="fixed-info__item">
                                <h2 class="fixed-info__item__title">Inversión total</h2>
                                <p class="fixed-info__item__text">{{ $franchise[0]->total_investment }}</p>
                            </li>

                        </ul>

                        @include('frontend.includes.component_button-list', ['franchise' => $franchise[0], 'favorites' => $favorites])

                    </div>
                </div>

                <i class="fixed-info__arrow">
                    <span>
                        <svg width="100%" height="100%" viewBox="0 0 30 50">
                            <use xlink:href="#svg-symbol__arrow-3"></use>
                        </svg>
                    </span>
                </i>

                <a class="fixed-info__btn{{ (empty($loggedUser)) ? ' js-open-user-login' : ' js-open-contact' }}" href="#"><span>Contactar franquicia</span></a>

            </div>

        </aside>


        <div class="franchise-item__img-top">
            <i style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchiseImages['image_top'] }}')"></i>
        </div>

        <div class="franchise-item__wrapper">
            <section class="franchise-item__info">

                <div class="center-wrapper">

                    <article class="info__top">
                        <div class="info__top__wrapper info__top__wrapper--left">
                            <div class="info__top__category">
                                <i style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchise[0]->getSubjectImage() }}')"></i>
                                <span>{{ $franchise[0]->getSubjectName() }}</span>
                            </div>
                            <i class="info__top__img"
                                style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchiseImages['logo'] }}')"></i>
                        </div>

                        <div class="info__top__wrapper info__top__wrapper--right">
                            <aside class="info__top__aside">
                                @include('frontend.includes.component_button-list', ['franchise' => $franchise[0], 'favorites' => $favorites])
                                <a href="#" class="info__top__back || js-back">Volver</a>
                            </aside>

                            <h1 class="info__top__title">{{ $franchise[0]->name }}</h1>

                            <p class="info__top__text">{{ (isset($franchise[0]->description) && !empty($franchise[0]->description)) ? $franchise[0]->description : '-' }}</p>

                            <a href="#" class="info__top__btn{{ (empty($loggedUser)) ? ' js-open-user-login' : ' js-open-contact' }}"><span>Contactar franquicia</span><i></i></a>
                        </div>
                    </article>

                    <article class="info__bottom">
                        <ul class="info__bottom__list">
                            <li class="info__bottom__item">
                                <p class="info__bottom__text">{{ (isset($franchise[0]->grand_open) && !empty($franchise[0]->grand_open)) ? $franchise[0]->grand_open : '-' }}</p>
                                <small class="info__bottom__small">Año de inicio</small>
                            </li>

                            <li class="info__bottom__item">
                                <p class="info__bottom__text">{{ (isset($franchise[0]->franchises_local) && !empty($franchise[0]->franchises_local)) ? $franchise[0]->franchises_local : '-' }}</p>
                                <small class="info__bottom__small">Locales propios</small>
                            </li>

                            <li class="info__bottom__item">
                                <p class="info__bottom__text">{{ (isset($franchise[0]->franchises_total) && !empty($franchise[0]->franchises_total)) ? $franchise[0]->franchises_total : '-' }}</p>
                                <small class="info__bottom__small">Locales franquiciados</small>
                            </li>

                            <li class="info__bottom__item">
                                <p class="info__bottom__text">{{ $franchise[0]->total_investment }}</p>
                                <small class="info__bottom__small">Inversión total</small>
                            </li>
                        </ul>
                    </article>

                </div>

            </section>


            @if(isset($franchise[0]->video) && !empty($franchise[0]->video))
                <div class="franchise-item__video">
                    <div class="center-wrapper">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{$franchise[0]->video}}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            @endif

            <div class="franchise-item__data">
                <div class="center-wrapper">

                    <section class="data__wrapper data__wrapper--operative">

                        <div class="data__img">
                            <i style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchiseImages['right_one'] }}')"></i>
                        </div>

                        <div class="data__info">
                            <h1 class="franchise-item__title franchise-item__title--1">Datos operativos</h1>
                            <div class="data__table">
                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Descripcion Rubro</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->description_red) && !empty($franchise[0]->description_red)) ? $franchise[0]->description_red : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">País de origen</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->country) && !empty($franchise[0]->country)) ? $franchise[0]->country : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Países con presencia</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->country_in) && !empty($franchise[0]->country_in)) ? $franchise[0]->country_in : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Apertura primera franquicia</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->franchises_first_open) && !empty($franchise[0]->franchises_first_open)) ? $franchise[0]->franchises_first_open : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Franquicias otorgadas el último año</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->franchises_this_year) && !empty($franchise[0]->franchises_this_year)) ? $franchise[0]->franchises_this_year : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Socio de</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->partners) && !empty($franchise[0]->partners)) ? $franchise[0]->partners : '-' }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </section>

                    <section class="data__wrapper data__wrapper--economic">

                        <div class="data__img">
                            <div class="data__img__item">
                                <i style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchiseImages['left_one'] }}')"></i>
                            </div>
                            <div class="data__img__item">
                                <i style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchiseImages['left_two'] }}')"></i>
                            </div>
                            <div class="data__img__item">
                                <i style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchiseImages['left_three'] }}')"></i>
                            </div>
                        </div>

                        <div class="data__info">
                            <h1 class="franchise-item__title franchise-item__title--1">Datos economicos</h1>
                            <div class="data__table">
                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Canon/Fee de ingreso</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ $franchise[0]->fee }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Inversión total</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ $franchise[0]->total_investment }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Regalías/Royalty</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->royalty) && !empty($franchise[0]->royalty)) ?  $franchise[0]->royalty : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Publicidad corporativa</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->corporate_advertising) && !empty($franchise[0]->corporate_advertising)) ?  $franchise[0]->corporate_advertising : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Canon de publicidad</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->canon_advertising) && !empty($franchise[0]->canon_advertising)) ? $franchise[0]->canon_advertising : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Financiación disponible</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->financing_available) && !empty($franchise[0]->financing_available)) ?  $franchise[0]->financing_available : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Facturación promedio anual por local</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ $franchise[0]->average_annual }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Recupero estimado</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->recover_estimated) && !empty($franchise[0]->recover_estimated)) ? $franchise[0]->recover_estimated : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Dimensión mínima del local</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->premises_size) && !empty($franchise[0]->premises_size)) ? $franchise[0]->premises_size : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Empleados por local</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->employees) && !empty($franchise[0]->employees)) ? $franchise[0]->employees : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Vigencia del contrato</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->contract_term) && !empty($franchise[0]->contract_term)) ? $franchise[0]->contract_term : '-' }}</p>
                                    </div>
                                </div>

                                <div class="data__table__row">
                                    <div class="data__table__column">
                                        <h2 class="data__title">Franquicia exportable</h2>
                                    </div>
                                    <div class="data__table__column">
                                        <p class="data__text">{{ (isset($franchise[0]->exportable_franchise) && !empty($franchise[0]->exportable_franchise)) ? $franchise[0]->exportable_franchise : '-' }}</p>
                                    </div>
                                </div>

                            </div>

                            <a href="#" class="data__btn{{ (empty($loggedUser)) ? ' js-open-user-login' : ' js-open-meeting' }}"><span>Solicitar reunión</span><i></i></a>
                        </div>

                    </section>
                </div>
            </div>


            <section class="franchise-item__offices">
                <div class="center-wrapper">
                    <h1 class="franchise-item__title franchise-item__title--1">Sucursales</h1>
                    <button class="offices__btn js-open-available-areas">Ver zonas disponibles</button>
                </div>
                <div class="offices__map">

                </div>
            </section>

            <section class="franchise-item__reasons">
                <div class="center-wrapper">
                    <h1 class="franchise-item__title franchise-item__title--2">5 razones para elegir nuestra franquicia</h1>
                    <ul class="reasons__list">
                        @if(isset($franchise[0]->first_reasons) && !empty($franchise[0]->first_reasons))
                            <li class="reasons__item">
                                <p class="reasons__item__text">{{ $franchise[0]->first_reasons }}</p>
                                <span class="reasons__item__number">.01</span>
                            </li>
                        @endif

                        @if(isset($franchise[0]->second_reasons) && !empty($franchise[0]->second_reasons))
                            <li class="reasons__item">
                                <p class="reasons__item__text">{{ $franchise[0]->second_reasons }}</p>
                                <span class="reasons__item__number">.02</span>
                            </li>
                        @endif

                        @if(isset($franchise[0]->third_reasons) && !empty($franchise[0]->third_reasons))
                            <li class="reasons__item">
                                <p class="reasons__item__text">{{ $franchise[0]->third_reasons }}</p>
                                <span class="reasons__item__number">.03</span>
                            </li>
                        @endif

                        @if(isset($franchise[0]->fourth_reasons) && !empty($franchise[0]->fourth_reasons))
                            <li class="reasons__item">
                                <p class="reasons__item__text">{{ $franchise[0]->fourth_reasons }}</p>
                                <span class="reasons__item__number">.04</span>
                            </li>
                        @endif

                        @if(isset($franchise[0]->fifth_reasons) && !empty($franchise[0]->fifth_reasons))
                            <li class="reasons__item">
                                <p class="reasons__item__text">{{ $franchise[0]->fifth_reasons }}</p>
                                <span class="reasons__item__number">.05</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </section>



            @if(count($suggested) > 0)
                <section class="franchise-item__suggested">
                    <div class="center-wrapper">
                        <h1 class="franchise-item__title franchise-item__title--2">Franquicias sugeridas</h1>
                        <div class="suggested__wrapper">
                            @foreach($suggested as $suggest)
                                <a class="suggested__item" href="{{ Config::get('app.url') }}franquicia/{{ $suggest[0]->slug }}">
                                    <i class="suggested__img" style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $suggest[0]['image'] }}')"></i>
                                    <div class="suggested__info">
                                        <h2 class="suggested__title">{{ $suggest[0]->name }}</h2>
                                        <button class="suggested__btn">ver más</button>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

        </div>

        <div class="component__available-areas component__modal">
            <div class="center-wrapper">
                <div class="modal__scroll">
                    <div class="modal__center">

                        <div class="modal__back || js-close-modal"></div>

                        <div class="modal__wrapper">

                            <div class="icon__close || js-close-modal">
                                <svg width="100%" height="100%" viewBox="0 0 50 50">
                                    <use xlink:href="#svg-symbol__close"></use>
                                </svg>
                            </div>

                            <h2 class="modal__title">Zonas Disponibles</h2>

                            <ul class="available-areas__list">
                                @foreach($franchisesAreas as $farea)
                                    <li class="available-areas__item">{{ $farea->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('frontend.includes.component_contact')

        @include('frontend.includes.component_meeting')

    </section>
@endsection

@section('scripts')
    <script>
        var  offices = [

            @foreach($franchiseOffices as $key => $office)
                {
                    title: '{{ $office->name }}',
                    content: '<strong>{{ $office->name }}</strong></br>{{ $office->full_direction }}',
                    lat: {{ $office->lat }},
                    lng: {{ $office->lng }},
                    zIndex: {{ $key+1 }}
                },
            @endforeach
        ];
    </script>
@endsection

@extends('layouts.layout')
@section('content')


    <div class="section__search || results">

        <section class="results__top">

            <div class="center-wrapper">
                <div class="results__top__info">
                    @if(!empty($selectedThematic))
                        <p class="top__info__text">Resultados de la busqueda</p>
                        <h1 class="top__info__title">{{ $selectedThematic->name }}</h1>
                    @endif

                    <a href="#" class="results__order || custom-select">
                        <p class="custom-select__text">
                            Ordenar por
                        </p>
                        <span>
                            <i></i>
                        </span>

                        <select class="custom-select__select" name="order">
                            <option value="" disabled>Ordenar por:</option>
                            <option class="js-select" data-url="{{ $frontUrl }}" value="mayor-precio">Mayor inversión</option>
                            <option class="js-select" data-url="{{ $frontUrl }}" value="menor-precio">Menor inversión</option>
                            <option class="js-select" data-url="{{ $frontUrl }}" value="alfabeticamente">Alfabeticamente</option>
                        </select>

                    </a>
                </div>
            </div>
        </section>

        <section class="results__wrapper">
            <div class="center-wrapper">

                <article class="results__list">
                    @if($franchises->count() > 0)
                        @foreach($franchises as $franchise)
                            <section class="results__item">
                                <div class="item__wrapper">

                                    <div class="item__top">
                                        <i class="item__top__image" style="background-image:url('{{ Config::get('app.url') }}public/uploads/{{ $franchise->image }}')"></i>

                                        <div class="item__top__wrapper">
                                            <a class="item__top__link" href="{{ Config::get('app.url') }}franquicia/{{ $franchise->slug }}">Ver más</a>
                                            @include('frontend.includes.component_button-list', ['franchise' => $franchise, 'favorites' => $favorites])
                                        </div>

                                        @if(isset($franchise->total_investment) && !empty($franchise->total_investment))
                                            <div class="results__price">
                                                <i class="price__icon"></i>
                                                <span>{{ $franchise->total_investment .'.-' }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="item__bottom">
                                        <div class="item__bottom__wrapper">
                                            <h1 class="item__title">{{ str_limit($franchise->name , '24') }}</h1>
                                            <div class="item__select{{ (empty($loggedUser)) ? ' js-open-user-login' : '' }}{{ (in_array( $franchise->slug,$slugSession)) ? ' js-selected-franchise' : '' }}" data-title="{{ $franchise->name }}" data-slug="{{ $franchise->slug }}">
                                                <p class="item__select__text"><i class="item__select__icon"></i> AGREGAR CONSULTA</p>
                                            </div>
                                        </div>
                                        <i class="item__bottom__img" style="background-image:url('{{ Config::get('app.url') }}public/uploads/{{ $franchise->logo }}')"></i>
                                    </div>

                                </div>
                            </section>
                        @endforeach
                    @else
                        <p>No se encontraron resultados</p>
                    @endif
                </article>

                @include('frontend.includes.component_pagination', ['paginator' => $franchises])

                <figure class="results__banner banner__responsive">
                    @unless(empty($frontBanners['banner_bottom_thematics']))
                        <a href="{{ $frontBanners['banner_bottom_thematics_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_thematics'] }}"/></a>
                    @endunless
                    @unless(empty($frontBanners['banner_bottom_thematics_mobile']))
                        <a href="{{ $frontBanners['banner_bottom_thematics_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_thematics_mobile'] }}"/></a>
                    @endunless
                </figure>

            </div>
            @include('frontend.includes.component_send-contact')
            @include('frontend.includes.component_contact')
        </section>

    </div>

@endsection

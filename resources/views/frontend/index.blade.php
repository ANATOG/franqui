
@extends('layouts.layout')
@section('content')
    <div class="section__home">
        <!--BANNER TOP-->
        <section class="home__banner-top">
            @unless(empty($frontBanners['banner_top_home']))
                @foreach($frontBanners['banner_top_home'] as $key => $fbannert)
                    <!--BANNER ITEM-->
                    <article class="banner-top__item">
                        <!--BANNER ITEM IMAGE-->
                        @if(isset($frontBanners['banner_top_home_url'][$key]))
                            <div>
                                <i class="banner-top__image banner-top--desktop" style="background-image: url('{{ Config::get('app.url') }}public/uploads/{{ $fbannert }}')"></i>
                                @if(isset($frontBanners['banner_top_home_mobile'][$key]))
                                    <i class="banner-top__image banner-top--mobile" style="background-image: url('{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_top_home_mobile'][$key] }}')"></i>
                                @endif
                            </div>
                        @else
                            <i class="banner-top__image banner-top--desktop" style="background-image: url('{{ Config::get('app.url') }}public/uploads/{{ $fbannert }}')"></i>
                            @if(isset($frontBanners['banner_top_home_mobile'][$key]))
                                <i class="banner-top__image banner-top--mobile" style="background-image: url('{{ Config::get('app.url') }}public/uploads/{{ $fbannert }}')"></i>
                            @endif
                        @endif
                        <div class="banner-top-title__wrapper">
                          <div class="banner-top-title__content">
                            <h1>¡Bienvenidos a Franquiciar!</h1>
                            <span>¿Tenés interés en adquirir una franquicia? </br> Llegaste al lugar indicado, contactános y te ayudamos.</span>
                            <a href="javascript.void(0)" class="banner-top-title__button js-open-contact-info" data-text="Contacto">CONTACTÁNOS</a>
                          </div>
                        </div>
                    </article>
                @endforeach
            @endunless
        </section>


        <!--HOME WRAPPER-->
        <div class="home__wrapper">
          <div class="home__main__search">
            <div class="home__main__search__inner row">
              <!-- HOME CATEGORIES -->
              @include('frontend.includes.component_subjects')
              <!-- HOME SEARCH-->
              <section class="home__search col-md-8">
                <h2 class="home__search__title">encontrá tu </br><strong>franquicia</strong> ideal</h2>
                  <form class="search__form" method="get" action="{{ Config::get('app.url') }}resultados">

                      <div class="search__form__top">
                          <input class="form__input" name="buscar" type="search" placeholder="Buscador de Franquicia">
                      </div>

                      <div class="search__form__bottom">
                          <div class="search__select">
                              <a href="#" class="custom-select || select__thematics">
                                  <p class="custom-select__text">
                                      Selecciona un rubro
                                  </p>
                                  <span>
                                      <i></i>
                                  </span>

                                  <select class="custom-select__select" name="rubro">
                                      <option value="" disabled>Selecciona un rubro</option>
                                      <option class="js-select" value="">Todos los Rubros</option>
                                      @foreach($subjectsList as $key => $value)
                                          <option class="js-select" value="{{ $key }}">{{ $value }}</option>
                                      @endforeach
                                  </select>

                              </a>
                          </div>

                          <div class="search__select">

                              <a href="#" class="select__investments || custom-select">
                                  <p class="custom-select__text">
                                      Selecciona una inversión
                                  </p>
                                  <span>
                                      <i></i>
                                  </span>

                                  <select class="custom-select__select" name="precio">
                                      <option value="" disabled>Selecciona una inversión</option>
                                      <option class="js-select" value="">Todas las inversiones</option>
                                      <option class="js-select" value="0-250000">$0 - $250.000</option>
                                      <option class="js-select" value="251000-500000">$251.000 - $500.000</option>
                                      <option class="js-select" value="501000-1000000">$501.000 - $1.000.000</option>
                                      <option class="js-select" value="1000000-99999999999">Más de $1.000.000</option>
                                  </select>

                              </a>
                          </div>

                          <button class="search__btn" type="submit">Buscar</button>
                      </div>

                  </form>

              </section>
            </div>
          </div>
          @include('frontend.includes.latest_news')
            <div class="center-wrapper">
                <!--HOME BIG LIST-->
                <div class="home__list">
                    <!--SMALL NEWS-->
                    <div class="list__row">

                        <!--SURVEY-->
                        <section class="list__item list__item--small || list__item--survey">

                            <form class="survey__form" data-voted="{{ (isset($alreadyVote))?'voted':'' }}" name="form_survey" method="post" action="{{ Config::get('app.url') }}vote">
                                {{ Form::hidden('_token', csrf_token()) }}
                                <h2 class="list__item__title">
                                    Encuesta
                                    <i class="spinner">
                                        <div class="spinner__wrapper"></div>
                                    </i>
                                </h2>
                                <p class="list__item__text">{{ $survey[0]->question }}</p>


                                @foreach($results as $result)
                                    <div class="survey__wrapper">
                                        <label class="survey__info">
                                            <div class="survey__input">
                                                <input class="survey__radio" {{ (isset($alreadyVote) && $alreadyVote == $result['id'])?'checked="checked"':'' }} type="radio" id="survey--{{ $result['id'] }}" name="vote" value="{{ $result['id'] }}">
                                                <span class="survey__circle"></span>
                                            </div>
                                            <h2 class="survey__title">{{ $result['answer'] }}</h2>
                                        </label>
                                        <div class="survey__result">
                                            <div class="survey__line">
                                                <span></span>
                                                <span style="width:{{ $result['percentage'] }}%" class="survey__line__back"></span>
                                            </div>
                                            <span class="survey__number survey__number--visible">{{ $result['percentage'] }}%</span>
                                            <span class="survey__number survey__number--hidden"></span>
                                        </div>
                                    </div>
                                @endforeach

                            </form>

                            <!--NEWSLETTER-->
                            <form class="list__item--newsletter || newsletter__form" method="post" action="{{ Config::get('app.url') }}addNewsletter">
                                {{ Form::hidden('_token', csrf_token()) }}

                                <h2 class="list__item__title">
                                    Newsletter

                                    <i class="spinner">
                                        <div class="spinner__wrapper"></div>
                                    </i>
                                </h2>
                                <input class="newsletter__input" name="email" placeholder="Ingresá tu e-mail" type="email">
                                <button class="newsletter__btn">Enviar</button>
                            </form>
                        </section>
                    </div>
            </div>
        </div>
        <!-- Mi negocio es franquiciable-->
        <div class="section__franchising_business">
          @include('frontend.includes.component_banner_mi_negocio_franquiciable')
        </div>
        <!-- Tu Asesor-->
        <div class="section__asesor">
          @include('frontend.includes.component_banner_asesor')
        </div>
        <!--HOME SPONSORS-->
        <div class="section__sponsors">
          <div class="container">
            @include('frontend.includes.component_sponsor')
          </div>
        </div>
    </div>


    @include('frontend.includes.component_video-modal')


@endsection

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
                            <a href="{{ $frontBanners['banner_top_home_url'][$key] }}" target="_blank">
                                <i class="banner-top__image banner-top--desktop" style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $fbannert }}')"></i>
                                @if(isset($frontBanners['banner_top_home_mobile'][$key]))
                                    <i class="banner-top__image banner-top--mobile" style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_top_home_mobile'][$key] }}')"></i>
                                @endif
                            </a>
                        @else
                            <i class="banner-top__image banner-top--desktop" style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $fbannert }}')"></i>
                            @if(isset($frontBanners['banner_top_home_mobile'][$key]))
                                <i class="banner-top__image banner-top--mobile" style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $fbannert }}')"></i>
                            @endif
                        @endif
                    </article>
                @endforeach
            @endunless
        </section>


        <!--HOME WRAPPER-->
        <div class="home__wrapper">
            <div class="center-wrapper">

                <!-- HOME SEARCH-->
                <section class="home__search">

                    <form class="search__form" method="get" action="{{ Config::get('app.url') }}resultados">

                        <div class="search__form__top">
                            <input class="form__input" name="buscar" type="search" placeholder="Buscador de Franquicias">
                            <i class="form__icon"></i>
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

                <!-- HOME CATEGORIES -->
                @include('frontend.includes.component_subjects')

                <!--HOME BIG LIST-->
                <div class="home__list">

                    <!-- FIRST ROW -->
                    <div class="list__row">

                        <!-- Franchise weekly-->
                        @unless(count($weeklies) < 1)
                            <section class="list__item list__item--big || list__item--weekly">

                                <div class="list__item__wrapper">

                                    <h1 class="list__item__title">#FRANQUICIASEMANAL</h1>


                                    <div class="weekly__slider">
                                        @foreach($weeklies as $weekly)
                                            <a href="{{ Config::get('app.url') }}franquicia/{{ $weekly['slug'] }}"
                                                    class="weekly__slider__item">
                                                <i class="list__item__img"
                                                    style="background-image:url('{{ Config::get('app.url') }}uploads/{{ $weekly['image'] }}')">
                                                </i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        @endunless

                        <!-- Franchise Thematic-->
                        @unless(!isset($franchise[0]))
                            <section class="list__item list__item--medium list__item--medium--left || list__item--blue">

                                @if(isset($thematic[0]))
                                    <a class="list__item__wrapper" href="{{ Config::get('app.url') }}tematica/{{ $thematic[0]->slug }}">
                                @else
                                    <a class="list__item__wrapper" href="{{ Config::get('app.url') }}franquicia/{{ $franchise[0]->slug }}">
                                @endif

                                    <div class="list__item__info">
                                        <div class="list__item__info__wrapper">
                                            <span class="list__item__number">02</span>
                                            <small class="list__item__small-title">#FRANQUICIASTEMÁTICAS</small>
                                        </div>
                                        @if(isset($thematic[0]))
                                            <h1 class="list__item__title">{{ str_limit($thematic[0]->name, '60') }}</h1>
                                        @else
                                            <h1 class="list__item__title">{{ str_limit($franchise[0]->name, '60') }}</h1>
                                        @endif
                                        <button class="list__item__btn">
                                            ver detalle
                                             <i class="list__item__arrow">
                                                <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">
                                                    <use xlink:href="#svg-symbol__arrow-1"></use>
                                                </svg>
                                                <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">
                                                    <use xlink:href="#svg-symbol__arrow-1"></use>
                                                </svg>
                                            </i>
                                        </button>
                                    </div>

                                    @unless(empty($franchiseImage['right_one']))
                                        <i class="list__item__img"
                                            style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $franchiseImage['right_one'] }}')">

                                            {{--<span class="button-play">--}}
                                                {{--<svg width="100%" height="100%" viewBox="0 0 50 50">--}}
                                                    {{--<use xlink:href="#svg-symbol__play"></use>--}}
                                                {{--</svg>--}}
                                            {{--</span>--}}

                                        </i>
                                    @endunless
                                </a>
                            </section>
                        @endunless

                    </div>


                    <!-- SECOND ROW -->
                    <div class="list__row">
                        @for ($i = 0; $i < 2; $i++)
                            <section class="list__item list__item--medium list__item--medium--right || list__item--white">
                                <a  class="list__item__wrapper"
                                    href="{{ Config::get('app.url') }}actualidad/{{ $news[$i]->slug }}">

                                    <div class="list__item__info">

                                        <small class="list__item__small-title">Noticias</small>
                                        <h1 class="list__item__title">{{ str_limit($news[$i]->title, '80') }}</h1>
                                        <button class="list__item__btn">
                                            ver detalle
                                            <i class="list__item__arrow">
                                                <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">
                                                    <use xlink:href="#svg-symbol__arrow-1"></use>
                                                </svg>
                                                 <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">
                                                    <use xlink:href="#svg-symbol__arrow-1"></use>
                                                </svg>
                                            </i>
                                        </button>
                                    </div>

                                    <i class="list__item__img"
                                        style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $news[$i]->image }}')">
                                        @unless(empty($news[$i]->video))
                                            <span class="button-play">
                                                <svg width="100%" height="100%" viewBox="0 0 50 50">
                                                    <use xlink:href="#svg-symbol__play"></use>
                                                </svg>
                                            </span>
                                        @endunless
                                    </i>

                                </a>
                            </section>
                        @endfor
                    </div>

                    <!--THIRD ROW-->
                    <div class="list__row">

                        <!--SMALL NEWS-->
                        @for ($i = 2; $i < 4; $i++)
                            <section class="list__item list__item--small @if($i===2){{ 'list__item--white' }}@elseif($i===3){{ 'list__item--blue' }}@endif">
                                <a  class="list__item__wrapper"
                                    href="{{ Config::get('app.url') }}actualidad/{{ $news[$i]->slug }}">

                                    <div class="list__item__info">
                                        <h1 class="list__item__title">{{ str_limit($news[$i]->title, '80') }}</h1>
                                        <p class="list__item__text">{{ str_limit(strip_tags($news[$i]->description), '50') }}</p>
                                        <button class="list__item__btn">ver más</button>
                                    </div>

                                    <i class="list__item__img"
                                        style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $news[$i]->image }}')">
                                        @unless(empty($news[$i]->video))
                                            <span class="button-play">
                                                <svg width="100%" height="100%" viewBox="0 0 50 50">
                                                    <use xlink:href="#svg-symbol__play"></use>
                                                </svg>
                                            </span>
                                        @endunless
                                    </i>

                                </a>
                            </section>
                        @endfor

                        <!--EVENTS-->
                        <section class="list__item list__item--small || list__item--event">

                        </section>


                        <section class="list__item list__item--small || list__item--survey">
                            <!--SURVEY-->
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

                    <!--FOURTH ROW-->
                    <div class="list__row">
                        <section  class="list__item list__item--medium || list__item--banner-mid">
                            @unless(empty($frontBanners['banner_middle_home']))
                                <a href="{{ $frontBanners['banner_middle_home_url'] }}" target="_blank"><i class="list__item__img"
                                style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_middle_home'] }}')"></i></a>
                            @endunless
                        </section>

                        <div  class="list__item list__item--medium || list__item--last-news">
                            <section class="home__adviser">
                                <i class="adviser__img"></i>
                                <div class="adviser__wrapper">
                                    <h1 class="adviser__title">Solicitá tu asesor</h1>
                                    <p class="adviser__text">Te ayudamos a concretar tu franquicia</p>
                                </div>
                                <a class="adviser__btn" href="{{ Config::get('app.url') }}tu-asesor">Solicitar</a>
                            </section>

                            <div class="last-news__wrapper component__last-news">

                                @for ($i = 4; $i < 7; $i++)
                                    <section class="last-news__item">
                                        <a class="last-new__item__wrapper" href="{{ Config::get('app.url') }}actualidad/{{ $news[$i]->slug }}">
                                            <i class="last-news__img"
                                                style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $news[$i]->image }}')"></i>

                                            <div class="last-news__info">
                                                <h1 class="last-news__title">{{ str_limit($news[$i]->title , '60') }}</h1>
                                                <p class="last-news__text">{{ str_limit(strip_tags($news[$i]->description), '80') }}</p>
                                                <button class="last-news__btn" >
                                                    <span>ver más</span>
                                                    <i class="last-news__arrow">
                                                        <span>
                                                            <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">
                                                                <use xlink:href="#svg-symbol__arrow-1"></use>
                                                            </svg>
                                                            <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">
                                                                <use xlink:href="#svg-symbol__arrow-1"></use>
                                                            </svg>
                                                        </span>
                                                    </i>
                                                </button>
                                            </div>
                                        </a>

                                    </section>
                                @endfor

                            </div>
                        </div>
                    </div>

                </div>

                <!--HOME SPONSORS-->
                @include('frontend.includes.component_sponsor')

                <!-- HOME BANNER BOTTOM -->
                <figure class="home__banner-bottom banner__responsive">
                    @unless(empty($frontBanners['banner_bottom_home']))
                        <a href="{{ $frontBanners['banner_bottom_home_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_home'] }}"></a>
                    @endunless
                    @unless(empty($frontBanners['banner_bottom_home_mobile']))
                        <a href="{{ $frontBanners['banner_bottom_home_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_home_mobile'] }}"></a>
                    @endunless
                </figure>

                <!--HOME NEW BOTTOM-->
                <div class="home__news-bottom">

                    @foreach($videos as $video)
                        <section class="news-bottom__item">
                            <button class="news-bottom__btn || js-open-video" data-video-id="{{ $video->video }}" data-video-title="{{ $video->title }}">
                                <div class="news-bottom__img">
                                    <div></div>
                                    <i style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $video->image }}')"></i>
                                    <span class="button-play">
                                        <svg width="100%" height="100%" viewBox="0 0 50 50">
                                            <use xlink:href="#svg-symbol__play"></use>
                                        </svg>
                                    </span>
                                </div>

                                <div class="news-bottom__info">
                                    <h1 class="news-bottom__title">{{ $video->title }}</h1>
                                    <p class="news-bottom__text">{{ $video->description }}</p>
                                </div>
                            </button>

                        </section>
                    @endforeach

                </div>

            </div>
        </div>

    </div>


    @include('frontend.includes.component_video-modal')


@endsection

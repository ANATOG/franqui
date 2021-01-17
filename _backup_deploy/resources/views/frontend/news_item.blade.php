@extends('layouts.layout')



@section('metadata')

    <title>Franquiciar - {{ $news[0]->title }}</title>

    <meta name="description" content="{{ str_limit($news[0]->description, $limit = 150, $end = '...') }}"/>



    <meta property="og:url"                content="{{ Config::get('app.url') }}actualidad/{{ $news[0]->slug }}" />

    <meta property="og:title"              content="{{ $news[0]->title }}" />

    <meta property="og:description"        content="{{ str_limit($news[0]->description, $limit = 150, $end = '...') }}" />

    <meta property="og:image"              content="{{ Config::get('app.url') }}uploads/{{ $news[0]->image }}" />



    <meta name="twitter:card" content="summary" />

    <meta name="twitter:site" content="@franquiciar" />

    <meta name="twitter:title" content="Franquiciar - {{ $news[0]->title }}" />

    <meta name="twitter:description" content="{{ str_limit($news[0]->description, $limit = 150, $end = '...') }}" />

    <meta name="twitter:image" content="{{ Config::get('app.url') }}uploads/{{ $news[0]->image }}" />

@endsection





@section('content')





    <div class="section__news-item">

        

        <div class="center-wrapper">

            

            <div class="news__wrapper">

                

                <section class="news__wrapper__left">

                    

                    @if($news->count() <= 0)

                        <p class="news__not-found">No existe esa noticia</p>

                    @else

                        <small class="news-item__title-small">Actualidad</small>

                        <h1 class="news-item__title">{{ $news[0]->title }}</h1>

                        <p class="news-item__date">

                            {!! ucwords(utf8_encode(strftime("%d . %B . %Y", strtotime($news[0]->updated_at)))) !!} 

                             

                            <button class="icon__share || js-open-share"

                                    data-url="{{ Config::get('app.url') }}actualidad/{{ $news[0]->slug }}"

                                    data-title="{{ $news[0]->title }}"

                                    data-text="{{ $news[0]->description }}"

                                    data-via="fraquiciar">

                                <svg width="100%" height="100%" viewBox="0 0 100 100">

                                    <use xlink:href="#svg-symbol__share-2"></use>

                                </svg>

                            </button>



                        </p>

                        

                        <figure class="news-item__img">

                            <img src="{{ Config::get('app.url') }}uploads/{{ $news[0]->image }}"/>

                        </figure>



                        <aside class="news-item__tags">

                            <div class="tags__wrapper">

                                <p class="tags__title">Tags:</p>

                                <ul class="tags__list">

                                    @foreach($news[0]->getTagsNames() as $tag)

                                        <li class="tags__item"><a href="{{ Config::get('app.url') }}actualidad/tag/{{ $tag }}">{{ strtoupper($tag) }}</a></li>

                                    @endforeach

                                </ul>

                            </div>

                            <small class="tags__author">{{ $news[0]->author }}</small>



                        </aside>



                        <div class="news-item__text">{!!  $news[0]->description !!}</div>



                        @if(isset($news[0]->video) && !empty($news[0]->video))

                            <div class="news-item__video">

                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{$news[0]->video}}" frameborder="0" allowfullscreen></iframe>

                            </div>

                        @endif



                    @endif



                </section>



                <div class="news__wrapper__right component__last-news">



                    @if($moreNews->count() > 0)

                        <h2 class="wrapper__right__title">Otras Publicaciones</h2>

                        @foreach($moreNews as $mNew)



                            <section class="last-news__item">

                                <a class="last-new__item__wrapper" href="{{ Config::get('app.url') }}actualidad/{{ $mNew->slug }}">

                                    <i class="last-news__img"

                                        style="background-image: url('{{ Config::get('app.url') }}uploads/{{ $mNew->image }}')"></i>

                                    

                                    <div class="last-news__info">



                                        <h1 class="last-news__title">{{ $mNew->title }}</h1>

                                        <p class="last-news__text">{{ str_limit(strip_tags($mNew->description), '50') }}</p>



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

                        @endforeach

                    @endif

                    

                </div>



            </div>



            <figure class="bottom__banner banner__responsive">

                @unless(empty($frontBanners['banner_bottom_news']))

                    <a href="{{ $frontBanners['banner_bottom_news_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_news'] }}"></a>

                @endunless

                @unless(empty($frontBanners['banner_bottom_news_mobile']))

                    <a href="{{ $frontBanners['banner_bottom_news_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_news_mobile'] }}"></a>

                @endunless

            </figure>

        </div>

        

    </div>





@endsection
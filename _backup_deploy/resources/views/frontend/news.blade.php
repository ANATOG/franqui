@extends('layouts.layout')
@section('content')

    <div class="section__news">
        
        <div class="news__top">
            <div class="center-wrapper">
                <h1 class="news__top__title">Actualidad</h1>
                <p class="news__top__text">Enterate de todas las novedades sobre franquicias.</p>
                {{-- <p class="news__top__text"><a href="{{ Config::get('app.url') }}actualidad">Todas</a> | <a href="{{ Config::get('app.url') }}actualidad/tipo/noticia">Noticias</a> | <a href="{{ Config::get('app.url') }}actualidad/tipo/entrevista">Entrevistas</a> | <a href="{{ Config::get('app.url') }}actualidad/tipo/video">Videos</a></p> --}}
            </div>
        </div>

        <div class="news__wrapper">
            <div class="center-wrapper">
                @if($news->count() <= 0)
                    <div>
                        <p>No hay noticias</p>
                    </div>
                @else
                    @foreach($news as $n)
                        <section class="news__item">
                            <a href="{{ Config::get('app.url') }}actualidad/{{ $n->slug }}">
                                <div class="news__img">
                                    <i style="background-image:url('{{ Config::get('app.url') }}uploads/{{ $n->image }}')"></i>
                                </div>
                                <div class="news__info">
                                    <h1 class="news__title">{{ str_limit($n->title, '75') }}</h1>
                                    {{-- <p class="news__text">{{ str_limit(strip_tags($n->description), '80') }}</p> --}}
                                    <button class="news__btn" style="margin-top: 30px;">Ver más</button>
                                </div>
                            </a>
                        </section>
                    @endforeach
                @endif
            </div>
        </div>
        
        <div class="news__bottom">
            <div class="center-wrapper">
                @include('frontend.includes.component_pagination', ['paginator' => $news])
            
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

    </div>


    
    
@endsection
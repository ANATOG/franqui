
    <div class="section__news section__news__home">

        <div class="news__top">
            <div class="center-wrapper">
                <p class="news__top__text">CONOCÉ MÁS SOBRE <strong>EL MUNDO</strong></p>
                <p class="news__top__text">DE LAS <strong>FRANQUICIAS</strong></p>
            </div>
        </div>

        <div class="news__wrapper">
            <div class="center-wrapper row">
                @if($lastnews->count() <= 0)
                    <div>
                        <p>No hay noticias</p>
                    </div>
                @else
                    @foreach($lastnews as $n)
                        <section class="news__item__home col-xs-12 col-md-4">
                            <a href="{{ Config::get('app.url') }}actualidad/{{ $n->slug }}">
                                <div class="news__img">
                                    <i style="background-image:url('{{ Config::get('app.url') }}public/uploads/{{ $n->image }}')"></i>
                                </div>
                                <div class="news__info">
                                    <h1 class="news__title">{{ str_limit($n->title, '75') }}</h1>

                                </div>
                            </a>
                        </section>
                    @endforeach
                @endif
            </div>
        </div>

    </div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <figure class="banner__responsive">
                @unless(empty($frontBanners['banner_bottom_news_franchising']))
                    <img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_news_franchising'] }}">
                @endunless
                @unless(empty($frontBanners['banner_bottom_news_franchising_mobile']))
                <img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_news_franchising_mobile'] }}">
                @endunless
            </figure>
        </div>
                <div class="col-md-6">
                    <h2 class="text-dark">¿CÓMO SABER SI MI <strong>NEGOCIO</strong> ES <strong>FRANQUICIABLE?</strong></h2>
                    <ol>
                        <li>• DEBE SER UN NEGOCIO PROBADO</li>
                        <li>• DEBE SER UN NEGOCIO RENTABLE</li>
                        <li>• SE DEBE DE PODER REPLICAR</li>
                        <li>• QUE EXISTA UNA DEMANDA COMPROBADA EN EL
                            MERCADO POR LOS PRODUCTOS O SERVICIOS
                            QUE OFRECE.</li>
                        <li>• QUE TENGA ALGÚN ELEMENTO DIFERENCIADOR
                                O ALGUNA VENTAJA COMPETITIVA IMPORTANTE.</li>
                    </ol>
                    <a href="javascript.void(0)" class="btn js-open-contact-info" data-text="Contacto"><span>Contactános</span></a>

                </div>
    </div>
</div>

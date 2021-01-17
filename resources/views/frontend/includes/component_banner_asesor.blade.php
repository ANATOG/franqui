<div class="container">
    <div class="row">

                <div class="col-md-5 description">
                  <div class="description--inner">
                    <h2 class="text-dark">¿NECESITÁS UN ASESOR?</h2>
                    <p>Un asesor te ahorra molestias y, lo más
                        importante, tiempo y dinero.
                        Un asesor sabe que hay múltiples opciones de franquicias y te ofrecerá sólo las
                        que se ajusten a tu presupuesto y perfil.
                        </p>

                    <a href="{{ Config::get('app.url') }}tu-asesor" class="btn btn-default" data-text="Tu asesor"><span>Contactános</span></a>
                  </div>
                </div>
                <div class="banner__responsive col-md-7">
                    <figure>
                      @unless(empty($frontBanners['banner_bottom_asesor1']))
                          <img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_asesor1'] }}">
                      @endunless
                      @unless(empty($frontBanners['banner_bottom_asesor_mobile1']))
                      <img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_asesor_mobile1'] }}">
                      @endunless
                    </figure>
                </div>
    </div>
</div>

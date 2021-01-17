<div class="component__contact component__modal">
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

                    <h2 class="modal__title">Contactar Franquicia</h2>
 
                    @if(Session::has('slugs2'))
                        <p>Tienes <span class="total-contact">{{ (Session::has('slugs')) ? count(Session::has('slugs')) : '0' }}</span> franquicia/s seleccionada/s</p>
                        <ul>
                            @foreach($slugSession as $slug)
                                <li>{{ $slug }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form class="modal__form" data-url="addContact" name="meeting" method="post" action="{{ Config::get('app.url') }}addContact">
                        
                        {{ Form::hidden('_token', csrf_token()) }}

                        <input type="hidden" class="slug-franchise" name="slug_franchise" value="{{ (isset($franchise[0])) ? $franchise[0]->slug : implode(",", $slugSession) }}">

                        <div class="form__label form__label__required form__phone" data-label="phone">
                            <input class="form__input" placeholder="Teléfono" name="phone">
                            <p class="form__error"></p>
                        </div> 

                        <div class="form__label form__label__required form__message" data-label="message_user">
                            <textarea class="form__textarea" name="message_user" placeholder="Mensaje"></textarea>     
                            <p class="form__error"></p>                       
                        </div>
                        
                        <p class="form__text-2">
                            Al enviar tu consulta, tu nombre y mail se remiten automáticamente a la franquicia para que puedan contactarte.
                        </p>

                        <p class="form__ok">Su mensaje fue enviado correctamente.</p>

                        <div class="form__button__wrapper">
                            <button class="form__button__text form__button--close || js-close-modal" type="button">Cancelar</button>

                            <button class="form__button form__button--send" type="submit">
                                Enviar
                                <i class="spinner">
                                    <div class="spinner__wrapper"></div>
                                </i>

                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

<div class="component__meeting component__modal">
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

                    <h2 class="modal__title">ME INTERESA TENER UNA REUNIÓN</h2>

                    <form class="modal__form" name="meeting" data-url="addMeeting" method="post" action="{{ Config::get('app.url') }}addMeeting">
                        
                        {{ Form::hidden('_token', csrf_token()) }}

                        <p>Quisiera solicitar una reunión para conocer más sobre el concepto de negocio de la franquicia <strong>{{ strtoupper($franchise[0]->name) }}</strong>.</p>

                        <p>Mis preferencias son:</p>

                        <div class="form__label form__radio form__label__required" data-label="type">
                            <div>
                                <div>
                                    <label class="form__options">
                                        <i class="form__radio__icon"></i>
                                        <input type="radio" name="type" value="facetoface">
                                        Reunión Presencial
                                    </label>

                                    <label class="form__options">
                                        <i class="form__radio__icon"></i>
                                        <input type="radio" name="type" value="skype">
                                        Reunión Vía Skype
                                    </label>
                                </div>                                
                            </div>

                            <p class="form__error"></p>
                        </div>

                        <div class="form__label form__label__required form__days" data-label="days">
                            <input class="form__input" placeholder="Días" name="days">
                            <p class="form__error"></p>
                        </div>

                        <div class="form__label form__label__required form__hour" data-label="hours">
                            <input class="form__input" placeholder="Rango Horario" name="hours">
                            <p class="form__error"></p>
                        </div>

                        <div class="form__label form__label__required form__phone" data-label="phone">
                            <input class="form__input" placeholder="Teléfono" name="phone">
                            <p class="form__error"></p>
                        </div> 
                        
                        <div class="form__skype form__label">
                            <input class="form__input" placeholder="Skype" name="skype">
                        </div>

                        <div class="form__label form__label__required form__message" data-label="message_user">
                            <textarea class="form__textarea" name="message_user" placeholder="Mensaje"></textarea>     
                            <p class="form__error"></p>                       
                        </div>

                        <p>Nota: al enviar este formulario tus datos de registro (nombre, mail y teléfono) serán remitidos automáticamente a la franquicia, para que puedan contactarte.</p>

                        <p class="form__ok">Tu mensaje fue enviado con éxito. Por favor revisá tu correo, recibirás un mail con la información de tu reunión solicitada.</p>


                        <input type="hidden" name="slug_franchise" value="{{ $franchise[0]->slug }}">
                        
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

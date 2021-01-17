<div class="component__user-login component__modal">
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

                    <h2 class="modal__title">Plataforma exclusiva Inversores</h2>

                    <form class="modal__form" name="meeting" data-url="login" method="post" action="{{ Config::get('app.url') }}login">

                        {{ Form::hidden('_token', csrf_token()) }}
                        
                        <div class="form__name form__label form__label__required">
                            <input class="form__input" placeholder="Email" name="email">
                        </div>
                        
                        <div class="form__password form__label form__label__required">
                            <input class="form__input" type="password" placeholder="Contraseña" name="password">                        
                        </div>

                        <p class="form__error"></p>
                        
                        <div class="form__button__wrapper">

                            <button class="form__button form__button--send" type="submit">
                                INGRESAR A MI PLATAFORMA EXCLUSIVA
                                <i class="spinner">
                                    <div class="spinner__wrapper"></div>
                                </i>

                            </button>                            
                        </div>

                    </form>

                    <button class="form__change-modal || js-switch-modal register-free" data-modal="component__user-register">Registrate gratis ahora</button>
                    <a href="{{ Config::get('app.url') }}olvide-contrasena" class="form__text form__forgot-password">¿Olvidaste tu contraseña?</a>               
                </div>
            </div>
        </div>
    </div>


</div>
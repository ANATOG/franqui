<div class="component__user-register component__modal">
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

                    <h2 class="modal__title">Registro exclusivo de inversores</h2>

                    <form class="modal__form" name="meeting" data-url="addUser" method="post" action="{{ Config::get('app.url') }}addUser">

                        {{ Form::hidden('_token', csrf_token()) }}
                        
                        <div class="form__name form__label form__label__required" data-label="first_name">
                            <input class="form__input" placeholder="Nombre y Apellido" name="first_name">
                            <p class="form__error"></p>
                        </div>

                        <div class="form__mail form__label form__label__required" data-label="phone">
                            <input class="form__input" placeholder="Teléfono" name="phone">
                            <p class="form__error"></p>  
                        </div>

                        <div class="form__mail form__label form__label__required" data-label="location">
                            <input class="form__input" placeholder="Ubicación/localidad para la franquicia" name="location">
                            <p class="form__error"></p>  
                        </div>

                        <div class="form__mail form__label form__label__required" data-label="email">
                            <input class="form__input" placeholder="Email" name="email">
                            <p class="form__error"></p>  
                        </div>
                        
                        <div class="form__password form__label form__label__required" data-label="password">
                            <input type="password" class="form__input" placeholder="Contraseña" name="password">  
                            <p class="form__error"></p>                        
                        </div>
                        
                        <p class="form__ok">¡Gracias por unirte a la Comunidad Franquiciar!</p>                        

                        <div class="form__button__wrapper">

                            <button class="form__button form__button--send" type="submit" style="padding-left: 70px; padding-right: 70px;">
                                Registrarse

                                <i class="spinner">
                                    <div class="spinner__wrapper"></div>
                                </i>
                            </button>                            
                        </div>

                    </form>

                    <p class="form__text">¿Ya tienes una cuenta? <button class="form__change-modal || js-switch-modal" data-modal="component__user-login">Ingresá</button></p>     
                    <a href="{{ Config::get('app.url') }}olvide-contrasena" class="form__text form__forgot-password">¿Olvidaste tu contraseña?</a>

                    <img class="benefits" src="{{ Config::get('app.url') }}public/image/beneficios1.jpg">
                    <img class="benefits" src="{{ Config::get('app.url') }}public/image/beneficios2.jpg">
                </div>
            </div>
        </div>
    </div>

</div>
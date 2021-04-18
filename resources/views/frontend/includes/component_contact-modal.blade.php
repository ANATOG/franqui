<div class="component__contact-info component__modal">
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
 
                    <h2 class="contact-info__title">¿Tenés alguna consulta?</h2>
                    <h3 class="contact-info__sub-title">Llamanos o escribinos!</h3>

                    <form class="modal__form" data-url="addRealContacto" action="{{ Config::get('app.url') }}addRealContacto">
                        
                        {{ Form::hidden('_token', csrf_token()) }}

                        <div class="contact-info__wrapper form__label__required" data-label="option">
							
							<h2>Marcá el motivo de tu consulta</h2>
							
							<div>
								<label class="form__label contact-info__radio">
									<div class="form__icon">
										<i></i>
										<input type="radio" name="option" value="1">
									</div>
									
									<p>Busco una franquicia</p>
								</label>

								<label class="form__label contact-info__radio">
									<div class="form__icon">
										<i></i>
										<input type="radio" name="option" value="2">
									</div>
									<p>Quiero anunciar mi marca en franquiciar</p>
								</label>

								<label class="form__label contact-info__radio">
									<div class="form__icon">
										<i></i>
										<input type="radio" name="option" value="3">
									</div>
									<p>Quiero franquiciar mi negocio</p>
								</label>

								<label class="form__label contact-info__radio">
									<div class="form__icon">
										<i></i>
										<input type="radio" name="option" value="4">
									</div>
									<p>Otras consultas</p>
								</label>								
							</div>

                            <p class="form__error"></p>
                        </div> 
						
						<div class="contact-info__wrapper-middle">
							
							<div class="wrapper-middle__left">
		                        <div class="form__label form__label__required" data-label="name">
									<input type="text" name="name" placeholder="Nombre y Apellido">
		                            <p class="form__error"></p>                       
		                        </div>

		                        <div class="form__label form__label__required" data-label="email">
									<input type="text" name="email" placeholder="E-mail">
		                            <p class="form__error"></p>                       
		                        </div>

		                        <div class="form__label form__label__required" data-label="phone">
									<input type="text" name="phone" placeholder="Teléfono">
		                            <p class="form__error"></p>                       
		                        </div>
	                        </div>
							<div class="wrapper-middle__right">
		                        <div class="form__label form__label__required" data-label="message_user">
									<textarea name="message_user" placeholder="Contanos en que podemos ayudarte"></textarea>
		                            <p class="form__error"></p>                       
		                        </div>								
							</div>
						</div>

                        <p class="form__ok">Su mensaje fue enviado correctamente.</p>

						<div class="contact-info__wrapper-bottom">
							<div class="bottom__left">
								<div class="bottom__left__wrapper">
									<i class="left__wrapper__icon whatsapp">
									</i>
									<span>+54 9 11 4780 3500</span>
								</div>
								<a class="bottom__left__wrapper" href="mailto:franquiciar@franquiciar.com.ar">
									<i class="left__wrapper__icon mail">
									</i>
									<span>franquiciar@franquiciar.com.ar</span>
								</a>
							</div>

							<div class="bottom__right">
								<div class="contact-info__captcha g-recaptcha" data-sitekey="6LecNq8aAAAAAMc0418UJ41yF6aAdXQy6CnzCDWd" id="recapchaWidget">
								</div>

	                            <button class="form__button form__button--send" type="submit">
	                                Enviar consulta ahora
	                                <i class="spinner">
	                                    <div class="spinner__wrapper"></div>
	                                </i>

	                            </button> 
							</div>

						</div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

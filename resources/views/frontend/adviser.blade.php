@extends('layouts.layout')
@section('content')
    
	<div class="section__adviser">
		
		<div class="adviser__top">
			<div class="center-wrapper">
				<div class="adviser__top__back">
					<h1>Tu asesor</h1>
					<p>Los Asesores en Franquicias son profesionales especializados en este campo, que podrán orientarte, aconsejarte y brindarte recomendaciones prácticas, para que puedas analizar las propuestas de franquicias existentes y elaborar tu plan de negocios.</p>
				</div>
			</div>
		</div>

		<form class="adviser__form" method="post" action="{{ Config::get('app.url') }}addAdviser">
			{{ Form::hidden('_token', csrf_token()) }}
			<div class="center-wrapper">
				<h2 class="adviser__title">Solicitá tu asesor</h2>
				<h3 class="adviser__sub-title">Marcá el tipo de asesoramiento que estás buscando y dejanos tu mensaje</h3>
				
				<div class="adviser__form__wrapper">
					<label class="adviser__form__item">
						<input type="radio" value="1" name="adviser">
						<i class="item__circle"></i>
						<div class="item__text">
							<p>Asesoramiento sin cargo en la búsqueda de franquicias</p>
						</div>
					</label>

					<label class="adviser__form__item">
						<input type="radio" value="2" name="adviser">
						<i class="item__circle"></i>
						<div class="item__text">
							<p>Presupuesto para desarrollar la franquicia de mi negocio</p>
						</div>
					</label>

					<label class="adviser__form__item">
						<input type="radio" value="3" name="adviser">
						<i class="item__circle"></i>
						<div class="item__text">
							<p>Asesoramiento legal en contratos, registro de marca, cuestiones laborales.</p>
						</div>
					</label>

					<label class="adviser__form__item">
						<input type="radio" value="4" name="adviser">
						<i class="item__circle"></i>
						<div class="item__text">
							<p>Otro tipo de asesoramiento</p>
						</div>
					</label>

				</div>

				<div class="adviser__form__bottom">
					<div class="form__textarea__wrapper">
						<textarea class="form__textarea" name="message_adviser" placeholder="Contanos en que podemos ayudarte..."></textarea>
					</div>

					<button class="form__btn || button-simple button-simple--blue-1{{ (empty($loggedUser)) ? ' js-open-user-login' : '' }}" type="button">
						Enviar
                        <!--<i class="spinner">
                            <div class="spinner__wrapper"></div>
                        </i>-->
					</button>
					<p class="ok_text">Mensaje eviado con éxito!</p>
				</div>
			</div>
		</form>

		<div class="adviser__member">
			<div class="center-wrapper">
				
				<figure class="member__img banner__responsive">
					@unless(empty($frontBanners['banner_middle_adviser']))
						<a href="{{ $frontBanners['banner_middle_adviser_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_middle_adviser'] }}"></a>
					@endunless
					@unless(empty($frontBanners['banner_middle_adviser_mobile']))
						<a href="{{ $frontBanners['banner_middle_adviser_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_middle_adviser_mobile'] }}"></a>
					@endunless
				</figure>
			</div>
		</div>

		
		<div class="adviser__advantage">
			<div class="center-wrapper">
				<h2 class="adviser__title">VENTAJAS DE RECURRIR A UN ASESOR</h2>
				<div class="advantage__info">
					<div class="advantage__info__item">	
						<i class="item__icon"></i>
						<h3 class="item__title">Valorar alternativas</h3>
						<p class="item__text">Un asesor sabe que hay múltiples opciones de franquicias y te ofrecerá sólo las que se ajusten a tu presupuesto y perfil. Se preocupará por conectarse con tus intereses y te ayudará a valorar las alternativas en función de ello.</p>
					</div>

					<div class="advantage__info__item">
						<i class="item__icon"></i>
						<h3 class="item__title">Ahorrar Tiempo</h3>
						<p class="item__text">El Asesor te ahorra molestias y, lo más importante, tiempo. A través de un Asesor podrás acceder rápidamente a las franquicias que concuerden con tu presupuesto y tus objetivos.</p>
					</div>

					<div class="advantage__info__item">
						<i class="item__icon"></i>
						<h3 class="item__title">Ahorrar Dinero</h3>
						<p class="item__text">Además de ahorrar tiempo, el Asesor te hará ahorrar dinero. Además de ofrecerte asesoramiento sin cargo, puede ayudarte a evitar que cometas un error grave escogiendo una franquicia basada sólo en el producto o servicio, ya que tendrá en cuenta otras variables relacionadas con tu perfil, tus intereses y tu presupuesto.</p>
					</div>	

					<div class="advantage__info__item">
						<i class="item__icon"></i>
						<h3 class="item__title">Ideal para nuevos emprendedores</h3>
						<p class="item__text">Un Asesor en Franquicias puede ser de especial ayuda para los que precisan orientación básica y desean ingresar en el mundo de las franquicias.</p>
					</div>				
				</div>

			</div>
		</div>

		<div class="adviser__consultants">
			<div class="center-wrapper">
				<h2 class="adviser__title">Consultoras</h2>
				<p class="consultants__text">Para los que buscan franquiciar su negocio, la importancia de la elección de un Consultor es fundamental. Con su experiencia te guiará por el camino correcto hacia el desarrollo de un modelo exitoso. El Consultor brindará las bases necesarias y las estrategias adecuadas a las características del proyecto y de las personas que lo lideran.</p>
				
				<ul class="consultants__list">
					@foreach($consultants as $consultant)
						<li class="consultants__item">
							<a href="{{ $consultant['url'] }}" target="_blank">
								<img class="consultants__img" src="{{ Config::get('app.url') }}public/uploads/{{ $consultant['image'] }}" alt="{{ $consultant['title'] }}">
							</a>
						</li>
					@endforeach
				</ul>

			</div>
		</div>
		
		<div class="adviser__banner">
			<div class="center-wrapper">
				<figure class="banner__responsive">
					@unless(empty($frontBanners['banner_bottom_adviser']))
						<a href="{{ $frontBanners['banner_bottom_adviser_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_adviser'] }}"></a>
					@endunless
					@unless(empty($frontBanners['banner_bottom_adviser_mobile']))
						<a href="{{ $frontBanners['banner_bottom_adviser_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_adviser_mobile'] }}"></a>
					@endunless
				</figure>
			</div>
		</div>


	</div>

@endsection
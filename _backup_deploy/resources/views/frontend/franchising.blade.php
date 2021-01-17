@extends('layouts.layout')
@section('content')


	<div class="section__franchising">

		<div class="franchising__top">
			<div class="center-wrapper">
				<h1>Invertir en <br> franquicias</h1>
			</div>
		</div>

		<div class="franchising__wrapper">
			<div class="center-wrapper">

				<div class="wrapper__left">
					<p class="franchising__text franchising__text--medium">El sistema de Franquicias está destinado tanto a emprendedores que proyectan gerenciar su propio negocio, bajo el paraguas de una marca más o menos reconocida, y contando con la experiencia del Franquiciante, como para empresarios que quieren expandir su concepto de negocio, a través de esta modalidad. Con su reciente regulación a través del nuevo Código Civil y Comercial de la Nación, el Franchising se convierte en el sistema de expansión de negocios más seguro. El Franquiciante, como titular de un sistema probado de comercialización de bienes o servicios, otorga al Franquiciado el derecho a utilizarlo bajo la marca de su titularidad, o sobre la cual tiene derechos de utilización y transmisión, en los términos del Contrato de Franquicia que firmarán a tal efecto. Asimismo, lo proveerá del conjunto de conocimientos técnicos y continua asistencia técnica o comercial, todo ello bajo contraprestaciones específicas a cargo del franquiciado (Canon o Fee de ingreso/Regalías o Royalty). Basado en el win and win donde todos ganan, el sistema protege tanto el capital que el emprendedor confía a la marca franquiciante, como el prestigio de ésta y el respeto a los procedimientos del sistema desarrollado por el Franquiciante.</p>

					<div class="thefranchise">
						@include('frontend.includes.component_franchising-thefranchise')
					</div>

					<h2 class="franchising__title franchising__title--medium">Ventajas del sistema de franquicias</h2>

					<div class="wrapper__left__info">
						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-1.png">
							<p class="franchising__text franchising__text--medium">El franquiciado puede disfrutar de los beneficios de tener su propio negocio, pero con el respaldo y la experiencia de una marca reconocida que posee éxito demostrado.</p>
						</div>

						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-2.png">
							<p class="franchising__text franchising__text--medium">Acota los plazos para el inicio de actividad, ya que no hay que destinar tiempo a desarrollar el proyecto.</p>
						</div>

						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-3.png">
							<p class="franchising__text franchising__text--medium">Favorece el aprovechamiento de las múltiples economías de escala en relación a temas como publicidad, compras, estrategias de marketing, etc.</p>
						</div>

						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-4.png">
							<p class="franchising__text franchising__text--medium">Minimiza los riesgos empresariales.</p>
						</div>

						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-5.png">
							<p class="franchising__text franchising__text--medium">Capacitación</p>
						</div>

						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-6.png">
							<p class="franchising__text franchising__text--medium">Asesoramiento y asistencia permanente del franquiciante.</p>
						</div>


						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-7.png">
							<p class="franchising__text franchising__text--medium">Manual de operaciones, que describe en detalle cómo deben llevarse a cabo las actividades, facilitando la gestión del negocio y la toma de decisiones.</p>
						</div>

						<div class="left__info__item">
							<img src="{{ Config::get('app.url') }}/image/franchising/img-8.png">
							<p class="franchising__text franchising__text--medium">Propicia mejores estrategias de marketing, comunicación y difusión de marca.</p>
						</div>
					</div>

					<div class="franchising__bottom">
							<h2 class="franchising__title franchising__title--big">Franquiciar mi negocio</h2>
							<p class="franchising__text franchising__text--medium">El primer paso para los que desean franquiciar su negocio, es considerar y evaluar ciertos aspectos, para determinar en principio si su concepto es franquiciable o no, entre ellos:</p>
							<ul class="franchising__list">
								<li class="franchisng__list__item franchising__text franchising__text--medium">&#9656 Que sea un negocio probado.</li>
								<li class="franchisng__list__item franchising__text franchising__text--medium">&#9656 Que sea un negocio rentable.</li>
								<li class="franchisng__list__item franchising__text franchising__text--medium">&#9656 Que se pueda replicar.</li>
								<li class="franchisng__list__item franchising__text franchising__text--medium">&#9656 Que exista una demanda comprobada en el mercado por los productos o servicios que ofrece.</li>
								<li class="franchisng__list__item franchising__text franchising__text--medium">&#9656 Que tenga algún elemento diferenciador o alguna ventaja competitiva importante.</li>
							</ul>

							<p class="franchising__text franchising__text--medium"><strong>Desarrollo de un proyecto de franquicia</strong></p>

							<p class="franchising__text franchising__text--medium">Franquiciar un negocio puede ser el proyecto de crecimiento y expansión más trascendental de una empresa. De ahí la importancia de realizarlo de manera profesional, basado en análisis, investigaciones y planificación. Contar con la asesoría de Consultoras especializadas puede resultar de gran utilidad.</p>

							<div class="steps_big">
								@include('frontend.includes.component_franchising-steps')
							</div>

						</div>
					</div>

					<div class="thefranchise">
						@include('frontend.includes.component_franchising-thefranchise2')
					</div>

				</div>

				<div class="wrapper__right">
					@include('frontend.includes.component_franchising-thefranchise')
					@include('frontend.includes.component_franchising-thefranchise2')
				</div>

				<div class="steps_small">
					 @include('frontend.includes.component_franchising-steps')
				</div>

			</div>

		</div>

		<!-- HOME BANNER BOTTOM -->

		<figure class="franchising__banner-bottom banner__responsive">
			 @unless(empty($frontBanners['banner_bottom_franchising']))
				  <a href="{{ $frontBanners['banner_bottom_franchising_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_franchising'] }}"></a>
			 @endunless
			 @unless(empty($frontBanners['banner_bottom_franchising_mobile']))
				  <a href="{{ $frontBanners['banner_bottom_franchising_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_franchising_mobile'] }}"></a>
			 @endunless
		</figure>


	</div>


@endsection

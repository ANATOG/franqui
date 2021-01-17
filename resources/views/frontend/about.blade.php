@extends('layouts.layout')
@section('content')
    

	<div class="section__about">
		
		<section class="about__top">
			<div class="center-wrapper">
				<h1 class="about__title">¿Qué es Franquiciar?</h1>
				<div class="about__video">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/S1YyFF3VnOk?ecver=2" frameborder="0" allowfullscreen></iframe>
				</div>

				<a class="about__top__button" href="http://franquiciar.com.ar/registra-tu-franquicia/" target="_blank">Registrá tu franquicia <span>&#9658;</span></a>
			</div>
		</section>


		<section class="about__wrapper">

			<div class="center-wrapper">
				<h2 class="about__sub-title">Aspectos legales</h2>
				
				<div class="about__info">
					
					<article class="about__info--left">
						<p class="info__text">Franquiciar.com.ar se compromete a adoptar una política de confidencialidad, con el objeto de proteger la privacidad de la información personal obtenida a través de nuestros servicios brindados en este portal.</p>
						
						<h3 class="info__title">Información que se suministra: contenidos</h3>
						<p class="info__text">Franquiciar.com no se responsabiliza por el contenido de las notas firmadas. Los montos de inversión, facturación y proyecciones económicas referidos en los artículos, perfiles y reportajes surgen de información suministrada por las empresas Franquiciantes y de los entrevistados, los que no son auditados por este Sitio.</p>
					
						<h3 class="info__title">Información que se obtiene a través de nuestros formularios</h3>
						<p class="info__text">La misma estará bajo las normas de confidencialidad / privacidad, toda aquella información personal que el usuario ingresa voluntariamente a Franquiciar.com.ar o durante la suscripción al Newsletters, etc. Esta incluye, pero no es limitativo, nombre, apellido, dirección, número de teléfono, correo electrónico.
							<br>
							El usuario puede modificar o actualizar esta información en cualquier momento.
							<br>
							Al solicitar información sobre una franquicia, los datos enviados por el usuario serán remitidos a la empresa franquiciante, al solo efecto de ampliar la información requerida sobre la franquicia en cuestión.
							<br>
							Los datos personales contenidos en la información confidencial, son utilizados para proveerle al usuario un servicio personalizado y acorde a sus necesidades.
						</p>
					</article>

					<article class="about__info--right">
						<h3 class="info__title">Confidencialidad de la Información</h3>
						<p class="info__text">Franquiciar.com.ar no compartirá la información confidencial con ningún tipo de empresa o socio, salvo cuando sea requerido por orden judicial o legal, o para proteger los derechos de propiedad u otros derechos o de Nuestro Sitio.</p>
						
						<h3 class="info__title">Aceptación de los términos</h3>
						<p class="info__text">
							Si el usuario utiliza los servicios de Franquiciar.com.ar, significa que ha leído, entendido y aceptado los términos expuestos. Si no está de acuerdo con ellos, el usuario no deberá proporcionar ninguna información personal, ni utilizar el servicio de este Sitio.
							<br>
							Esta declaración de Confidencialidad / Privacidad está sujeta a los términos y condiciones de Franquiciar.com.ar, con lo cual constituye un acuerdo legal entre el usuario y Franquiciar.com.ar.
						</p>

						<h3 class="info__title">Nota aclaratoria</h3>
						<p class="info__text">"Las Normas de Confidencialidad detalladas pueden tener cambios futuros; se aconseja revisarlas periódicamente."</p>
					</article>

				</div>


	            <figure class="about__banner banner__responsive">

					@unless(empty($frontBanners['banner_bottom_about']))
						<a href="{{ $frontBanners['banner_bottom_about_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_about'] }}"></a>
					@endunless
					@unless(empty($frontBanners['banner_bottom_about_mobile']))
						<a href="{{ $frontBanners['banner_bottom_about_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}public/uploads/{{ $frontBanners['banner_bottom_about_mobile'] }}"></a>
					@endunless
	            </figure>
			</div>

		</section>


	</div>

@endsection
@extends('layouts.layout')
@section('content')
    

<section class="section__associations">
	
	<div class="center-wrapper">
		<h1 class="associations__title">Asociaciones de franquicias</h1>

		<ul class="associations__list">
			<li class="associations__item">
				<a href="http://www.portalfiaf.com/quem-somos/" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-fiaf.png">
					</figure>
					<p class="associations__text">Federación Iberoamericana de Franquicias</p>
				</a>
			</li>
			<li class="associations__item">
				<a href="http://www.aamf.com.ar/" target="_blank">
					<figure class="associations__img"> 
						<img src="{{ Config::get('app.url') }}/image/associations/img-amf.png">
					</figure>
					<p class="associations__text">Asociación Argentina de Marcas y Franquicias</p>
				</a>
			</li>
		</ul>

		<ul class="associations__list">
			
			<li class="associations__item">
				<a href="http://www.cfcor.com.ar/" target="_blank">
					<figure class="associations__img"> 
						<img src="{{ Config::get('app.url') }}/image/associations/img-cfc.png">
					</figure>
					<p class="associations__text">Cámara de Franquicias de Córdoba</p>
				</a>
			</li>


			<li class="associations__item">
				<a href="http://caufran.org/" target="_blank">
					<figure class="associations__img"> 
						<img src="{{ Config::get('app.url') }}/image/associations/img-camarauruguaya.png">
					</figure>
					<p class="associations__text">Cámara Uruguaya de franquicias</p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://www.franquiciadores.com/" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-aef.png">
					</figure>
					<p class="associations__text">Asociación Española de Franquiciadores</p>
				</a>
			</li>
			
			<li class="associations__item">
				<a href="http://franquiciasdemexico.org.mx" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-asociaionmexicana.png">
					</figure>
					<p class="associations__text">Asociación Mexicana de Franquicias</p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://www.guatefranquicias.org/" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-agf.png">
					</figure>
					<p class="associations__text">Asociación Guatemalteca de Franquicias</p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://www.abf.com.br" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-abf.png">
					</figure>
					<p class="associations__text">Associação Brasileira de Franchising</p>
				</a>
			</li>
			
			<li class="associations__item">
				<a href="http://www.cpfranquicias.com/" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-camaraperuana.png">
					</figure>
					<p class="associations__text">Cámara Peruana de Franquicias</p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://profranquicias.com" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-profranquicias.png">
					</figure>
					<p class="associations__text">Cámara Venezolana de Franquicias</p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://www.colfranquicias.com/" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-colfranquicias.png">
					</figure>
					<p class="associations__text">Cámara Colombiana de Franquicias</p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://www.franquiciascostarricenses.cr/" target="_blank">
					<figure class="associations__img">
						<img src="{{ Config::get('app.url') }}/image/associations/img-cenaf.png">
					</figure>
					<p class="associations__text">Centro Nacional de Franquicias - Costa Rica </p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://www.associacaofranchising.pt/" target="_blank">
					<figure class="associations__img"> 
						<img src="{{ Config::get('app.url') }}/image/associations/img-apf.png">
					</figure>
					<p class="associations__text">Asociación Portuguesa de Franquicias</p>
				</a>
			</li>

			<li class="associations__item">
				<a href="http://www.cafran.org/" target="_blank">
					<figure class="associations__img"> 
						<img src="{{ Config::get('app.url') }}/image/associations/img-cafran.png">
					</figure>
					<p class="associations__text">CAFRAN Cámara Boliviana de Franquicias</p>
				</a>
			</li>

		</ul>

		<div class="associations__banner">
			<figure class="banner__responsive">
				@unless(empty($frontBanners['banner_bottom_franchising']))
					<a href="{{ $frontBanners['banner_bottom_franchising_url'] }}" target="_blank"><img class="banner__responsive__desktop" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_franchising'] }}"></a>
				@endunless
				@unless(empty($frontBanners['banner_bottom_franchising_mobile']))
					<a href="{{ $frontBanners['banner_bottom_franchising_url'] }}" target="_blank"><img class="banner__responsive__mobile" src="{{ Config::get('app.url') }}uploads/{{ $frontBanners['banner_bottom_franchising_mobile'] }}"></a>
				@endunless
			</figure>
		</div>


	</div>

</section>


@endsection
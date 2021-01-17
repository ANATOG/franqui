<ul class="component__button-list">
	<li class="button-list__item">
	    <button title="Compartir" class="button-list__item__btn || js-open-share" 
	    		data-url="{{ Config::get('app.url') }}franquicia/{{ $franchise->slug }}"
				data-title="{{ $franchise->name }}"
				data-text="{{ str_limit($franchise->description, $limit = 150, $end = '...') }}"
				data-via="franquiciar">

	        <span class="button-list__item__text">Compartir</span>
	        <i class="button-list__item__icon">
	            <svg width="100%" height="100%" viewBox="0 0 100 100">
	                <use xlink:href="#svg-symbol__share"></use>
	            </svg>
	        </i>
	    </button>
	</li>
	<li class="button-list__item">
	    <a title="Comparar" href="#" class="button-list__item__btn js-open-compare" data-slug="{{ $franchise->slug }}">
	        <span class="button-list__item__text">Comparar</span>
	        <i class="button-list__item__icon">
	            <svg width="100%" height="100%" viewBox="0 0 100 100">
	                <use xlink:href="#svg-symbol__compare"></use>
	            </svg>
	        </i>
	    </a>
	</li>
	<li class="button-list__item">
	    <button title="Favorito" data-item="{{ $franchise->id }}" class="button-favorites button-list__item__btn {{ (empty($loggedUser)) ? 'js-open-user-login' : '' }}{{ (in_array($franchise->id, $favorites))  ? 'js-active' : '' }}">
	        <span class="button-list__item__text">Favorito</span>
	        <i class="button-list__item__icon">
	            <svg width="100%" height="100%" viewBox="0 0 100 100">
	                <use xlink:href="#svg-symbol__star"></use>
	            </svg>
	        </i>
	    </button>
	</li>                                   
</ul>
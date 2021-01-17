<form class="component__send-contact">
	
	{{ Form::hidden('_token', csrf_token()) }}

	<div class="center-wrapper">
		<p>Tienes <span class="total-contact">{{ (Session::has('slugs')) ? count($slugSession) : '0' }}</span> franquicia/s seleccionada/s</p>
		
		<div class="send-contact__button-wrapper">
			<button class="button-simple--2 button-simple--2--blue-1 send-contact__button js-open-contact">Enviar consultas ahora</button>
			<button class="send-contact__close">Cancelar selección</button>			
		</div>


	</div>
</form>
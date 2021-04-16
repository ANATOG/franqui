<?php

	header('Content-Type: application/json');
	
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$db = null;
	$obj_item = new stdClass();
	$dbego = null;

	/* Aca llegan los datos del primer envío por Ajax para ser procesados*/ 

	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
	}
	/* Validamos con Google */
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le5PhcUAAAAAC_vYEiY7GqB7yRz7kSuK_8vlxXc&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

	/* Enviamos de vuelta las respuestas, si no es humano, envía 0 y si lo es, envía 1.*/

	if($response.success==false){
		return false;
	}else{
		setobjectitem();
	}


	switch ($obj_item->set_data_type) {

		case 'mail':
			checkMail();
			break;
		
		default:
			notFound();
			break;
	}	

		



	/*=====================================================================================================================
				                                         TO CRM
	=====================================================================================================================*/
	function setobjectitem(){
		global $json,$dbego,$obj_item;
		//seteo cada request
		foreach ($_REQUEST as $key => $value) {
			$obj_item-> $key = $value;
		}		

		$json["object"] = $obj_item;
		$obj_item->set_data_type = 'mail';
		$obj_item->set_mailto = 'jorge.manzano@egoargentina.com';
	}


	function checkMail(){
		global $json,$obj_item;
		if( strlen($obj_item->set_mailto) >10 ){

			
			$json["ELMAIL"] = $obj_item->set_mailto ;
			
			sendToMail();
		
		}
		else{
			$json["mail_FAIL"] = $mailcamp. 'TRUE';
		}

	}





	/*=====================================================================================================================

				                                         TO MAIL

	=====================================================================================================================*/
	function sendToMail(){

		global $json,$obj_item;
		$fields= [];
		
		foreach($obj_item as $field => $value){
			if(substr($field,0,6) === "field_"){

				$obj_field = new stdClass();
				$obj_field->field = str_replace("field_","",$field);
				$obj_field->value = $value;

				array_push($fields,$obj_field);
			}
		}

		// Agrego campos de control


		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$obj_field = new stdClass();
		$obj_field->field = "fecha";
		$obj_field->value = date("Y-m-d H:i:s");
		array_push($fields,$obj_field);




	// ENVIO DE MAIL DE NOTIFICACION

		$to = 'anitatorrez1924@gmail.com';
		$subject = "Formulario ";

		$headers = "From: FRANQUICIAR <" . strip_tags("contacto@franquiciar.com.ar") . ">\r\n";
		$headers .= "CC: dash.egoagency@gmail.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";

		$message .= '<html><body>';
		$message .= '<h1>Formulario propuesta comercial</h1>';
		$message .= '</body></html>';
		$message .= '<html><body>';
		$message .= '<table rules="all" style="border-color: #E8E8E8; width:100%" cellpadding="10" width="100%">';

		foreach($fields as $item){

			$field = $item->field;
			$field = str_replace("_"," ",$field);
			$field = ucwords($field);

			$value = $item->value;
			$value = strip_tags($value);

			$message .= "<tr><td><strong>".$field.":</strong> </td><td>" . $value . "</td></tr>";
		}

		$message .= "<tr><td><strong>sector:</strong> </td><td>" . $obj_item->set_source . "</td></tr>";

		$message .= "<tr><td><strong>URL:</strong> </td><td>" . $obj_item->setter_url . "</td></tr>";

		$message .= "</table>";
		$message .= "</body></html>";

		mail($to, $subject, $message, $headers);



		$json['mail'] = $fields;

	}


	function notFound(){
		global $json;
		$json['accion'] = 'not setted, go back';
	};



	printOut();
	function printOut($code=200,$str=''){
		global $json;
		echo json_encode($json, JSON_PRETTY_PRINT);


		die();
	}
?>



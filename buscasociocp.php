<?php
	include_once 'mini_test.php';
	$new = new CurlRequest();
	
	if (isset($_SERVER["HTTP_AUTHORIZATION"]) && 0 === stripos($_SERVER["HTTP_AUTHORIZATION"], 'basic ')) {
            $exploded = explode(':', base64_decode(substr($_SERVER["HTTP_AUTHORIZATION"], 6)), 2);
            if (2 == \count($exploded)) {
                list($un, $pw) = $exploded;
            }
        }
    
	$datos = $new->valida_ususario($un, $pw);
	$obj_datos = json_decode($datos);

	$respuesta = $obj_datos->respuesta;
	
	
    if($respuesta=="ok"){
		
		$json = file_get_contents('php://input');
		$data = json_decode($json);
	
            $item = array(
				'Celular' => $data->Celular,
				'Nick' => $data->Nick,
				'Doi' => $data->Doi,
				
            );
		
		$celular = "51" . $data->Celular;
		$Nom = $data->Nick . " - " . $data->Doi;
		
		$new ->sendPost_sms_infogas($celular, ucfirst(strtolower($Nom)));
		header('Content-Type: application/json');
		$mensaje = "Mensaje enviado";
		$datos = array("mensaje"=>$mensaje);
                  echo json_encode($datos);
	}
	else{
		header('HTTP/1.0 401 Unauthorized');
		header('Content-Type: application/json');
		$mensaje = "Invalido Usuario o Password";
		$datos = array("error"=>$mensaje);
                  echo json_encode($datos);
	}
?>	
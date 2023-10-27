<?php
include_once 'test.php';

$new = new CurlRequest();


$func = $_REQUEST["func"];


$doi = $_REQUEST["doi"];
$tipo = $_REQUEST["tipo"];
$correo = $_REQUEST["correo"];

if($doi!="" and $tipo!=""){
    $resultado = $new ->sendPatch_Pacinet($tipo, $doi);
	$new ->imprime_log_pacinet_api($tipo, $doi, $correo);
    
}

if($func==1){
	
	$correo1 = $_REQUEST["correo"];
	$pos = strpos($correo1, "@");
	$dominio = strtolower(substr($correo1, $pos+1));

	if($dominio=="cp.com.pe")
	{
		$datos = $new->existe_usuario_db_api($correo1);
		$obj_datos = json_decode($datos);

		$respuesta = $obj_datos->respuesta;
		$token = $obj_datos->token;
		
		if($respuesta=="ok"){
			echo "El correo ingresado ya existe, intenta en olvido de Clave";
		}
		else{
			$token = rand(100000,999999); 
			$new->nuevo_usuario_db_api($correo1, $token);
			$new->sendPost_email_pacinet_bloqueo($correo1, $token);
			echo "Se ha enviado un correo para que continues el proceso";
		}
	}
	else
	{
		echo "Correo no válido, solo @cp.com.pe";
	}
	exit();
    
}

if($func==2){
	
	$correo1 = $_REQUEST["correo"];
	$pos = strpos($correo1, "@");
	$dominio = strtolower(substr($correo1, $pos+1));

	if($dominio=="cp.com.pe")
	{
		$datos = $new->existe_usuario_db_api($correo1);
		$obj_datos = json_decode($datos);

		$respuesta = $obj_datos->respuesta;
		$token = $obj_datos->token;
		
		if($respuesta=="ok"){
			$token = rand(100000,999999); 
			$new->sendPost_email_pacinet_olvido($correo1, $token);
			$new->update_password_db_api($correo1, $token);
			echo "Se ha enviado un correo para que continues el proceso";
		}
		else{
			echo "El correo ingresado no existe, intenta de nuevo";
		}
	}
	else
	{
		echo "Correo no válido, solo @cp.com.pe";
	}
	exit();
    
}



?>
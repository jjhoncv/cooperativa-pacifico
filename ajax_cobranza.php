<?php
include_once 'apipersonas_cobranza.php';
$api = new ApiPersonas();

$func = $_REQUEST["func"];


if($func==1){
	$id = $_REQUEST["id"];
	$paso = $_REQUEST["paso"];
	$api->actualiza_paso_infogas($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = $_REQUEST["id"];
	$obs = $_REQUEST["obs"];
	
	if($id!=""){
		$api->actualiza_observacion_cobranza($id, $obs);
	}
	
	exit();
	
}

if($func==3){

	$celular = $_REQUEST["celular"];
	$nombre = $_REQUEST["nombre"];
	$tipo = $_REQUEST["tipo"];
	$dias = $_REQUEST["dias"];
	$monto = $_REQUEST["monto"];
	
	$celular = "51997855645";

	$mensaje = "";

	if($celular!="")
	{
		if($tipo=="1")
			$mensaje = "Coop.Pacífico: Sr(a) ". $nombre . ", tiene una cuota pendiente por pagar de " . $monto . " con " . $dias . " dias de vencido. Canales de pago bit.ly/3g555nJ +info en mobile@cp.com.pe";

		if($mensaje!="")
			$resultado = $api ->sendPost_sms_masivian_api($celular, $mensaje);
	}
	
	exit();
	
}

if($func==4){
	
    $xiomi = $_REQUEST["xiomi"];
    $kaori = $_REQUEST["kaori"];
	$johann = $_REQUEST["johann"];
		
	$api->actualiza_funcionario_micro($xiomi, $kaori, $johann);
	exit();	
}	


?>
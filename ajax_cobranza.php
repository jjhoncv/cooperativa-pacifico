<?php
include_once 'apipersonas_cobranza.php';
$api = new ApiPersonas();

$func = htmlspecialchars($_REQUEST["func"]);


if($func==1){
	$id = htmlspecialchars($_REQUEST["id"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$api->actualiza_paso_infogas($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = htmlspecialchars($_REQUEST["id"]);
	$obs = htmlspecialchars($_REQUEST["obs"]);
	
	if($id!=""){
		$api->actualiza_observacion_cobranza($id, $obs);
	}
	
	exit();
	
}

if($func==3){

	$celular = htmlspecialchars($_REQUEST["celular"]);
	$nombre = htmlspecialchars($_REQUEST["nombre"]);
	$tipo = htmlspecialchars($_REQUEST["tipo"]);
	$dias = htmlspecialchars($_REQUEST["dias"]);
	$monto = htmlspecialchars($_REQUEST["monto"]);
	
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
	
    $xiomi = htmlspecialchars($_REQUEST["xiomi"]);
    $kaori = htmlspecialchars($_REQUEST["kaori"]);
	$johann = htmlspecialchars($_REQUEST["johann"]);
		
	$api->actualiza_funcionario_micro($xiomi, $kaori, $johann);
	exit();	
}	


?>
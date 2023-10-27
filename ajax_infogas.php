<?php
include_once 'apipersonas_infogas.php';
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
	$monto = htmlspecialchars($_REQUEST["monto"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
	$placa_estado = htmlspecialchars($_REQUEST["placa_estado"]);
	$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);

	if($id!=""){
		$api->actualiza_observacion_infogas($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $placa_estado);
	}
	
	exit();
	
}

if($func==3){

	$celular = htmlspecialchars($_REQUEST["celular"]);
	$nombre = htmlspecialchars($_REQUEST["nombre"]);
	$tipo = htmlspecialchars($_REQUEST["tipo"]);
	$funcionario = htmlspecialchars($_REQUEST["funcionario"]);

	$mensaje = "";

	if($celular!="")
	{
		if($tipo=="Nocalifica")
			$mensaje = "Coop. Pacífico: ". $nombre . ", se ha revisado a profundidad su solicitud, lamentablemente en este momento no tenemos una oferta de crédito para Ud.";
		if($tipo=="Preaprobado")
			$mensaje = "Coop. Pacífico: Hola ". $nombre . ", tu" . $funcionario . " haz clic para conversar vía WhatsApp bit.ly/xxxxx o llama al 719-2100.";
		if($tipo=="2doForm")
			$mensaje = "Coop. Pacífico: Hola ". $nombre . ", para continuar con el proceso de prestamo haz clic aqui bit.ly/3Kwy2Jy.";

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
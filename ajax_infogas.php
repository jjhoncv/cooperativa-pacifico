<?php
include_once 'apipersonas_infogas.php';
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
	$monto = $_REQUEST["monto"];
	$paso = $_REQUEST["paso"];
	$funcionario = $_REQUEST["funcionario"];
	$placa_estado = $_REQUEST["placa_estado"];
	$fec_ingreso = $_REQUEST["fec_ingreso"];

	if($id!=""){
		$api->actualiza_observacion_infogas($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $placa_estado);
	}
	
	exit();
	
}

if($func==3){

	$celular = $_REQUEST["celular"];
	$nombre = $_REQUEST["nombre"];
	$tipo = $_REQUEST["tipo"];
	$funcionario = $_REQUEST["funcionario"];

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
	
    $xiomi = $_REQUEST["xiomi"];
    $kaori = $_REQUEST["kaori"];
	$johann = $_REQUEST["johann"];
		
	$api->actualiza_funcionario_micro($xiomi, $kaori, $johann);
	exit();	
}	


?>
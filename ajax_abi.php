<?php
include_once 'apipersonas_abi.php';
$api = new ApiPersonas();

$func = $_REQUEST["func"];


if($func==1){
	$id = $_REQUEST["id"];
	$paso = $_REQUEST["paso"];
	$api->actualiza_paso_pdp($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = $_REQUEST["id"];
	$obs = $_REQUEST["obs"];
	$monto = $_REQUEST["monto"];
	$paso = $_REQUEST["paso"];
	$funcionario = $_REQUEST["funcionario"];
	$fec_ingreso = $_REQUEST["fec_ingreso"];
	$tipo = $_REQUEST["tipo"];
	$convenio = $_REQUEST["convenio"];

	if($id!=""){
		$api->actualiza_observacion_pdp($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio);
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

		if($mensaje!="")
			$resultado = $api ->sendPost_sms_masivian_api($celular, $mensaje);
	}
	
	exit();
	
}

if($func==4){
	
    $agente1 = $_REQUEST["agente1"];
    $agente2 = $_REQUEST["agente2"];
	$agente3 = $_REQUEST["agente3"];
		
	$api->actualiza_funcionario_pdp($agente1, $agente2, $agente3);
	exit();	
}	


?>
<?php
include_once 'apipersonas_credimaq.php';
$api = new ApiPersonas();

$func = htmlspecialchars($_REQUEST["func"]);


if($func==1){
	$id = htmlspecialchars($_REQUEST["id"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$api->actualiza_paso_pdp($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = htmlspecialchars($_REQUEST["id"]);
	$obs = htmlspecialchars($_REQUEST["obs"]);
	$monto = htmlspecialchars($_REQUEST["monto"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
	$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);
	$tipo = htmlspecialchars($_REQUEST["tipo"]);
	$convenio = htmlspecialchars($_REQUEST["convenio"]);

	if($id!=""){
		$api->actualiza_observacion_pdp($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio);
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

		if($mensaje!="")
			$resultado = $api ->sendPost_sms_masivian_api($celular, $mensaje);
	}
	
	exit();
	
}

if($func==4){
	
    $agente1 = htmlspecialchars($_REQUEST["agente1"]);
    $agente2 = htmlspecialchars($_REQUEST["agente2"]);
	$agente3 = htmlspecialchars($_REQUEST["agente3"]);
		
	$api->actualiza_funcionario_pdp($agente1, $agente2, $agente3);
	exit();	
}	


?>
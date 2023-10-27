<?php
include_once 'apipersonas_camara.php';
$api = new ApiPersonas();

$func = htmlspecialchars($_REQUEST["func"]);


if($func==1){
	$id = htmlspecialchars($_REQUEST["id"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$api->actualiza_paso_camara($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = htmlspecialchars($_REQUEST["id"]);
	$obs = htmlspecialchars($_REQUEST["obs"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);
	$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
	$rechazo = htmlspecialchars($_REQUEST["rechazado"]);

	if($id!=""){
		$api->actualiza_observacion_camara($id, $obs, $paso, $fec_ingreso, $funcionario, $rechazo);
	}
	
	exit();
	
}

if($func==3){

	$celular = htmlspecialchars($_REQUEST["celular"]);
	$nombre = htmlspecialchars($_REQUEST["nombre"]);

	$resultado = $api ->envio_wsp($nombre, $celular);
	
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
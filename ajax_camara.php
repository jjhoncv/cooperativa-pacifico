<?php
include_once 'apipersonas_camara.php';
$api = new ApiPersonas();

$func = $_REQUEST["func"];


if($func==1){
	$id = $_REQUEST["id"];
	$paso = $_REQUEST["paso"];
	$api->actualiza_paso_camara($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = $_REQUEST["id"];
	$obs = $_REQUEST["obs"];
	$paso = $_REQUEST["paso"];
	$fec_ingreso = $_REQUEST["fec_ingreso"];
	$funcionario = $_REQUEST["funcionario"];
	$rechazo = $_REQUEST["rechazado"];

	if($id!=""){
		$api->actualiza_observacion_camara($id, $obs, $paso, $fec_ingreso, $funcionario, $rechazo);
	}
	
	exit();
	
}

if($func==3){

	$celular = $_REQUEST["celular"];
	$nombre = $_REQUEST["nombre"];

	$resultado = $api ->envio_wsp($nombre, $celular);
	
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
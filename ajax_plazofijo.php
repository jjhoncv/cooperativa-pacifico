<?php
include_once 'apipersonas_plazofijo.php';
$api = new ApiPersonas();

$func = $_REQUEST["func"];


if($func==1){
	$id = $_REQUEST["id"];
	$paso = $_REQUEST["paso"];
	$api->actualiza_paso_plazofijo($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = $_REQUEST["id"];
	$obs = $_REQUEST["obs"];
	$monto = $_REQUEST["monto"];
	$monto2 = $_REQUEST["monto2"];
	$paso = $_REQUEST["paso"];
	$fec_ingreso = $_REQUEST["fec_ingreso"];
	$funcionario = $_REQUEST["funcionario"];

	if($id!=""){
		$api->actualiza_observacion_plazofijo($id, $obs, $monto, $paso, $fec_ingreso, $monto2, $funcionario);
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
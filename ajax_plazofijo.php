<?php
include_once 'apipersonas_plazofijo.php';
$api = new ApiPersonas();

$func = htmlspecialchars($_REQUEST["func"]);


if($func==1){
	$id = htmlspecialchars($_REQUEST["id"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$api->actualiza_paso_plazofijo($id, $paso);
	
	exit();
    
}

if($func==2){

	$id = htmlspecialchars($_REQUEST["id"]);
	$obs = htmlspecialchars($_REQUEST["obs"]);
	$monto = htmlspecialchars($_REQUEST["monto"]);
	$monto2 = htmlspecialchars($_REQUEST["monto2"]);
	$paso = htmlspecialchars($_REQUEST["paso"]);
	$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);
	$funcionario = htmlspecialchars($_REQUEST["funcionario"]);

	if($id!=""){
		$api->actualiza_observacion_plazofijo($id, $obs, $monto, $paso, $fec_ingreso, $monto2, $funcionario);
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
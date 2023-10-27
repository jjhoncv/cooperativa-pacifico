<?php
session_start();
include_once 'apipersonas.php';

	$api = new ApiPersonas();
    $xiomi = $_REQUEST["xiomi"];
    $kaori = $_REQUEST["kaori"];
	$johann = $_REQUEST["johann"];
		
	$api->actualiza_funcionario_digital($xiomi, $kaori, $johann);
	exit();	

?>





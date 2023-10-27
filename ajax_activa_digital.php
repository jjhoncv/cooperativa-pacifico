<?php
session_start();
include_once 'apipersonas.php';

	$api = new ApiPersonas();
    $xiomi = htmlspecialchars($_REQUEST["xiomi"]);
    $kaori = htmlspecialchars($_REQUEST["kaori"]);
	$johann = htmlspecialchars($_REQUEST["johann"]);
		
	$api->actualiza_funcionario_digital($xiomi, $kaori, $johann);
	exit();	

?>





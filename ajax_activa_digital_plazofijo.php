<?php
session_start();
include_once 'apipersonas_plazofijo.php';

	$api = new ApiPersonas();
    $karina = htmlspecialchars($_REQUEST["karina"]);
    $karen = htmlspecialchars($_REQUEST["karen"]);
	$katy = htmlspecialchars($_REQUEST["katy"]);
		
	$api->actualiza_funcionario_digital_plazofijo($karina, $karen, $katy);
	exit();	

?>





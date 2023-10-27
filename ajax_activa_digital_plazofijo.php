<?php
session_start();
include_once 'apipersonas_plazofijo.php';

	$api = new ApiPersonas();
    $karina = $_REQUEST["karina"];
    $karen = $_REQUEST["karen"];
	$katy = $_REQUEST["katy"];
		
	$api->actualiza_funcionario_digital_plazofijo($karina, $karen, $katy);
	exit();	

?>





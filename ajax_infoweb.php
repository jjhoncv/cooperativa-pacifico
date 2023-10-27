<?php
include_once 'infoweb.php';
$api = new ApiInfoweb();

$func = $_REQUEST["func"];

	if($func==1){
	$dni = $_REQUEST["dni"];
	$api->api_infoweb_1ra_llamada($dni);

	}

	if($func==2){
	$token = $_REQUEST["token"];
	$dni = $_REQUEST["dni"];
	$scoring = $_REQUEST["scoring"];
	$api->api_infoweb_2da_llamada($token, $dni, $scoring);

	}
	
	if($func==3){
	$dni = $_REQUEST["dni"];

	
	
	$api->api_infoweb_3ra_llamada($dni);

	}

?>
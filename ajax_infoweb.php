<?php
include_once 'infoweb.php';
$api = new ApiInfoweb();

$func = htmlspecialchars($_REQUEST["func"]);

	if($func==1){
	$dni = htmlspecialchars($_REQUEST["dni"]);
	$api->api_infoweb_1ra_llamada($dni);

	}

	if($func==2){
	$token = htmlspecialchars($_REQUEST["token"]);
	$dni = htmlspecialchars($_REQUEST["dni"]);
	$scoring = htmlspecialchars($_REQUEST["scoring"]);
	$api->api_infoweb_2da_llamada($token, $dni, $scoring);

	}
	
	if($func==3){
	$dni = htmlspecialchars($_REQUEST["dni"]);

	
	
	$api->api_infoweb_3ra_llamada($dni);

	}

?>
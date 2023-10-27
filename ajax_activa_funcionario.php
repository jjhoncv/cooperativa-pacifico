<?php
session_start();
include_once 'apipersonas.php';


	$api = new ApiPersonas();

 
    $samantha = htmlspecialchars($_REQUEST["samantha"]);
    $daniel = htmlspecialchars($_REQUEST["daniel"]);
	$dayssy = htmlspecialchars($_REQUEST["dayssy"]);
	$gabriela = htmlspecialchars($_REQUEST["gabriela"]);
	$cinthia = htmlspecialchars($_REQUEST["cinthia"]);
	$christian = htmlspecialchars($_REQUEST["christian"]);
		
	$api->actualiza_funcionario($samantha, $daniel, $dayssy, $gabriela, $cinthia, $christian);
	exit();	

?>





<?php
session_start();
include_once 'apipersonas.php';


	$api = new ApiPersonas();

 
    $samantha = $_REQUEST["samantha"];
    $daniel = $_REQUEST["daniel"];
	$dayssy = $_REQUEST["dayssy"];
	$gabriela = $_REQUEST["gabriela"];
	$cinthia = $_REQUEST["cinthia"];
	$christian = $_REQUEST["christian"];
		
	$api->actualiza_funcionario($samantha, $daniel, $dayssy, $gabriela, $cinthia, $christian);
	exit();	

?>





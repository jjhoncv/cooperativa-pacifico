<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = htmlspecialchars($_REQUEST["id"]);
$obs = htmlspecialchars($_REQUEST["obs"]);
$paso = htmlspecialchars($_REQUEST["paso"]);
$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);

if($id!=""){
    $api->actualiza_observacion_kyodai($id, $obs, $paso, $funcionario, $fec_ingreso);

}


?>
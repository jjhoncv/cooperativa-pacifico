<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = htmlspecialchars($_REQUEST["id"]);
$obs = htmlspecialchars($_REQUEST["obs"]);
$monto = htmlspecialchars($_REQUEST["monto"]);
$paso = htmlspecialchars($_REQUEST["paso"]);
$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);

if($id!=""){
    //$api->actualiza_observacion($id, $obs, $monto, $paso, $funcionario);
    $api->actualiza_observacion($id, $obs, $monto, $paso, $funcionario, $fec_ingreso);
}


?>
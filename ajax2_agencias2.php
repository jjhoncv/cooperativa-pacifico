<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = htmlspecialchars($_REQUEST["id"]);
$obs = htmlspecialchars($_REQUEST["obs"]);
$paso = htmlspecialchars($_REQUEST["paso"]);
$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
$monto = htmlspecialchars($_REQUEST["monto"]);
$tarea = htmlspecialchars($_REQUEST["tarea"]);
$canal = htmlspecialchars($_REQUEST["canal"]);
$moneda = htmlspecialchars($_REQUEST["moneda"]);
$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);
$rechazado = htmlspecialchars($_REQUEST["rechazado"]);

if($id!=""){
    $api->actualiza_observacion_agencias2($id, $obs, $paso, $funcionario, $monto, $tarea, $canal, $moneda, $fec_ingreso, $rechazado);

}


?>
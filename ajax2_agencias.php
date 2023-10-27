<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = htmlspecialchars($_REQUEST["id"]);
$obs = htmlspecialchars($_REQUEST["obs"]);
$paso = htmlspecialchars($_REQUEST["paso"]);
$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
$monto = htmlspecialchars($_REQUEST["monto"]);
$fec_desembolso = htmlspecialchars($_REQUEST["fec_desembolso"]);
$moneda = htmlspecialchars($_REQUEST["moneda"]);
$cuotas = htmlspecialchars($_REQUEST["cuotas"]);
$rechazado = htmlspecialchars($_REQUEST["rechazado"]);
$tarea = htmlspecialchars($_REQUEST["tarea"]);
$tipo = htmlspecialchars($_REQUEST["tipo"]);
$agencia = htmlspecialchars($_REQUEST["agencia"]);
$fec_ingreso = htmlspecialchars($_REQUEST["fec_ingreso"]);

if($id!=""){
    $api->actualiza_observacion_agencias($id, $obs, $paso, $funcionario, $monto, $fec_desembolso, $moneda, $cuotas, $rechazado, $tarea, $tipo, $agencia, $fec_ingreso);

}


?>
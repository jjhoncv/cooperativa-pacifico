<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = $_REQUEST["id"];
$obs = $_REQUEST["obs"];
$paso = $_REQUEST["paso"];
$funcionario = $_REQUEST["funcionario"];
$monto = $_REQUEST["monto"];
$fec_desembolso = $_REQUEST["fec_desembolso"];
$moneda = $_REQUEST["moneda"];
$cuotas = $_REQUEST["cuotas"];
$rechazado = $_REQUEST["rechazado"];
$tarea = $_REQUEST["tarea"];
$tipo = $_REQUEST["tipo"];
$agencia = $_REQUEST["agencia"];
$fec_ingreso = $_REQUEST["fec_ingreso"];

if($id!=""){
    $api->actualiza_observacion_agencias($id, $obs, $paso, $funcionario, $monto, $fec_desembolso, $moneda, $cuotas, $rechazado, $tarea, $tipo, $agencia, $fec_ingreso);

}


?>
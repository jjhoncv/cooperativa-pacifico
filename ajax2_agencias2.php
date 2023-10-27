<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = $_REQUEST["id"];
$obs = $_REQUEST["obs"];
$paso = $_REQUEST["paso"];
$funcionario = $_REQUEST["funcionario"];
$monto = $_REQUEST["monto"];
$tarea = $_REQUEST["tarea"];
$canal = $_REQUEST["canal"];
$moneda = $_REQUEST["moneda"];
$fec_ingreso = $_REQUEST["fec_ingreso"];
$rechazado = $_REQUEST["rechazado"];

if($id!=""){
    $api->actualiza_observacion_agencias2($id, $obs, $paso, $funcionario, $monto, $tarea, $canal, $moneda, $fec_ingreso, $rechazado);

}


?>
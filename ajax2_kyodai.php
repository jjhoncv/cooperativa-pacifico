<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = $_REQUEST["id"];
$obs = $_REQUEST["obs"];
$paso = $_REQUEST["paso"];
$funcionario = $_REQUEST["funcionario"];
$fec_ingreso = $_REQUEST["fec_ingreso"];

if($id!=""){
    $api->actualiza_observacion_kyodai($id, $obs, $paso, $funcionario, $fec_ingreso);

}


?>
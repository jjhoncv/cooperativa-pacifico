<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = htmlspecialchars($_REQUEST["id"]);
$paso = htmlspecialchars($_REQUEST["paso"]);

if($id!="" and $paso!=""){
    $api->actualiza_paso_agencias2($id, $paso);
    
}


?>
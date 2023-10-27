<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();


$id = $_REQUEST["id"];
$paso = $_REQUEST["paso"];

if($id!="" and $paso!=""){
    $api->actualiza_paso_kyodai($id, $paso);
    
}


?>
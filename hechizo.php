<?php
include_once 'test.php';
$new = new CurlRequest();


$doi = $_GET["doi"];
$tipo = $_GET["tipo"];


$resultado = $new ->sendPatch_Pacinet($tipo, $doi);



echo $doi . " - " . $tipo;

echo $resultado;
?>
<?php
include_once 'test.php';
$new = new CurlRequest();


$doi = htmlspecialchars($_GET["doi"]);
$tipo = htmlspecialchars($_GET["tipo"]);


$resultado = $new ->sendPatch_Pacinet($tipo, $doi);



echo $doi . " - " . $tipo;

echo $resultado;
?>
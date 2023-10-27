<?php
include_once 'test.php';


$new = new CurlRequest();

$mensaje = "";
//$celular = $_POST['celular'];
//$mensaje = $_POST['mensaje'];

$celular = "51997855645";
$mensaje = "Hola mundo";

if($mensaje!="")
{
    $resultado = $new ->sendPost_sms_masivian($celular, $mensaje);
}

?>
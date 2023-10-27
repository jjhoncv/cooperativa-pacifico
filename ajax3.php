<?php
include_once 'test.php';
$new = new CurlRequest();


$celular = htmlspecialchars($_REQUEST["celular"]);
$nombre = htmlspecialchars($_REQUEST["nombre"]);
$tipo = htmlspecialchars($_REQUEST["tipo"]);
$funcionario = htmlspecialchars($_REQUEST["funcionario"]);

$mensaje = "";


if($celular!=""){
    if($tipo=="Nocalifica")
        $mensaje = "Coop. Pacífico: ". $nombre . ", se ha revisado a profundidad su solicitud, lamentablemente en este momento no tenemos una oferta de crédito para Ud.";
    if($tipo=="Preaprobado")
        $mensaje = "Coop. Pacífico: Hola ". $nombre . ", tu" . $funcionario . " haz clic para conversar vía WhatsApp bit.ly/2VwpurH o llama al 719-2100.";

    if($mensaje!="")
        $resultado = $new ->sendPost_sms_masivian($celular, $mensaje);
}


?>
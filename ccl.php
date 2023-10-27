<?php
include_once 'apipersonas_camara.php';
$api = new ApiPersonas();

$funcionario = "";

$utm_source = htmlspecialchars($_POST["utm_source"]);
$nombres = htmlspecialchars($_POST["nombre"]);
$ruc = htmlspecialchars($_POST["ruc"]);
$celular = htmlspecialchars($_POST["celular"]);
$correo = htmlspecialchars($_POST["correo"]);

$cts = (htmlspecialchars($_POST["cts"]))? "on" : "off";
$descuento_pla = (htmlspecialchars($_POST["descuento_pla"]))? "on" : "off";
$ahorro = (htmlspecialchars($_POST["ahorro"]))? "on" : "off";
$pfijo = (htmlspecialchars($_POST["pfijo"]))? "on" : "off";
$capital = (htmlspecialchars($_POST["capital"]))? "on" : "off";
$descuento_doc = (htmlspecialchars($_POST["descuento_doc"]))? "on" : "off";

if($cts=="on"){
	$funcionario = "alicia.teruya@cp.com.pe";
	$api->nuevoRegistroCamara_api($nombres, $ruc, $celular, $utm_source, $correo, $funcionario, "on", "off", "off", "off", "off", "off");
	$api->sendPost_email_camara($funcionario, $ruc, $nombres, "CTS");
}

if($descuento_pla=="on"){
	$funcionario = "marco.silva@cp.com.pe";
	$api->nuevoRegistroCamara_api($nombres, $ruc, $celular, $utm_source, $correo, $funcionario, "off", "on", "off", "off", "off", "off");
	$api->sendPost_email_camara($funcionario, $ruc, $nombres, "Descuento de Planilla");
}

if($ahorro=="on"){
	$funcionario = "marisela.torres@cp.com.pe";
	$api->nuevoRegistroCamara_api($nombres, $ruc, $celular, $utm_source, $correo, $funcionario, "off", "off", "on", "off", "off", "off");
	$api->sendPost_email_camara($funcionario, $ruc, $nombres, "Ahorro Float");
}

if($pfijo=="on"){
	$funcionario = "marisela.torres@cp.com.pe";
	$api->nuevoRegistroCamara_api($nombres, $ruc, $celular, $utm_source, $correo, $funcionario, "off", "off", "off", "on", "off", "off");
	$api->sendPost_email_camara($funcionario, $ruc, $nombres, "Plazo Fijo");
}

if($capital=="on"){
	$funcionario = "alvaro.ingaruca@cp.com.pe";
	$api->nuevoRegistroCamara_api($nombres, $ruc, $celular, $utm_source, $correo, $funcionario, "off", "off", "off", "off", "on", "off");
	$api->sendPost_email_camara($funcionario, $ruc, $nombres, "Capital de Trabajo");
}

if($descuento_doc=="on"){
	$funcionario = "alvaro.ingaruca@cp.com.pe";
	$api->nuevoRegistroCamara_api($nombres, $ruc, $celular, $utm_source, $correo, $funcionario, "off", "off", "off", "off", "off", "on");
	$api->sendPost_email_camara($funcionario, $ruc, $nombres, "Descuento de documentos");
}



/*
echo "utm_source [" .  $utm_source . "]" . "<br>";
echo "nombre [" .  $nombre . "]" . "<br>";
echo "ruc [" .  $ruc . "]" . "<br>";
echo "celular [" .  $celular . "]" . "<br>";
echo "correo [" .  $correo . "]" . "<br>";
echo "cts [" .  $cts . "]" . "<br>";
echo "descuento_pla [" .  $descuento_pla . "]" . "<br>";
echo "ahorro [" .  $ahorro . "]" . "<br>";
echo "pfijo [" .  $pfijo . "]" . "<br>";
echo "capital [" .  $capital . "]" . "<br>";
echo "descuento_doc [" .  $descuento_doc . "]" . "<br>";
echo $funcionario;
*/


header("Location: https://cp.com.pe/pacifico/productos-financieros-gracias/");

?>
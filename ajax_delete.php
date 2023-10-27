<?php
include_once 'test.php';
$test = new CurlRequest();


$id = htmlspecialchars($_REQUEST["id"]);
$detalle = htmlspecialchars($_REQUEST["detalle"]);
$accion = htmlspecialchars($_REQUEST["accion"]);

if($id!="")
{
	
	if($accion=="elimina"){
		
		$correo = "alicia.teruya@cp.com.pe";
		//$correo = "miguel.teruya@cp.com.pe";
		$nombre = "Alicia";
		$url = "https://cooperativapacifico.online/delete?tabla=Agencias&id=" . $id;
		$titulo = "Eliminar tarjeta en tablero";

		$test->sendPost_email_universal($correo,$nombre,$url,$titulo,$detalle);
	}
	
	if($accion=="urgente"){
		
		$correo = "alicia.teruya@cp.com.pe";
		//$correo = "miguel.teruya@cp.com.pe";
		$nombre = "Alicia";
		$url = "https://cooperativapacifico.online/urgente?tabla=Agencias&id=" . $id;
		$titulo = "No es Urgente - Tarjeta";

		$test->sendPost_email_urgente($correo,$nombre,$url,$titulo,$detalle);
	}

}


?>
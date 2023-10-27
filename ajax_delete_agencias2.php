<?php
   include_once 'apipersonas.php';
   $api = new ApiPersonas();


$id = $_REQUEST["id"];
$tabla = $_REQUEST["tabla"];
$accion = $_REQUEST["accion"];

if($id!="")
{
	
	if($accion=="elimina"){
		
		$api->borra_registro($tabla, $id);
	}

}


?>
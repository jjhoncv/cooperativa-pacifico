<?php
   include_once 'apipersonas.php';
   $api = new ApiPersonas();


$id = htmlspecialchars($_REQUEST["id"]);
$tabla = htmlspecialchars($_REQUEST["tabla"]);
$accion = htmlspecialchars($_REQUEST["accion"]);

if($id!="")
{
	
	if($accion=="elimina"){
		
		$api->borra_registro($tabla, $id);
	}

}


?>
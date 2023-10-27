<?php
session_start();
include_once 'apipersonas.php';

	$api = new ApiPersonas();
 
    $dni = $_REQUEST["dni"];
    $nombres = $_REQUEST["nombres"];
	$nombres = strtoupper($nombres);
    $codigo = $_REQUEST["codigo"];
	$codigo = str_pad($codigo, 7, "0", STR_PAD_LEFT);
	$agencia = $_REQUEST["agencia"];
    $correo = $_REQUEST["correo"];
	$celular = $_REQUEST["celular"];
	$observaciones = $_REQUEST["observaciones"];
	$funcionario = $_REQUEST["funcionario"];
	$canal = $_REQUEST["canal"];
	$tarea = $_REQUEST["tarea"];

			$item = array(
					'dni' => $dni,
					'nombres' => $nombres,
					'codigo' => $codigo,
					'agencia' => $agencia,
					'correo' => $correo,
					'celular' => $celular,
					'observaciones' => $observaciones,
					'funcionario' => $funcionario,
					'canal' => $canal,
					'tarea' => $tarea,
				);
				$api->add_Agencias2($item);

				exit();	

?>





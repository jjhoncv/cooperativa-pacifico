<?php
session_start();
include_once 'apipersonas.php';

	$api = new ApiPersonas();
 
    $dni = htmlspecialchars($_REQUEST["dni"]);
    $nombres = htmlspecialchars($_REQUEST["nombres"]);
	$nombres = strtoupper($nombres);
    $codigo = htmlspecialchars($_REQUEST["codigo"]);
	$codigo = str_pad($codigo, 7, "0", STR_PAD_LEFT);
	$agencia = htmlspecialchars($_REQUEST["agencia"]);
    $correo = htmlspecialchars($_REQUEST["correo"]);
	$celular = htmlspecialchars($_REQUEST["celular"]);
	$observaciones = htmlspecialchars($_REQUEST["observaciones"]);
	$funcionario = htmlspecialchars($_REQUEST["funcionario"]);
	$canal = htmlspecialchars($_REQUEST["canal"]);
	$tarea = htmlspecialchars($_REQUEST["tarea"]);

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





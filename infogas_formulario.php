<?php
session_start();
include_once 'mini_test.php';
include_once 'apipersonas_infogas.php';

$api = new ApiPersonas();

	$dni = htmlspecialchars($_POST["dni"]);
	$pregunta1 = htmlspecialchars($_POST["pregunta1"]);
	$pregunta2 = htmlspecialchars($_POST["pregunta2"]);
	$pregunta3 = htmlspecialchars($_POST["pregunta3"]);
	$pregunta4 = htmlspecialchars($_POST["pregunta4"]);
	$pregunta5 = htmlspecialchars($_POST["pregunta5"]);
	$pregunta6 = htmlspecialchars($_POST["pregunta6"]);
	$pregunta7 = htmlspecialchars($_POST["pregunta7"]);
	$pregunta8 = htmlspecialchars($_POST["pregunta8"]);

    $api->update_infogas($dni, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8);
	
	header("Location: https://cp.com.pe/pacifico/prestamo-taxistas-4/");
?>
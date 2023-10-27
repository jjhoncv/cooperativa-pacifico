<?php
session_start();
include_once 'mini_test.php';
include_once 'apipersonas_infogas.php';

$api = new ApiPersonas();

	$dni = $_POST["dni"];
	$pregunta1 = $_POST["pregunta1"];
	$pregunta2 = $_POST["pregunta2"];
	$pregunta3 = $_POST["pregunta3"];
	$pregunta4 = $_POST["pregunta4"];
	$pregunta5 = $_POST["pregunta5"];
	$pregunta6 = $_POST["pregunta6"];
	$pregunta7 = $_POST["pregunta7"];
	$pregunta8 = $_POST["pregunta8"];

    $api->update_infogas($dni, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8);
	
	header("Location: https://cp.com.pe/pacifico/prestamo-taxistas-4/");
?>
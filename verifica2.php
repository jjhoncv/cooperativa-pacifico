<?php

$pregunta0 = $_POST["pregunta0"];
$pregunta1 = $_POST["pregunta1"];
$pregunta2 = $_POST["pregunta2"];
$pregunta3 = $_POST["pregunta3"];
$pregunta4 = $_POST["pregunta4"];
$token = $_POST["token"];

$headers =  array(
	 "pJWTValue:$token",
	 "pListaRespuesta: 0"
	);
	
echo json_encode($headers);	
/*
echo $pregunta0 . "<br>";
echo $pregunta1 . "<br>";
echo $pregunta2 . "<br>";
echo $pregunta3 . "<br>";
echo $pregunta4 . "<br>";
*/

?>
<?php

$pregunta0 = htmlspecialchars($_POST["pregunta0"]);
$pregunta1 = htmlspecialchars($_POST["pregunta1"]);
$pregunta2 = htmlspecialchars($_POST["pregunta2"]);
$pregunta3 = htmlspecialchars($_POST["pregunta3"]);
$pregunta4 = htmlspecialchars($_POST["pregunta4"]);
$token = htmlspecialchars($_POST["token"]);

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
<?php

$email = $_POST["email"];
$password = $_POST["password"];

$pos_punto = strpos($email, '.',0);
$nombre = substr($email, 0,$pos_punto); 
$nombre = ucfirst(strtolower($nombre));

$email = substr($email, $pos_punto + 1);
$pos_arroba = strpos($email, '@',0);
$apellido = substr($email, 0, $pos_arroba);
$apellido = ucfirst(strtolower($apellido));

$email = substr($email, $pos_arroba + 1); // cp.com.pe
$email = strtolower($email);

if($email=="cp.com.pe")
{
    //session_start();
    //$_SESSION["login"] = "OK";
    // consultar si el correo existe
    // Si el correo existe, validar password
    // Si el correo no existe, grabar password
}

  header("Location: cutcp");




?>
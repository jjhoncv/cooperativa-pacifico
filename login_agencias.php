<?php

$email = $_POST["email"];
$password = $_POST["password"];

if($email==$password)
{
    session_start();
    $_SESSION["correo"] = $email;
	header("Location: ingresa");
}
else
{
	header("Location: ingresa?msg=Acceso%20denegado");
}

  




?>
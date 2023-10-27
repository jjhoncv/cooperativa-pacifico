<?php

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

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
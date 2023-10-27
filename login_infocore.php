<?php

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

if($email=="admin@infocore.com.pe" and $password=="coopac01")
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: infocore");




?>
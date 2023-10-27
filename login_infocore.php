<?php

$email = $_POST["email"];
$password = $_POST["password"];

if($email=="admin@infocore.com.pe" and $password=="coopac01")
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: infocore");




?>
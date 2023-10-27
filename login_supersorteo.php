<?php

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

if($email=="admin@cp.com.pe" and $password=="sorteo01")
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: supersorteo");




?>
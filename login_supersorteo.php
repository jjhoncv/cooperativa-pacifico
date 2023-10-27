<?php

$email = $_POST["email"];
$password = $_POST["password"];

if($email=="admin@cp.com.pe" and $password=="sorteo01")
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: supersorteo");




?>
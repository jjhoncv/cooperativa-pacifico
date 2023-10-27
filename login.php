<?php

$email = $_POST["email"];
$password = $_POST["password"];

if($email=="admin@experian.com.pe" and $password=="coopac01")
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: experian");




?>
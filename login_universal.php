<?php

$email = $_POST["email"];
$password = $_POST["password"];
$pagina = $_GET["ori"];

if($email==$password)
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: $pagina");




?>
<?php

$email = $_POST["email"];
$password = $_POST["password"];

$pagina = $_GET["pagina"];

if($email=="admin@cp.com.pe" and $password=="digital01")
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: $pagina");




?>
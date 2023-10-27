<?php

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

$pagina = htmlspecialchars($_GET["pagina"]);

if($email=="admin@cp.com.pe" and $password=="digital01")
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: $pagina");




?>
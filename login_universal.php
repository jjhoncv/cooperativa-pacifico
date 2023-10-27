<?php

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);
$pagina = htmlspecialchars($_GET["ori"]);

if($email==$password)
{
    session_start();
    $_SESSION["login"] = "OK";
}

  header("Location: $pagina");




?>
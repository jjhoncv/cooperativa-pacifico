<?php

include_once 'test.php';
$new = new CurlRequest();
$token = htmlspecialchars($_GET["token"]);

$new->borra_password_db_api($token);

//header("Location: pacinet?msg=Solicitud%20de%20clave%20eliminado");

echo "Solicitud de clave eliminado";

?>

